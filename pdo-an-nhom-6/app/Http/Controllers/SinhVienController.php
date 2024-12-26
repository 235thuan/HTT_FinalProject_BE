<?php

namespace App\Http\Controllers;

use App\Services\Thuan\KhoaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SinhVienController extends Controller
{
    protected $khoaService;
    public function __construct(    KhoaService $khoaService){  $this->khoaService=$khoaService;}
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
            // Store return URL parameters
            session([
                'return_page' => request('return_page', 1),
                'return_lop' => request('lop')
            ]);

            $sinhvien = DB::table('sinhvien')
                ->join('nguoidung', 'sinhvien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->where('sinhvien.id_sinhvien', $id)
                ->first();

            if (!$sinhvien) {
                return redirect()->back()->with('error', 'Không tìm thấy sinh viên');
            }

            $lops = DB::table('lop')->get();

            return view('qlnd.editStudent', compact('sinhvien', 'lops'));
        } catch (\Exception $e) {
            \Log::error('Error in SinhVienController@edit: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'ten_sinhvien' => 'required',
                'lop' => 'required|exists:lop,ten_lop',
                'nam_vao_hoc' => 'required|numeric',
                'email' => 'required|email',
                'so_dien_thoai' => 'required'
            ]);

            // Update sinhvien
            DB::table('sinhvien')
                ->where('id_sinhvien', $id)
                ->update([
                    'ten_sinhvien' => $validated['ten_sinhvien'],
                    'lop' => $validated['lop'],
                    'nam_vao_hoc' => $validated['nam_vao_hoc']
                ]);

            // Get sinhvien record
            $sinhvien = DB::table('sinhvien')
                ->where('id_sinhvien', $id)
                ->first();

            // Update nguoidung
            DB::table('nguoidung')
                ->where('id_nguoidung', $sinhvien->id_nguoidung)
                ->update([
                    'email' => $validated['email'],
                    'so_dien_thoai' => $validated['so_dien_thoai']
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công',
                'data' => [
                    'id' => $id,
                    'ten_sinhvien' => $validated['ten_sinhvien'],
                    'lop' => $validated['lop'],
                    'nam_vao_hoc' => $validated['nam_vao_hoc'],
                    'email' => $validated['email'],
                    'so_dien_thoai' => $validated['so_dien_thoai']
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in SinhVienController@update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Có lỗi xảy ra: ' . $e->getMessage()
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
                ->join('chuyennganh', 'sinhvien.ma_chuyen_nganh', '=', 'chuyennganh.id_chuyennganh')
                ->join('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
                ->where('sinhvien.id_sinhvien', $id)
                ->select(
                    'sinhvien.*',
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
            $request->validate([
                'ten_sinhvien' => 'required',
                'email' => 'required|email',
                'lop' => 'required',
                'ma_chuyen_nganh' => 'required',
                'nam_vao_hoc' => 'required|numeric'
            ]);

            // Start transaction
            DB::beginTransaction();

            // Generate new student ID
            $lastId = DB::table('sinhvien')
                ->orderBy('id_sinhvien', 'desc')
                ->value('id_sinhvien') ?? 0;

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
                    'trang_thai' => 'hoạt động'
                ]);
            }

            // Assign student role (id_vaitro = 3)
            DB::table('phanquyen')->insert([
                'id_nguoidung' => $id_nguoidung,
                'id_vaitro' => 3
            ]);

            // Create new sinh vien
            DB::table('sinhvien')->insert([
                'id_sinhvien' => $newId,
                'id_nguoidung' => $id_nguoidung,
                'ten_sinhvien' => $request->ten_sinhvien,
                'lop' => $request->lop,
                'ma_chuyen_nganh' => $request->ma_chuyen_nganh,
                'nam_vao_hoc' => $request->nam_vao_hoc
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'data' => [
                    'id_sinhvien' => $newId,
                    'ten_sinhvien' => $request->ten_sinhvien,
                    'email' => $request->email,
                    'so_dien_thoai' => null,
                    'nam_vao_hoc' => $request->nam_vao_hoc,
                    'lop' => $request->lop
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'errors' => ['general' => [$e->getMessage()]]
            ], 500);
        }
    }
}
