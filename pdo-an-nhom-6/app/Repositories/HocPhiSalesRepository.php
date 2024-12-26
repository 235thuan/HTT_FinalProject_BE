<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class HocPhiSalesRepository
{
    /**
     * Lấy tổng số tiền học phí đã thu
     */
    public function getTotalPaid()
    {
        try {
            return DB::table('hocphi')->sum('so_tien');
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiSalesRepository::getTotalPaid: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Lấy thống kê theo lớp
     */
    public function getClassSummary()
    {
        try {
            return DB::table('hocphi as hp')
                ->join('sinhvien as sv', 'hp.id_sinhvien', '=', 'sv.id_sinhvien')
                ->select(
                    'sv.lop',
                    DB::raw('COUNT(DISTINCT hp.id_sinhvien) as total_students'),
                    DB::raw('SUM(hp.so_tien) as total_paid')
                )
                ->groupBy('sv.lop')
                ->orderBy('sv.lop')
                ->get();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiSalesRepository::getClassSummary: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Lấy chi tiết học phí theo lớp
     */
    public function getClassDetail($lop)
    {
        try {
            return DB::table('hocphi as hp')
                ->join('sinhvien as sv', 'hp.id_sinhvien', '=', 'sv.id_sinhvien')
                ->select(
                    'sv.id_sinhvien',
                    'sv.ten_sinhvien',
                    'hp.so_tien'

                )
                ->where('sv.lop', $lop)
                ->orderBy('sv.ten_sinhvien')
                ->get();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiSalesRepository::getClassDetail: ' . $e->getMessage());
            throw $e;
        }
    }
}
