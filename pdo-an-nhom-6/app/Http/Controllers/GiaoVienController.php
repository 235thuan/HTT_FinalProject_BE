<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GiaoVien;

class GiaoVienController extends Controller
{
    public function listAll(Request $request)
{
    try {
        $khoas = DB::table('khoa')
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

        
        foreach($khoas as $khoa) {
            $teachersQuery = DB::table('giaovien')
                ->join('nguoidung', 'giaovien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->join('khoa', 'giaovien.ma_khoa', '=', 'khoa.id_khoa')
                ->where('giaovien.ma_khoa', '=', $khoa->id_khoa)
                ->select(
                    'giaovien.*',
                    'nguoidung.email',
                    'nguoidung.so_dien_thoai',
                    'khoa.ten_khoa'
                );

            if ($request->has('search')) {
                $search = $request->search;
                $teachersQuery->where(function($q) use ($search) {
                    $q->where('giaovien.ten_giaovien', 'LIKE', "%{$search}%")
                      ->orWhere('nguoidung.email', 'LIKE', "%{$search}%")
                      ->orWhere('nguoidung.so_dien_thoai', 'LIKE', "%{$search}%");
                });
            }

            if ($request->has('khoa') && $request->khoa == $khoa->id_khoa) {
                $khoa->active = true;
            }

            $khoa->teachers = $teachersQuery->paginate(5, ['*'], 'page_'.$khoa->id_khoa);

            $khoa->total_teachers = DB::table('giaovien')
            ->where('ma_khoa', '=', $khoa->id_khoa)
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
            'ma_khoa' => 'required|exists:khoa,id_khoa',
            'email' => 'required|email',
            'so_dien_thoai' => 'required'
        ]);

        // Update giaovien
        DB::table('giaovien')
            ->where('id_giaovien', $id)
            ->update([
                'ten_giaovien' => $validated['ten_giaovien'],
                'ma_khoa' => $validated['ma_khoa']
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
                'ma_khoa' => $validated['ma_khoa']
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
            ->join('khoa', 'giaovien.ma_khoa', '=', 'khoa.id_khoa')
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

        return view('qlnd.giaovienDetail', compact('giaovien'));
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
        $query->where(function($q) use ($search) {
            $q->where('ho_ten', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%")
              ->orWhere('so_dien_thoai', 'LIKE', "%{$search}%")
              // Add any other fields you want to search
              ->orWhere('ma_giao_vien', 'LIKE', "%{$search}%");
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
                ->map(function($khoa) {
                    $teacherCount = DB::table('giaovien')
                        ->where('ma_khoa', $khoa->id_khoa)
                        ->count();
                    return [
                        'type' => 'department',
                        'ma_khoa' => $khoa->id_khoa,
                        'ten_khoa' => $khoa->ten_khoa,
                        'teacher_count' => $teacherCount
                    ];
                });

            // Get matching teachers
            $teachers = DB::table('giaovien')
                ->join('khoa', 'giaovien.ma_khoa', '=', 'khoa.id_khoa')
                ->join('nguoidung', 'giaovien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->where(function($q) use ($search) {
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
                ->map(function($teacher) {
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
            ->join('khoa', 'giaovien.ma_khoa', '=', 'khoa.id_khoa')
            ->join('nguoidung', 'giaovien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
            ->where(function($q) use ($search) {
                $q->where('giaovien.ten_giaovien', 'LIKE', "%{$search}%")
                  ->orWhere('nguoidung.email', 'LIKE', "%{$search}%");
            })
            ->first();

      
        return response()->json([
            'found' => $teacher ? true : false,
            'type' => 'teacher',
            'teacher' => $teacher
        ]);
        return response()->json([
            'found' => false
        ]);
    } catch (\Exception $e) {
        \Log::error('Error in teacher search: ' . $e->getMessage());
        return response()->json(['error' => 'Có lỗi xảy ra'], 500);
    }
}

public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'ten_giaovien' => 'required',
            'ma_khoa' => 'required|exists:khoa,id_khoa',  // Simple validation
            'ma_monhoc' => 'required|array',
            'ma_monhoc.*' => 'exists:monhoc,id_monhoc',
            'email' => 'required|email|unique:nguoidung,email',
            'so_dien_thoai' => 'required'
        ]);

        DB::beginTransaction();

        // Create nguoidung first
        $idNguoiDung = DB::table('nguoidung')->insertGetId([
            'email' => $validated['email'],
            'so_dien_thoai' => $validated['so_dien_thoai']
         
        ]);

        // Create giaovien with ma_khoa
        $idGiaovien = DB::table('giaovien')->insertGetId([
            'ten_giaovien' => $validated['ten_giaovien'],
            'id_nguoidung' => $idNguoiDung,
            'ma_khoa' => $validated['ma_khoa'],
        
        ]);

        // Add monhoc relationships
        foreach ($validated['ma_monhoc'] as $monhocId) {
            DB::table('giaovien_monhoc')->insert([
                'ma_giaovien' => $idGiaovien,
                'ma_monhoc' => $monhocId

            ]);
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Thêm giáo viên thành công'
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Error in GiaoVienController@store: ' . $e->getMessage());
        return response()->json([
            'error' => 'Có lỗi xảy ra: ' . $e->getMessage()
        ], 500);
    }
}

public function checkEmailExists(Request $request)
{
    $email = $request->input('email');
    
    $exists = DB::table('nguoidung')
        ->where('email', $email)
        ->exists();
        
    return response()->json(['exists' => $exists]);
}

public function getMonHoc(Request $request)
{
    try {
        $khoaId = $request->khoa_id;
        
        if (!$khoaId) {
            return response()->json([], 400);
        }

        $monhoc = DB::table('monhoc')
            ->join('chuyennganh', 'monhoc.ma_chuyen_nganh', '=', 'chuyennganh.id_chuyennganh')
            ->join('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
            ->where('khoa.id_khoa', $khoaId)
            ->select(
                'monhoc.id_monhoc',
                'monhoc.ten_monhoc',
                'monhoc.so_tin_chi'
            )
            ->orderBy('monhoc.ten_monhoc')
            ->get()
            ->toArray(); // Convert to array

        // Debug log
        \Log::info('getMonHoc response:', ['data' => $monhoc]);

        return response()->json($monhoc);
    } catch (\Exception $e) {
        \Log::error('Error in getMonHoc: ' . $e->getMessage());
        return response()->json([], 500);
    }
}

public function getMonHocByKhoa($khoa_id)
{
    try {
        // Add header to force JSON response
        header('Content-Type: application/json');
        
        $monhoc = DB::table('monhoc')
            ->join('chuyennganh', 'monhoc.ma_chuyen_nganh', '=', 'chuyennganh.id_chuyennganh')
            ->join('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
            ->where('khoa.id_khoa', $khoa_id)
            ->select(
                'monhoc.id_monhoc',
                'monhoc.ten_monhoc',
                'monhoc.so_tin_chi'
            )
            ->orderBy('monhoc.ten_monhoc')
            ->get();

        // Log the response for debugging
        \Log::info('getMonHocByKhoa response:', ['khoa_id' => $khoa_id, 'data' => $monhoc]);

        return response()->json($monhoc)
            ->header('Content-Type', 'application/json')
            ->header('X-Content-Type-Options', 'nosniff');

    } catch (\Exception $e) {
        \Log::error('Error in getMonHocByKhoa: ' . $e->getMessage());
        
        return response()->json([
            'error' => 'Server error',
            'message' => $e->getMessage()
        ], 500)
        ->header('Content-Type', 'application/json')
        ->header('X-Content-Type-Options', 'nosniff');
    }
}

public function findTeacherPage(Request $request)
{
    try {
        $teacherId = $request->teacher_id;
        $perPage = 5; // Match your pagination setting
        
        // Find the teacher and their khoa
        $teacher = DB::table('giaovien')
            ->join('khoa', 'giaovien.ma_khoa', '=', 'khoa.id_khoa')
            ->where('id_giaovien', $teacherId)
            ->select('giaovien.*', 'khoa.id_khoa')
            ->first();

        if ($teacher) {
            // Find position of teacher in their khoa's list
            $position = DB::table('giaovien')
                ->where('ma_khoa', $teacher->id_khoa)
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