<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use App\Models\MonHoc;
use App\Models\SinhVien;
use App\Models\GiaoVien;
use App\Models\Lop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ClientChuyennganhController extends Controller
{

    public function index()
    {
        try {
            $monHocs = collect([]);
            $soSinhVien=collect([]);
            $lops = collect([]);
            $userRole = null;

            if (Auth::check()) {
                $userId = Auth::user()->id_nguoidung;
                Log::info('Starting query for user ID: ' . $userId);

                // Check user role from phanquyen
                $vaiTro = DB::table('phanquyen')
                    ->where('id_nguoidung', $userId)
                    ->value('id_vaitro');

                Log::info('User vaiTro: ' . $vaiTro);

                // For Sinh Viên (id_vaitro = 3)
                if ($vaiTro == 3) {
                    $userRole = 'student';

                    // 1. Get student's lop info
                    $studentLop = DB::table('sinhvien')
                        ->where('id_nguoidung', $userId)
                        ->value('id_lop');

                    if ($studentLop) {
                        // 2. Get student's chuyennganh
                        $chuyenNganh = DB::table('lop')
                            ->where('id_lop', $studentLop)
                            ->value('id_chuyennganh');

                        $lopList = DB::table('lop')
                            ->where('id_chuyennganh', $chuyenNganh)
                            ->pluck('id_lop');


                        $soSinhVien = DB::table('sinhvien')
                            ->whereIn('id_lop', $lopList)
                            ->count();



                        // 3. Get monhoc list for student
                        $monHocs = MonHoc::select([
                            'monhoc.*',
                            'file_upload.duong_dan as image_url'
                        ])
                            ->leftJoin('file_upload', function($join) {
                                $join->on('monhoc.id_monhoc', '=', 'file_upload.id_monhoc')
                                    ->where('file_upload.loai_file', 'image');
                            })
                            ->join('chuyennganh', 'monhoc.id_chuyennganh', '=', 'chuyennganh.id_chuyennganh')
                            ->join('lop', 'chuyennganh.id_chuyennganh', '=', 'lop.id_chuyennganh')
                            ->where('lop.id_lop', $studentLop)
                            ->get();

                        // 4. Get lop list with same chuyennganh
                        $lops = DB::table('lop')
                            ->select([
                                'lop.*',
                                'chuyennganh.ten_chuyennganh',
                                DB::raw('(SELECT COUNT(*) FROM sinhvien WHERE sinhvien.id_lop = lop.id_lop) as so_luong_sv')
                            ])
                            ->join('chuyennganh', 'lop.id_chuyennganh', '=', 'chuyennganh.id_chuyennganh')
                            ->where('lop.id_chuyennganh', $chuyenNganh)
                            ->get();
                    }
                }
                // For Giáo Viên (id_vaitro = 4)
                elseif ($vaiTro == 4) {
                    $userRole = 'teacher';

                    // 1. Get teacher's khoa
                    $teacherKhoa = DB::table('giaovien')
                        ->where('id_nguoidung', $userId)
                        ->value('id_khoa');

                    if ($teacherKhoa) {
                        // 2. Get monhoc list for teacher
                        $monHocs = MonHoc::select([
                            'monhoc.*',
                            'file_upload.duong_dan as image_url'
                        ])
                            ->leftJoin('file_upload', function($join) {
                                $join->on('monhoc.id_monhoc', '=', 'file_upload.id_monhoc')
                                    ->where('file_upload.loai_file', 'image');
                            })
                            ->join('chuyennganh', 'monhoc.id_chuyennganh', '=', 'chuyennganh.id_chuyennganh')
                            ->where('chuyennganh.id_khoa', $teacherKhoa)
                            ->get();
                        // 2. Lấy danh sách lớp thuộc khoa
                        $lopList = DB::table('lop')
                            ->join('chuyennganh', 'lop.id_chuyennganh', '=', 'chuyennganh.id_chuyennganh')
                            ->where('chuyennganh.id_khoa', $teacherKhoa)
                            ->pluck('lop.id_lop');

                        // 3. Đếm số sinh viên trong các lớp này
                        $soSinhVien = DB::table('sinhvien')
                            ->whereIn('id_lop', $lopList)
                            ->count();
                        // 3. Get lop list for all chuyennganh in teacher's khoa
                        $lops = DB::table('lop')
                            ->select([
                                'lop.*',
                                'chuyennganh.ten_chuyennganh',
                                DB::raw('(SELECT COUNT(*) FROM sinhvien WHERE sinhvien.id_lop = lop.id_lop) as so_luong_sv')
                            ])
                            ->join('chuyennganh', 'lop.id_chuyennganh', '=', 'chuyennganh.id_chuyennganh')
                            ->where('chuyennganh.id_khoa', $teacherKhoa)
                            ->get();
                    }
                }

                Log::info('Query results:', [
                    'role' => $userRole,
                    'monHocs count' => $monHocs->count(),
                    'lops count' => $lops->count()
                ]);
            }

            return view('thuan.clientChuyennganh.clientCn', [
                'monHocs' => $monHocs,
                'lops' => $lops,
                'isLoggedIn' => Auth::check(),
                'userRole' => $userRole,
                'soSinhVien'=>$soSinhVien
            ]);

        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return view('thuan.clientChuyennganh.clientCn', [
                'error' => 'Có lỗi xảy ra khi tải dữ liệu',
                'monHocs' => collect([]),
                'lops' => collect([])
            ]);
        }
    }

    public function getSoSinhVien($id_chuyennganh)
    {
        try {
            // Get số sinh viên through lớp
            $soSinhVien = DB::table('sinhvien')
                ->join('lop', 'sinhvien.id_lop', '=', 'lop.id_lop')
                ->where('lop.id_chuyennganh', $id_chuyennganh)
                ->count();

            return response()->json([
                'status' => true,
                'so_sinh_vien' => $soSinhVien
            ]);
        } catch (\Exception $e) {
            \Log::error('Error getting so sinh vien: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra'
            ], 500);
        }
    }
}
