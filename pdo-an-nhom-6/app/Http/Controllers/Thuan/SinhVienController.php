<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use App\Services\Thuan\KhoaService;
use App\Services\Thuan\SinhVienService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SinhVienController extends Controller
{
    protected $khoaService;
    protected $sinhVienService;

    public function __construct(KhoaService $khoaService, SinhVienService $sinhVienService)
    {
        $this->khoaService = $khoaService;
        $this->sinhVienService = $sinhVienService;
    }

    public function show($id)
    {
        try {
            $sinhvien = DB::table('sinhvien')
                ->join('nguoidung', 'sinhvien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->where('sinhvien.id_sinhvien', $id)
                ->first();

            if (!$sinhvien) {
                return redirect()->back()->with('error', 'Không tìm thấy sinh viên');
            }

            return view('qlnd.showStudent', compact('sinhvien'));
        } catch (\Exception $e) {
            \Log::error('Error in SinhVienController@show: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function edit($id)
    {
        try {
            // Get sinh viên with all related info
            $sinhvien = DB::table('sinhvien as sv')
                ->join('nguoidung as nd', 'sv.id_nguoidung', '=', 'nd.id_nguoidung')
                ->join('lop as l', 'sv.id_lop', '=', 'l.id_lop')
                ->join('chuyennganh as cn', 'l.id_chuyennganh', '=', 'cn.id_chuyennganh')
                ->select(
                    'sv.id_sinhvien',
                    'sv.ten_sinhvien',
                    'nd.email',
                    'nd.so_dien_thoai',
                    'l.id_lop',
                    'l.ten_lop',
                    'l.nam_vao_hoc',
                    'cn.ten_chuyennganh'
                )
                ->where('sv.id_sinhvien', $id)
                ->first();

            if (!$sinhvien) {
                throw new \Exception('Không tìm thấy sinh viên');
            }

            return response()->json([
                'success' => true,
                'data' => $sinhvien
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // First get the nguoidung.id_nguoidung for this sinhvien
            $sinhvien = DB::table('sinhvien')
                ->join('nguoidung', 'sinhvien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->where('sinhvien.id_sinhvien', $id)
                ->select('sinhvien.*', 'nguoidung.id_nguoidung')
                ->first();

            if (!$sinhvien) {
                throw new \Exception('Không tìm thấy sinh viên');
            }

            // Now validate with correct id for nguoidung table
            $validated = $request->validate([
                'ten_sinhvien' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('nguoidung')->ignore($sinhvien->id_nguoidung, 'id_nguoidung')
                ],
                'id_lop' => 'required|exists:lop,id_lop',
                'so_dien_thoai' => [
                    'nullable',
                    'string',
                    'max:15',
                    Rule::unique('nguoidung')->ignore($sinhvien->id_nguoidung, 'id_nguoidung')
                ]
            ], [
                'email.unique' => 'Email này đã được sử dụng',
                'so_dien_thoai.unique' => 'Số điện thoại này đã được sử dụng'
            ]);

            DB::beginTransaction();

            // Update nguoidung
            DB::table('nguoidung')
                ->where('id_nguoidung', $sinhvien->id_nguoidung)
                ->update([
                    'email' => $validated['email'],
                    'so_dien_thoai' => $validated['so_dien_thoai']

                ]);

            // Update sinhvien
            DB::table('sinhvien')
                ->where('id_sinhvien', $id)
                ->update([
                    'ten_sinhvien' => $validated['ten_sinhvien'],
                    'id_lop' => $validated['id_lop']

                ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật sinh viên thành công'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error updating student:', [
                'id_sinhvien' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($e instanceof \Illuminate\Database\QueryException && $e->errorInfo[1] == 1062) {
                return response()->json([
                    'success' => false,
                    'message' => 'Thông tin đã tồn tại',
                    'errors' => [
                        'email' => ['Email hoặc số điện thoại đã được sử dụng']
                    ]
                ], 422);
            }

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật sinh viên',
                'errors' => ['general' => [$e->getMessage()]]
            ], 500);
        }
    }

    public function detail($id)
    {
        try {
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();
            $khoas = $khoaResult['success'] ? $khoaResult['data'] : collect([]);
            $sinhvien = DB::table('sinhvien')
                ->join('nguoidung', 'sinhvien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->join('lop', 'sinhvien.id_lop', '=', 'lop.id_lop')
                ->join('chuyennganh', 'lop.id_chuyennganh', '=', 'chuyennganh.id_chuyennganh')
                ->join('khoa', 'chuyennganh.id_khoa', '=', 'khoa.id_khoa')
                ->where('sinhvien.id_sinhvien', $id)
                ->select(
                    'sinhvien.*',
                    'lop.ten_lop',
                    'lop.nam_vao_hoc',
                    'nguoidung.email',
                    'nguoidung.so_dien_thoai',
                    'chuyennganh.ten_chuyennganh',
                    'khoa.ten_khoa'
                )
                ->first();

            if (!$sinhvien) {
                return redirect()->back()->with('error', 'Không tìm thấy sinh viên');
            }

            return view('qlnd.sinhvienDetail', compact('sinhvien', 'khoas'));
        } catch (\Exception $e) {
            \Log::error('Error in SinhVienController@detail: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function checkEmail(Request $request)
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
                    'message' => 'Email đã tồn tại và có thể sử dụng cho sinh viên mới'
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



    public function store(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'ten_sinhvien' => 'required|string|max:255',
                'email' => 'required|email',
                'id_lop' => 'required|exists:lop,id_lop',
                'so_dien_thoai' => 'nullable|string|max:15|unique:nguoidung,so_dien_thoai' // Add unique validation
            ], [
                'so_dien_thoai.unique' => 'Số điện thoại này đã được sử dụng'
            ]);

            // Start transaction
            DB::beginTransaction();

            // Generate new student ID
            $lastId = DB::table('sinhvien')
                ->orderBy('id_sinhvien', 'desc')
                ->value('id_sinhvien') ?? 0;
            $newId = $lastId + 1;

            // Check if email already exists and get nguoidung
            $nguoiDung = DB::table('nguoidung')
                ->where('email', $validated['email'])
                ->first();

            if ($nguoiDung) {
                // Check if user already has a role
                $hasRole = DB::table('phanquyen')
                    ->where('id_nguoidung', $nguoiDung->id_nguoidung)
                    ->exists();

                if ($hasRole) {
                    return response()->json([
                        'success' => false,
                        'errors' => [
                            'email' => ['Email này đã được sử dụng bởi một tài khoản khác']
                        ]
                    ], 422);
                }

                $id_nguoidung = $nguoiDung->id_nguoidung;
            } else {
                // Create new nguoidung
                $id_nguoidung = DB::table('nguoidung')->insertGetId([
                    'ten_dang_nhap' => $validated['email'],
                    'mat_khau' => bcrypt('123456@a'),
                    'email' => $validated['email'],
                    'so_dien_thoai' => $request->so_dien_thoai,
                    'trang_thai' => 'hoạt động'

                ]);
            }

            // Assign student role
            DB::table('phanquyen')->insert([
                'id_nguoidung' => $id_nguoidung,
                'id_vaitro' => 3 // Assuming 3 is student role
            ]);

            // Create sinh vien record
            DB::table('sinhvien')->insert([
                'id_sinhvien' => $newId,
                'id_nguoidung' => $id_nguoidung,
                'ten_sinhvien' => $validated['ten_sinhvien'],
                'id_lop' => $validated['id_lop']

            ]);

            DB::commit();

            // Get lop information for response
            $lop = DB::table('lop')
                ->where('id_lop', $validated['id_lop'])
                ->first();

            return response()->json([
                'success' => true,
                'message' => 'Thêm sinh viên thành công',
                'data' => [
                    'id_sinhvien' => $newId,
                    'ten_sinhvien' => $validated['ten_sinhvien'],
                    'email' => $validated['email'],
                    'so_dien_thoai' => $request->so_dien_thoai,
                    'lop' => $lop->ten_lop
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi trong SinhVienController@store: ' . $e->getMessage());
// Check for unique constraint violation
            if ($e instanceof \Illuminate\Database\QueryException && $e->errorInfo[1] == 1062) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra',
                    'errors' => [
                        'so_dien_thoai' => ['Số điện thoại này đã được sử dụng']
                    ]
                ], 422);
            }
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi thêm sinh viên',
                'errors' => ['general' => [$e->getMessage()]]
            ], 500);
        }
    }

    public function dangKyLop()
    {
        try {
            // Get students lists
            $result = $this->sinhVienService->getStudentsLists();

            // Get khoa list
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();

            // Get lop list
            $lopResult = $this->sinhVienService->getLopList();

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            return view('thuan.dang-ky-lop', [
                'unassignedStudents' => $result['data']['unassigned'],
                'assignedStudents' => $result['data']['assigned'],
                'khoas' => $khoaResult['success'] ? $khoaResult['data'] : collect([]),
                'lops' => $lopResult['success'] ? $lopResult['data'] : collect([]) ,
                'allStudents' => $result['data']
            ]);

        } catch (\Exception $e) {
            Log::error('Error in dangKyLop: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function getLopList()
    {
        try {
            $result = $this->sinhVienService->getLopList();

            return response()->json($result, 200, [
                'Content-Type' => 'application/json'
            ]);

        } catch (\Exception $e) {
            Log::error('Controller: Error in getLopList', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách lớp'
            ], 500);
        }
    }

    public function assignStudent(Request $request)
    {
        try {
            Log::info('Controller: Starting assignStudent', [
                'request_data' => $request->except(['ten_sinhvien'])
            ]);

            $validated = $request->validate([
                'id_nguoidung' => 'required|exists:nguoidung,id_nguoidung',
                'id_lop' => 'required|exists:lop,id_lop'
            ]);

            Log::info('Controller: Validation passed');

            $result = $this->sinhVienService->assignStudent($validated);

            Log::info('Controller: Got assignment result', [
                'success' => $result['success']
            ]);

            if (!$result['success']) {
                Log::warning('Controller: Assignment failed', [
                    'message' => $result['message']
                ]);
                return response()->json($result, 400);
            }

            return redirect()->route('sinhvien.dangky')
                ->with('success', 'Phân lớp thành công');

        } catch (\Exception $e) {
            Log::error('Controller: Error in assignStudent', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi phân lớp'
            ], 500);
        }
    }
}
