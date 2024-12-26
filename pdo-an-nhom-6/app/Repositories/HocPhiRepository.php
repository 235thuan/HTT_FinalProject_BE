<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class HocPhiRepository
{
    // Lấy danh sách học phí
    public function getHocPhiWithDetails()
    {
        try {
            return DB::table('hocphi as hp')
                ->join('sinhvien as sv', 'hp.id_sinhvien', '=', 'sv.id_sinhvien')
                ->select(
                    'hp.id_hocphi',
                    'hp.id_sinhvien',
                    'hp.trang_thai',
                    'sv.ten_sinhvien',
                    DB::raw('(SELECT COALESCE(SUM(so_tien), 0) FROM chitiethocphi WHERE id_hocphi = hp.id_hocphi) as tong_tien'),
                    DB::raw('(SELECT COALESCE(SUM(mien_giam), 0) FROM chitiethocphi WHERE id_hocphi = hp.id_hocphi) as tong_mien_giam')
                )
                ->orderBy('hp.id_hocphi', 'desc')
                ->get();
        } catch (\Exception $e) {

            throw $e;
        }
    }

    // Lấy chi tiết một học phí theo ID
    public function getHocPhiById($id)
    {
        try {
            $hocphi = DB::table('hocphi as hp')
                ->select(
                    'hp.*',
                    'sv.ten_sinhvien',
                    'sv.lop',
                    'nd.email',
                    'nd.so_dien_thoai',
                    'cn.ten_chuyennganh',
                    DB::raw('(SELECT COALESCE(SUM(ct.so_tien), 0) FROM chitiethocphi ct WHERE ct.id_hocphi = hp.id_hocphi) as tong_tien'),
                    DB::raw('(SELECT COALESCE(SUM(ct.mien_giam), 0) FROM chitiethocphi ct WHERE ct.id_hocphi = hp.id_hocphi) as tong_mien_giam')
                )
                ->join('sinhvien as sv', 'hp.id_sinhvien', '=', 'sv.id_sinhvien')
                ->join('nguoidung as nd', 'sv.id_nguoidung', '=', 'nd.id_nguoidung')
                ->leftJoin('chuyennganh as cn', 'sv.ma_chuyen_nganh', '=', 'cn.id_chuyennganh')
                ->where('hp.id_hocphi', $id)
                ->first();

            if ($hocphi) {
                // Lấy chi tiết học phí với thông tin miễn giảm
                $hocphi->chitiethocphi = DB::table('chitiethocphi as ct')
                    ->select(
                        'ct.*',
                        'm.ten_monhoc',
                        'm.so_tin_chi',
                        'mg.ty_le_mien_giam',
                        'mg.so_tien_mien_giam',
                        'mg.mo_ta as mo_ta_mien_giam'
                    )
                    ->leftJoin('monhoc as m', 'ct.id_monhoc', '=', 'm.id_monhoc')
                    ->leftJoin('mien_giam_hoc_phi as mg', 'ct.id_mien_giam', '=', 'mg.id_mien_giam')
                    ->where('ct.id_hocphi', $id)
                    ->get();
            }

            return $hocphi;
        } catch (\Exception $e) {

            throw $e;
        }
    }

    public function updateMienGiam($id, $mienGiamData)
    {
        try {
            DB::beginTransaction();

            // Lấy thông tin chi tiết học phí
            $chiTiet = DB::table('chitiethocphi')
                ->where('id_chitiethocphi', $id)
                ->first();

            if (!$chiTiet) {
                throw new \Exception('Không tìm thấy chi tiết học phí');
            }

            // Cập nhật miễn giảm
            $updateData = [
                'mien_giam' => $mienGiamData['so_tien'],
                'ly_do_mien_giam' => $mienGiamData['ly_do'],
                'ngay_ap_dung' => now(),
            ];

            // Nếu có áp dụng rule miễn giảm
            if (!empty($mienGiamData['id_mien_giam'])) {
                $updateData['id_mien_giam'] = $mienGiamData['id_mien_giam'];
            }

            DB::table('chitiethocphi')
                ->where('id_chitiethocphi', $id)
                ->update($updateData);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    // Lấy chi tiết học phí theo ID học phí
    private function getChiTietHocPhiById($id)
    {
        try {
            return DB::table('chitiethocphi as ct')
                ->select(
                    'ct.*',
                    'm.ten_monhoc'
                )
                ->leftJoin('monhoc as m', 'ct.id_monhoc', '=', 'm.id_monhoc')
                ->where('ct.id_hocphi', $id)
                ->get();
        } catch (\Exception $e) {

            throw $e;
        }
    }

    // Lấy danh sách chi tiết học phí cho trang miễn giảm
    public function getChiTietHocPhi()
    {
        try {
            return DB::table('chitiethocphi as ct')
                ->join('hocphi as hp', 'ct.id_hocphi', '=', 'hp.id_hocphi')
                ->join('sinhvien as sv', 'hp.id_sinhvien', '=', 'sv.id_sinhvien')
                ->leftJoin('monhoc as m', 'ct.id_monhoc', '=', 'm.id_monhoc')
                ->select(
                    'ct.*',
                    'sv.ten_sinhvien',
                    'm.ten_monhoc',
                    'hp.trang_thai'
                )
                ->where('hp.trang_thai', '!=', 'Đã thanh toán')
                ->get();
        } catch (\Exception $e) {

            throw $e;
        }
    }


}
