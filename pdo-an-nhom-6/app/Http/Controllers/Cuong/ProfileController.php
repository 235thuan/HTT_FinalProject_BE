<?php

namespace App\Http\Controllers\Cuong;

use App\Http\Controllers\Controller;
use App\Services\Thuan\KhoaService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $khoaService;
    public function __construct( KhoaService $khoaService)
    {
        $this->khoaService = $khoaService;
    }
    public function index()
    {
        try {
            $userId = Auth::id();

            // Get user role and basic info
            $profileInfo = DB::table('nguoidung')
                ->join('phanquyen', 'nguoidung.id_nguoidung', '=', 'phanquyen.id_nguoidung')
                ->join('vaitro', 'phanquyen.id_vaitro', '=', 'vaitro.id_vaitro')
                ->where('nguoidung.id_nguoidung', $userId)
                ->select('nguoidung.*', 'vaitro.id_vaitro', 'vaitro.ten_vaitro')
                ->first();

            if (!$profileInfo) {
                return redirect()->back()->with('error', 'Không tìm thấy thông tin người dùng');
            }

            $userName = '';
            $items = collect([]);

            // For Sinh viên (id_vaitro = 3)
            if ($profileInfo->id_vaitro == 3) {
                $userName = DB::table('sinhvien')
                    ->where('id_nguoidung', $userId)
                    ->value('ten_sinhvien');

                // Get subjects for student
                $items = DB::table('monhoc')
                    ->select('monhoc.*')
                    ->join('chuyennganh', 'monhoc.id_chuyennganh', '=', 'chuyennganh.id_chuyennganh')
                    ->join('lop', 'chuyennganh.id_chuyennganh', '=', 'lop.id_chuyennganh')
                    ->join('sinhvien', 'lop.id_lop', '=', 'sinhvien.id_lop')
                    ->where('sinhvien.id_nguoidung', $userId)
                    ->get();
            }
            // For Giáo viên (id_vaitro = 4)
            elseif ($profileInfo->id_vaitro == 4) {
                $userName = DB::table('giaovien')
                    ->where('id_nguoidung', $userId)
                    ->value('ten_giaovien');

                // Get classes for teacher
                $items = DB::table('lop')
                    ->select([
                        'lop.*',
                        'chuyennganh.ten_chuyennganh',
                        DB::raw('(SELECT COUNT(*) FROM sinhvien WHERE sinhvien.id_lop = lop.id_lop) as so_luong_sv')
                    ])
                    ->join('chuyennganh', 'lop.id_chuyennganh', '=', 'chuyennganh.id_chuyennganh')
                    ->join('giaovien', 'chuyennganh.id_khoa', '=', 'giaovien.id_khoa')
                    ->where('giaovien.id_nguoidung', $userId)
                    ->get();
            }

            $vaiTro = DB::table('phanquyen')
                ->where('id_nguoidung', $userId)
                ->value('id_vaitro');

            // Get schedule data
            $schedule = $this->getTimeTable($userId, $vaiTro);
            $currentWeek = now()->startOfWeek();

            // Get user data with role
            $user = DB::table('nguoidung')
                ->join('phanquyen', 'nguoidung.id_nguoidung', '=', 'phanquyen.id_nguoidung')
                ->where('nguoidung.id_nguoidung', $userId)
                ->select('nguoidung.*', 'phanquyen.id_vaitro')
                ->first();

            if (!$user) {
                throw new \Exception('Không tìm thấy thông tin người dùng');
            }
            return view('cuong.tcn', [
                'profileName' => $userName ?? 'Chưa cập nhật',
                'profileJob' => $profileInfo->ten_vaitro,
                'items' => $items,
                'vaiTro' => $profileInfo->id_vaitro,
                'currentWeek' => $currentWeek,
                'schedule' => $schedule,
                'user' => $user,
            ]);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong ProfileController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tải thông tin profile');
        }
    }

    public function admin()
    {
        try {
            // Lấy thông tin user hiện tại
            $user = Auth::user();
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();
            // Lấy thông tin chi tiết từ bảng users hoặc bảng liên quan
            $userDetails = DB::table('nguoidung')
                ->where('id_nguoidung', $user->id_nguoidung)
                ->first();

            return view('utility.profile', [
                'userDetails' => $userDetails,
                'khoas' => $khoaResult['success'] ? $khoaResult['data'] : collect([])
            ]);


        } catch (\Exception $e) {
            \Log::error('Lỗi trong ProfileController::index: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải trang profile');
        }
    }


    private function getTimeTable($userId, $vaiTro)
    {
        try {
            $currentWeek = now()->startOfWeek();
            $schedules = collect();

            if ($vaiTro == 3) { // Sinh viên
                // Get student's class
                $idLop = DB::table('sinhvien')
                    ->where('id_nguoidung', $userId)
                    ->value('id_lop');

                if ($idLop) {
                    // Get schedule for student's class
                    $schedules = DB::table('thoikhoabieu')
                        ->join('monhoc', 'thoikhoabieu.id_monhoc', '=', 'monhoc.id_monhoc')
                        ->join('giaovien', 'thoikhoabieu.id_giaovien', '=', 'giaovien.id_giaovien')
                        ->join('phonghoc', 'thoikhoabieu.id_phonghoc', '=', 'phonghoc.id_phonghoc')
                        ->where('thoikhoabieu.id_lop', $idLop)
                        ->whereBetween('ngay_hoc', [
                            $currentWeek->format('Y-m-d'),
                            $currentWeek->copy()->addDays(6)->format('Y-m-d')
                        ])
                        ->select(
                            'thoikhoabieu.*',
                            'monhoc.ten_monhoc',
                            'giaovien.ten_giaovien',
                            'phonghoc.ten_phonghoc',
                            'phonghoc.khu_vuc'
                        )
                        ->get();
                }
            } elseif ($vaiTro == 4) { // Giáo viên
                // Get teacher's department
                $idGiaovien = DB::table('giaovien')
                    ->where('id_nguoidung', $userId)
                    ->value('id_giaovien');

                if ($idGiaovien) {
                    // Get schedules only for this teacher
                    $schedules = DB::table('thoikhoabieu')
                        ->join('monhoc', 'thoikhoabieu.id_monhoc', '=', 'monhoc.id_monhoc')
                        ->join('giaovien', 'thoikhoabieu.id_giaovien', '=', 'giaovien.id_giaovien')
                        ->join('phonghoc', 'thoikhoabieu.id_phonghoc', '=', 'phonghoc.id_phonghoc')
                        ->join('lop', 'thoikhoabieu.id_lop', '=', 'lop.id_lop')
                        ->where('thoikhoabieu.id_giaovien', $idGiaovien) // Only get this teacher's schedule
                        ->whereBetween('ngay_hoc', [
                            $currentWeek->format('Y-m-d'),
                            $currentWeek->copy()->addDays(6)->format('Y-m-d')
                        ])
                        ->select(
                            'thoikhoabieu.*',
                            'monhoc.ten_monhoc',
                            'giaovien.ten_giaovien',
                            'phonghoc.ten_phonghoc',
                            'phonghoc.khu_vuc',
                            'lop.ten_lop'
                        )
                        ->orderBy('ngay_hoc')
                        ->orderBy('gio_bat_dau')
                        ->get();
                }
            }

            return $schedules;
        } catch (\Exception $e) {
            \Log::error('Error in getTimeTable: ' . $e->getMessage());
            return collect();
        }
    }

    public function updateInfo(Request $request)
    {
        try {
            $userId = Auth::id();

            // Validate the request
            $validated = $request->validate([
                'kinh_nghiem' => 'nullable|string|max:1000',
                'ky_nang_noi_bat' => 'nullable|string|max:500',
                'thanh_tich' => 'nullable|string|max:1000',
                'phuong_cham_song' => 'nullable|string|max:255',
                'so_dien_thoai' => 'nullable|string|max:15',
                'so_thich' => 'nullable|string|max:500'
            ]);

            // Update the user info
            DB::table('nguoidung')
                ->where('id_nguoidung', $userId)
                ->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Cập nhật thông tin thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateSecurity(Request $request)
    {
        try {
            $userId = Auth::id();

            // Validate the request
            $validated = $request->validate([
                'email' => 'required|email',
                'mat_khau_cu' => 'required',
                'mat_khau_moi' => 'required|min:6|different:mat_khau_cu',
                'mat_khau_xacnhan' => 'required|same:mat_khau_moi'
            ]);

            // Get current user
            $user = DB::table('nguoidung')
                ->where('id_nguoidung', $userId)
                ->first();

            // Verify current password
            if (!Hash::check($request->mat_khau_cu, $user->mat_khau)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Mật khẩu hiện tại không đúng!'
                ], 400);
            }

            // Update password and email
            DB::table('nguoidung')
                ->where('id_nguoidung', $userId)
                ->update([
                    'email' => $validated['email'],
                    'mat_khau' => Hash::make($validated['mat_khau_moi'])
                ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Cập nhật thông tin bảo mật thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getPaymentDetails($paymentId)
    {
        try {
            // Add logging to debug
            \Log::info('Payment ID: ' . $paymentId);

            // Get payment info with error handling
            $payment = DB::table('thanhtoan')
                ->where('id_thanhtoan', $paymentId)
                ->first();

            if (!$payment) {
                return response()->json(['error' => 'Không tìm thấy thông tin thanh toán'], 404);
            }

            \Log::info('Payment found: ', (array)$payment);

            // Get payment details with error handling
            $details = DB::table('chitiethocphi')
                ->leftJoin('monhoc', 'chitiethocphi.id_monhoc', '=', 'monhoc.id_monhoc')
                ->leftJoin('mien_giam_hoc_phi', 'chitiethocphi.id_mien_giam', '=', 'mien_giam_hoc_phi.id_mien_giam')
                ->where('chitiethocphi.id_hocphi', $payment->id_hocphi)
                ->select(
                    'chitiethocphi.*',
                    'monhoc.ten_monhoc',
                    DB::raw('COALESCE(mien_giam_hoc_phi.ty_le_mien_giam, 0) as ty_le_mien_giam')
                )
                ->get();

            \Log::info('Details found: ', $details->toArray());

            return response()->json([
                'status' => 'success',
                'payment' => $payment,
                'details' => $details
            ]);

        } catch (\Exception $e) {
            \Log::error('Payment details error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}
