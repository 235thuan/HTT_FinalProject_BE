<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ThongKeRepository
{
    public function getTopChuyenNganh()
    {
        try {
            // Lấy top 2 chuyên ngành có nhiều sinh viên nhất
            return DB::table('chuyennganh')
                ->join('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
                ->leftJoin('sinhvien', 'chuyennganh.id_chuyennganh', '=', 'sinhvien.ma_chuyen_nganh')
                ->select(
                    'chuyennganh.id_chuyennganh',
                    'chuyennganh.ten_chuyennganh',
                    'khoa.id_khoa',
                    'khoa.ten_khoa',
                    DB::raw('COUNT(sinhvien.id_sinhvien) as so_sinh_vien')
                )
                ->groupBy(
                    'chuyennganh.id_chuyennganh',
                    'chuyennganh.ten_chuyennganh',
                    'khoa.id_khoa',
                    'khoa.ten_khoa'
                )
                ->orderBy('so_sinh_vien', 'desc')
                ->limit(2)
                ->get();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ThongKeRepository::getTopChuyenNganh: ' . $e->getMessage());
            throw $e;
        }
    }
}