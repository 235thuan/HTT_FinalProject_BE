<?php

namespace App\Http\Controllers\Cuong;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index() 
    {
        try {
            // Lấy thông tin người dùng đang đăng nhập
            $userId = Auth::id();
            
            // Query để lấy thông tin profile
            $profileInfo = DB::table('nguoidung')
                ->join('phanquyen', 'nguoidung.id_nguoidung', '=', 'phanquyen.id_nguoidung')
                ->join('vaitro', 'phanquyen.id_vaitro', '=', 'vaitro.id_vaitro')
                ->where('nguoidung.id_nguoidung', $userId)
                ->select('nguoidung.*', 'vaitro.id_vaitro', 'vaitro.ten_vaitro')
                ->first();

            if (!$profileInfo) {
                return redirect()->back()->with('error', 'Không tìm thấy thông tin người dùng');
            }

            // Lấy tên người dùng dựa vào vai trò
            $userName = '';
            if ($profileInfo->id_vaitro == 3) { // Sinh viên
                $userName = DB::table('sinhvien')
                    ->where('id_nguoidung', $userId)
                    ->value('ten_sinhvien');
            } elseif ($profileInfo->id_vaitro == 4) { // Giáo viên
                $userName = DB::table('giaovien')
                    ->where('id_nguoidung', $userId)
                    ->value('ten_giaovien');
            }

            return view('cuong.tcn', [
                'profileName' => $userName ?? 'Chưa cập nhật',
                'profileJob' => $profileInfo->ten_vaitro
            ]);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong ProfileController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tải thông tin profile');
        }
    }
}
