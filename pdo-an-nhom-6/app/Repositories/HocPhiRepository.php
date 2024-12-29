<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class HocPhiRepository
{
    public function getAllHocPhi()
    {
        try {
            return DB::table('hocphi as hp')
                ->select([
                    'hp.id_hocphi',
                    'hp.id_sinhvien',
                    'hp.trang_thai',
                    'sv.ten_sinhvien',
                    'l.ten_lop',
                    DB::raw('SUM(ct.so_tien) as tong_tien'),
                    DB::raw('SUM(
                        CASE
                            WHEN mg.ty_le_mien_giam > 0
                            THEN ct.so_tien * mg.ty_le_mien_giam / 100
                            ELSE mg.so_tien_mien_giam
                        END
                    ) as tong_mien_giam')
                ])
                ->join('sinhvien as sv', 'hp.id_sinhvien', '=', 'sv.id_sinhvien')
                ->join('lop as l', 'sv.id_lop', '=', 'l.id_lop')
                ->leftJoin('chitiethocphi as ct', 'hp.id_hocphi', '=', 'ct.id_hocphi')
                ->leftJoin('mien_giam_hoc_phi as mg', 'ct.id_mien_giam', '=', 'mg.id_mien_giam')
                ->groupBy('hp.id_hocphi', 'hp.id_sinhvien', 'hp.trang_thai', 'sv.ten_sinhvien', 'l.ten_lop')
                ->get();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiRepository::getAllHocPhi: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getHocPhiDetail($id)
    {
        try {
            // Get học phí and sinh viên info with totals
            $hocphi = DB::table('hocphi as hp')
                ->select([
                    'hp.id_hocphi',
                    'hp.id_sinhvien',
                    'hp.trang_thai',
                    'sv.ten_sinhvien',
                    'l.ten_lop',
                    'nd.email',
                    'nd.so_dien_thoai',
                    'cn.ten_chuyennganh'
                ])
                ->join('sinhvien as sv', 'hp.id_sinhvien', '=', 'sv.id_sinhvien')
                ->join('nguoidung as nd', 'sv.id_nguoidung', '=', 'nd.id_nguoidung')
                ->join('lop as l', 'sv.id_lop', '=', 'l.id_lop')
                ->leftJoin('chuyennganh as cn', 'l.id_chuyennganh', '=', 'cn.id_chuyennganh')
                ->where('hp.id_hocphi', $id)
                ->first();

            if (!$hocphi) {
                return null;
            }

            // Get chi tiết học phí with calculations
            $chiTiet = DB::table('chitiethocphi as ct')
                ->select([
                    'ct.id_chitiethocphi',
                    'ct.ten_khoan_phi',
                    'ct.so_tien',
                    'm.id_monhoc',
                    'm.ten_monhoc',
                    'm.so_tin_chi',
                    'mg.id_mien_giam',
                    'mg.ty_le_mien_giam',
                    'mg.so_tien_mien_giam',
                    'mg.mo_ta as mo_ta_mien_giam',
                    DB::raw('CASE
                    WHEN mg.ty_le_mien_giam > 0
                    THEN ct.so_tien * mg.ty_le_mien_giam / 100
                    ELSE COALESCE(mg.so_tien_mien_giam, 0)
                END as tien_mien_giam')
                ])
                ->leftJoin('monhoc as m', 'ct.id_monhoc', '=', 'm.id_monhoc')
                ->leftJoin('mien_giam_hoc_phi as mg', 'ct.id_mien_giam', '=', 'mg.id_mien_giam')
                ->where('ct.id_hocphi', $id)
                ->get();

            // Calculate totals
            $tongTien = $chiTiet->sum('so_tien');
            $tongMienGiam = $chiTiet->sum(function($item) {
                return $item->tien_mien_giam ?? 0;
            });

            $hocphi->tong_tien = $tongTien;
            $hocphi->tong_mien_giam = $tongMienGiam;
            $hocphi->chi_tiet = $chiTiet;

            return $hocphi;

        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiRepository::getHocPhiDetail: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getHocPhiForEdit($id)
    {
        try {
            // Get học phí basic info
            $hocphi = DB::table('hocphi as hp')
                ->select([
                    'hp.id_hocphi',
                    'hp.id_sinhvien',
                    'hp.trang_thai',
                    'sv.ten_sinhvien',
                    'l.ten_lop',
                    'nd.email',
                    'nd.so_dien_thoai',
                    'cn.ten_chuyennganh'
                ])
                ->join('sinhvien as sv', 'hp.id_sinhvien', '=', 'sv.id_sinhvien')
                ->join('nguoidung as nd', 'sv.id_nguoidung', '=', 'nd.id_nguoidung')
                ->join('lop as l', 'sv.id_lop', '=', 'l.id_lop')
                ->leftJoin('chuyennganh as cn', 'l.id_chuyennganh', '=', 'cn.id_chuyennganh')
                ->where('hp.id_hocphi', $id)
                ->first();

            if (!$hocphi) return null;

            // Get chi tiết học phí with current miễn giảm
            $chiTiet = DB::table('chitiethocphi as ct')
                ->select([
                    'ct.id_chitiethocphi',
                    'ct.id_hocphi',
                    'ct.ten_khoan_phi',
                    'ct.so_tien',
                    'ct.id_mien_giam',
                    'm.id_monhoc',
                    'm.ten_monhoc',
                    'm.so_tin_chi',
                    'mg.ty_le_mien_giam',
                    'mg.so_tien_mien_giam',
                    'mg.mo_ta as mo_ta_mien_giam',
                    DB::raw('CASE
                    WHEN mg.ty_le_mien_giam > 0
                    THEN ct.so_tien * mg.ty_le_mien_giam / 100
                    ELSE COALESCE(mg.so_tien_mien_giam, 0)
                END as tien_mien_giam'),
                    DB::raw('ct.so_tien - CASE
                    WHEN mg.ty_le_mien_giam > 0
                    THEN ct.so_tien * mg.ty_le_mien_giam / 100
                    ELSE COALESCE(mg.so_tien_mien_giam, 0)
                END as thanh_tien')
                ])
                ->leftJoin('monhoc as m', 'ct.id_monhoc', '=', 'm.id_monhoc')
                ->leftJoin('mien_giam_hoc_phi as mg', 'ct.id_mien_giam', '=', 'mg.id_mien_giam')
                ->where('ct.id_hocphi', $id)
                ->get();

            // Get ALL available miễn giảm options
            $mienGiamList = DB::table('mien_giam_hoc_phi')
                ->select([
                    'id_mien_giam',
                    'id_monhoc',
                    'ty_le_mien_giam',
                    'so_tien_mien_giam',
                    'mo_ta',
                    'trang_thai',
                    'ngay_bat_dau',
                    'ngay_ket_thuc'
                ])
                ->where('trang_thai', 'active')
//                ->whereDate('ngay_bat_dau', '<=', now())
//                ->where(function($query) {
//                    $query->whereDate('ngay_ket_thuc', '>=', now())
//                        ->orWhereNull('ngay_ket_thuc');
//                })
                ->get();

            // Calculate totals
            $tongTien = $chiTiet->sum('so_tien');
            $tongMienGiam = $chiTiet->sum(function($item) {
                return $item->tien_mien_giam ?? 0;
            });

            // Convert to object with all required properties
            $hocphi = (object) array_merge((array) $hocphi, [
                'tong_tien' => $tongTien,
                'tong_mien_giam' => $tongMienGiam,
                'chi_tiet' => $chiTiet,
                'mien_giam_list' => $mienGiamList
            ]);

            return $hocphi;

        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiRepository::getHocPhiForEdit: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateMienGiam($idChiTietHocPhi, $idMienGiam)
    {
        try {
            return DB::table('chitiethocphi')
                ->where('id_chitiethocphi', $idChiTietHocPhi)
                ->update([
                    'id_mien_giam' => $idMienGiam
                ]);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiRepository::updateMienGiam: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateChiTietHocPhi($idChiTietHocPhi, $idMienGiam)
    {
        try {
            return DB::table('chitiethocphi')
                ->where('id_chitiethocphi', $idChiTietHocPhi)
                ->update([
                    'id_mien_giam' => $idMienGiam
                ]);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiRepository::updateChiTietHocPhi: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getTotalPaidAmount()
    {
        return DB::table('hocphi')
            ->sum('so_tien');
    }

    public function getClassSummary()
    {
        return DB::table('hocphi as hp')
            ->join('sinhvien as sv', 'hp.id_sinhvien', '=', 'sv.id_sinhvien')
            ->join('lop as l', 'sv.id_lop', '=', 'l.id_lop')
            ->groupBy('l.ten_lop')
            ->select(
                'l.ten_lop',
                DB::raw('COUNT(DISTINCT hp.id_sinhvien) as total_students'),
                DB::raw('SUM(hp.so_tien) as total_paid')
            )
            ->get();
    }

    public function getSalesDetailByClass($lop)
    {
        return DB::table('hocphi as hp')
            ->join('sinhvien as sv', 'hp.id_sinhvien', '=', 'sv.id_sinhvien')
            ->join('lop as l', 'sv.id_lop', '=', 'l.id_lop')
            ->where('l.ten_lop', $lop)
            ->select(
                'sv.id_sinhvien',
                'sv.ten_sinhvien',
                DB::raw('SUM(hp.so_tien) as so_tien')
            )
            ->groupBy('sv.id_sinhvien', 'sv.ten_sinhvien')
            ->get();
    }
}
