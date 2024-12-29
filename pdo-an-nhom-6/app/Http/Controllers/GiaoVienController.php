<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use App\Services\Thuan\KhoaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GiaoVien;

class GiaoVienController extends Controller
{
    protected $hocPhiService;

    public function __construct(

        KhoaService $khoaService
    )
    {

        $this->khoaService = $khoaService;
    }

    public function listAll(Request $request)
    {
        try {
            $khoas = Khoa::with('chuyenNganhs')
                ->select('id_khoa', 'ten_khoa')
                ->orderBy('ten_khoa')
                ->get();


            // Verify we have unique khoa records
            $uniqueKhoas = $khoas->unique('ten_khoa');
            if ($uniqueKhoas->count() !== $khoas->count()) {
                \Log::warning('Found duplicate khoa records');
                // Use only unique records
                $khoas = $uniqueKhoas;
            }


            foreach ($khoas as $khoa) {
                $teachersQuery = DB::table('giaovien')
                    ->join('nguoidung', 'giaovien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                    ->join('khoa', 'giaovien.id_khoa', '=', 'khoa.id_khoa')
                    ->where('giaovien.id_khoa', '=', $khoa->id_khoa)
                    ->select(
                        'giaovien.*',
                        'nguoidung.email',
                        'nguoidung.so_dien_thoai',
                        'khoa.ten_khoa'
                    );

                if ($request->has('search')) {
                    $search = $request->search;
                    $teachersQuery->where(function ($q) use ($search) {
                        $q->where('giaovien.ten_giaovien', 'LIKE', "%{$search}%")
                            ->orWhere('nguoidung.email', 'LIKE', "%{$search}%")
                            ->orWhere('nguoidung.so_dien_thoai', 'LIKE', "%{$search}%");
                    });
                }

                if ($request->has('khoa') && $request->khoa == $khoa->id_khoa) {
                    $khoa->active = true;
                }

                $khoa->teachers = $teachersQuery->paginate(5, ['*'], 'page_' . $khoa->id_khoa);

                $khoa->total_teachers = DB::table('giaovien')
                    ->where('id_khoa', '=', $khoa->id_khoa)
                    ->count();
            }

            if ($request->ajax()) {
                if ($request->has('khoa_id')) {
                    $khoa = $khoas->firstWhere('id_khoa', $request->khoa_id);
                    return view('qlnd.partials.teacher-list', [
                        'teachers' => $khoa->teachers,
                        'khoa' => $khoa,
                        'khoas' => $khoas
                    ])->render();
                }
            }


            return view('qlnd.listGiaovien', compact('khoas'));
        } catch (\Exception $e) {
            \Log::error('GiaoVienController@listAll: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => 'Có lỗi xảy ra'], 500);
            }
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function edit($id)
    {
        try {
            // Store return URL parameters
            session([
                'return_page' => request('return_page', 1),
                'return_khoa' => request('khoa')
            ]);

            $giaovien = DB::table('giaovien')
                ->join('nguoidung', 'giaovien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->where('giaovien.id_giaovien', $id)
                ->first();

            if (!$giaovien) {
                return redirect()->back()->with('error', 'Không tìm thấy giáo viên');
            }

            $khoas = DB::table('khoa')->get();

            return view('qlnd.editGiaovien', compact('giaovien', 'khoas'));
        } catch (\Exception $e) {
            \Log::error('Error in GiaoVienController@edit: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'ten_giaovien' => 'required',
                'id_khoa' => 'required|exists:khoa,id_khoa',
                'email' => 'required|email',
                'so_dien_thoai' => 'required'
            ]);

            // Update giaovien
            DB::table('giaovien')
                ->where('id_giaovien', $id)
                ->update([
                    'ten_giaovien' => $validated['ten_giaovien'],
                    'id_khoa' => $validated['id_khoa']
                ]);

            // Get giaovien record
            $giaovien = DB::table('giaovien')
                ->where('id_giaovien', $id)
                ->first();

            // Update nguoidung
            DB::table('nguoidung')
                ->where('id_nguoidung', $giaovien->id_nguoidung)
                ->update([
                    'email' => $validated['email'],
                    'so_dien_thoai' => $validated['so_dien_thoai']
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công',
                'data' => [
                    'id' => $id,
                    'ten_giaovien' => $validated['ten_giaovien'],
                    'email' => $validated['email'],
                    'so_dien_thoai' => $validated['so_dien_thoai'],
                    'id_khoa' => $validated['id_khoa']
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in GiaoVienController@update: ' . $e->getMessage());
            return response()->json([
                'error' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function detail($id)
    {
        try {

            $giaovien = DB::table('giaovien')
                ->join('nguoidung', 'giaovien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->join('khoa', 'giaovien.id_khoa', '=', 'khoa.id_khoa')
                ->where('giaovien.id_giaovien', $id)
                ->select(
                    'giaovien.*',
                    'nguoidung.email',
                    'nguoidung.so_dien_thoai',
                    'khoa.ten_khoa'
                )
                ->first();

            if (!$giaovien) {
                return redirect()->back()->with('error', 'Không tìm thấy giáo viên');
            }
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();
            $khoas = $khoaResult['success'] ? $khoaResult['data'] : collect([]);
            return view('qlnd.giaovienDetail', compact('giaovien', 'khoas'));
        } catch (\Exception $e) {
            \Log::error('Error in GiaoVienController@detail: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function index(Request $request)
    {
        $query = GiaoVien::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ho_ten', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('so_dien_thoai', 'LIKE', "%{$search}%")
                    // Add any other fields you want to search
                    ->orWhere('id_giaovien', 'LIKE', "%{$search}%");
            });
        }


        $teachers = $query->paginate(10);

        if ($request->ajax()) {
            return view('qlnd.partials.teacher-list', compact('teachers'))->render();
        }

        return view('qlnd.listGiaovien', compact('teachers'));
    }

    public function search(Request $request)
    {
        try {
            $search = $request->search;
            $suggestions = [];

            if ($request->has('suggest') && $search) {
                // Get matching departments
                $departments = DB::table('khoa')
                    ->where('ten_khoa', 'LIKE', "%{$search}%")
                    ->get()
                    ->map(function ($khoa) {
                        $teacherCount = DB::table('giaovien')
                            ->where('id_khoa', $khoa->id_khoa)
                            ->count();
                        return [
                            'type' => 'department',
                            'id_khoa' => $khoa->id_khoa,
                            'ten_khoa' => $khoa->ten_khoa,
                            'teacher_count' => $teacherCount
                        ];
                    });

                // Get matching teachers
                $teachers = DB::table('giaovien')
                    ->join('khoa', 'giaovien.id_khoa', '=', 'khoa.id_khoa')
                    ->join('nguoidung', 'giaovien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                    ->where(function ($q) use ($search) {
                        $q->where('giaovien.ten_giaovien', 'LIKE', "%{$search}%")
                            ->orWhere('nguoidung.email', 'LIKE', "%{$search}%")
                            ->orWhere('khoa.ten_khoa', 'LIKE', "%{$search}%");
                    })
                    ->select(
                        'giaovien.id_giaovien',
                        'giaovien.ten_giaovien',
                        'khoa.ten_khoa',
                        'nguoidung.email'
                    )
                    ->limit(5)
                    ->get()
                    ->map(function ($teacher) {
                        return [
                            'type' => 'teacher',
                            'id_giaovien' => $teacher->id_giaovien,
                            'ten_giaovien' => $teacher->ten_giaovien,
                            'ten_khoa' => $teacher->ten_khoa,
                            'email' => $teacher->email
                        ];
                    });

                $suggestions = $departments->concat($teachers);
                return response()->json(['suggestions' => $suggestions]);
            }


            // Handle direct search
            $teacher = DB::table('giaovien')
                ->join('khoa', 'giaovien.id_khoa', '=', 'khoa.id_khoa')
                ->join('nguoidung', 'giaovien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->where(function ($q) use ($search) {
                    $q->where('giaovien.ten_giaovien', 'LIKE', "%{$search}%")
                        ->orWhere('nguoidung.email', 'LIKE', "%{$search}%");
                })
                ->first();


            return response()->json([
                'found' => $teacher ? true : false,
                'type' => 'teacher',
                'teacher' => $teacher
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in teacher search: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'ten_giaovien' => 'required',
                'email' => 'required|email',
                'so_dien_thoai' => 'required',
                'id_khoa' => 'required|exists:khoa,id_khoa',
                'id_monhoc' => 'required|array',
                'id_monhoc.*' => 'exists:monhoc,id_monhoc'
            ]);

            // Start transaction
            DB::beginTransaction();

            // Generate new teacher ID
            $lastId = DB::table('giaovien')
                ->orderBy('id_giaovien', 'desc')
                ->value('id_giaovien') ?? 0;

            $newId = $lastId + 1;

            // Find or create nguoidung based on email
            $nguoiDung = DB::table('nguoidung')
                ->where('email', $request->email)
                ->first();

            if ($nguoiDung) {
                // Check if user already has any role
                $hasRole = DB::table('phanquyen')
                    ->where('id_nguoidung', $nguoiDung->id_nguoidung)
                    ->exists();

                if ($hasRole) {
                    DB::rollBack();
                    return response()->json([
                        'errors' => ['email' => ['Email đã được sử dụng bởi một tài khoản khác']]
                    ], 422);
                }

                $id_nguoidung = $nguoiDung->id_nguoidung;
            } else {
                // Create new nguoidung
                $id_nguoidung = DB::table('nguoidung')->insertGetId([
                    'ten_dang_nhap' => $request->email,
                    'mat_khau' => bcrypt('123456@a'),
                    'email' => $request->email,
                    'so_dien_thoai' => $request->so_dien_thoai,
                    'trang_thai' => 'hoạt động'
                ]);
            }

            // Assign teacher role (id_vaitro = 2)
            DB::table('phanquyen')->insert([
                'id_nguoidung' => $id_nguoidung,
                'id_vaitro' => 4
            ]);

            // Create new giao vien
            DB::table('giaovien')->insert([
                'id_giaovien' => $newId,
                'id_nguoidung' => $id_nguoidung,
                'ten_giaovien' => $request->ten_giaovien,
                'id_khoa' => $request->id_khoa
            ]);

            // Add monhoc relationships
            foreach ($request->id_monhoc as $monhocId) {
                DB::table('giaovien_monhoc')->insert([
                    'id_giaovien' => $newId,
                    'id_monhoc' => $monhocId
                ]);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Thêm giáo viên thành công',
                'data' => [
                    'id_giaovien' => $newId,
                    'ten_giaovien' => $request->ten_giaovien,
                    'email' => $request->email,
                    'so_dien_thoai' => $request->so_dien_thoai
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'errors' => ['general' => [$e->getMessage()]]
            ], 500);
        }
    }

    public function checkEmailExists(Request $request)
    {
        try {
            $email = $request->get('email');

            if (!$email) {
                return response()->json([
                    'exists' => false,
                    'message' => 'Vui lòng nhập email'
                ]);
            }

            $nguoiDung = DB::table('nguoidung')
                ->where('email', $email)
                ->first();

            if ($nguoiDung) {
                // Check if user already has any role
                $hasRole = DB::table('phanquyen')
                    ->where('id_nguoidung', $nguoiDung->id_nguoidung)
                    ->exists();

                if ($hasRole) {
                    return response()->json([
                        'exists' => true,
                        'canUse' => false,
                        'message' => 'Email đã được sử dụng bởi một tài khoản khác'
                    ]);
                }

                return response()->json([
                    'exists' => true,
                    'canUse' => true,
                    'message' => 'Email đã tồn tại và có thể sử dụng cho giáo viên mới'
                ]);
            }

            return response()->json([
                'exists' => false,
                'canUse' => true,
                'message' => 'Email chưa tồn tại, tài khoản sẽ được tạo tự động'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error checking email: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Có lỗi xảy ra khi kiểm tra email'
            ], 500);
        }
    }



    public function getMonHocByKhoa($khoa_id)
    {
        try {
            DB::enableQueryLog();

            $monhoc = DB::table('monhoc as m')
                ->select([
                    'm.id_monhoc',
                    'm.ten_monhoc',
                    'm.so_tin_chi'
                ])
                ->join('chuyennganh as cn', 'm.id_chuyennganh', '=', 'cn.id_chuyennganh')
                ->where('cn.id_khoa', '=', $khoa_id)
                ->distinct()
                ->orderBy('m.ten_monhoc')
                ->get();

            // Log the query for debugging
            \Log::info('Query executed:', [
                'sql' => DB::getQueryLog(),
                'khoa_id' => $khoa_id,
                'count' => $monhoc->count()
            ]);

            return response()->json($monhoc);

        } catch (\Exception $e) {
            \Log::error('Error:', [
                'message' => $e->getMessage(),
                'khoa_id' => $khoa_id
            ]);

            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function findTeacherPage(Request $request)
    {
        try {
            $teacherId = $request->teacher_id;
            $perPage = 5; // Match your pagination setting

            // Find the teacher and their khoa
            $teacher = DB::table('giaovien')
                ->join('khoa', 'giaovien.id_khoa', '=', 'khoa.id_khoa')
                ->where('id_giaovien', $teacherId)
                ->select('giaovien.*', 'khoa.id_khoa')
                ->first();

            if ($teacher) {
                // Find position of teacher in their khoa's list
                $position = DB::table('giaovien')
                    ->where('id_khoa', $teacher->id_khoa)
                    ->where('id_giaovien', '<=', $teacherId)
                    ->count();

                // Calculate page number
                $page = ceil($position / $perPage);

                return response()->json([
                    'success' => true,
                    'list' => $teacher->id_khoa, // Use khoa ID as list identifier
                    'page' => $page
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy giáo viên'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ]);
        }
    }
}
