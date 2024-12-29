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
            return DB::table('hocphi as hp')
                ->join('chitiethocphi as cthp', 'hp.id_hocphi', '=', 'cthp.id_hocphi')
                ->select(DB::raw('SUM(cthp.so_tien) as total_paid'))
                ->first()
                ->total_paid ?? 0;
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
                ->join('lop as l', 'sv.id_lop', '=', 'l.id_lop')
                ->join('chitiethocphi as cthp', 'hp.id_hocphi', '=', 'cthp.id_hocphi')
                ->select(
                    'l.ten_lop',
                    DB::raw('COUNT(DISTINCT hp.id_sinhvien) as total_students'),
                    DB::raw('SUM(cthp.so_tien) as total_paid')
                )
                ->groupBy('l.ten_lop')
                ->orderBy('l.ten_lop')
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
                ->join('lop as l', 'sv.id_lop', '=', 'l.id_lop')
                ->join('chitiethocphi as cthp', 'hp.id_hocphi', '=', 'cthp.id_hocphi')
                ->select(
                    'sv.id_sinhvien',
                    'sv.ten_sinhvien', 
                    'cthp.ten_khoan_phi',
                    'cthp.so_tien'
                )
                ->where('l.ten_lop', $lop)
                ->orderBy('sv.ten_sinhvien')
                ->orderBy('cthp.ngay_ap_dung')
                ->get();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiSalesRepository::getClassDetail: ' . $e->getMessage());
            throw $e;
        }
    }
}
