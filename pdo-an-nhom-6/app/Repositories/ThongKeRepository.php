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
                ->join('khoa', 'chuyennganh.id_khoa', '=', 'khoa.id_khoa')
                ->leftJoin('lop as l','chuyennganh.id_chuyennganh','=','l.id_chuyennganh')
                ->join('sinhvien as sv','sv.id_lop','=','l.id_lop')
                ->select(
                    'chuyennganh.id_chuyennganh',
                    'chuyennganh.ten_chuyennganh',
                    'khoa.id_khoa',
                    'khoa.ten_khoa',
                    DB::raw('COUNT(sv.id_sinhvien) as so_sinh_vien')
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

            throw $e;
        }
    }
}
