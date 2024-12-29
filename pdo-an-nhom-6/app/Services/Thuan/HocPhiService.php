<?php

namespace App\Services\Thuan;

use App\Repositories\HocPhiRepository;
use App\Repositories\MienGiamRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HocPhiService
{
    protected $hocPhiRepository;

    public function __construct(HocPhiRepository $hocPhiRepository)
    {
        $this->hocPhiRepository = $hocPhiRepository;
    }

    public function getAllHocPhi()
    {
        try {
            $hocPhiList = $this->hocPhiRepository->getAllHocPhi();

            // Format dữ liệu
            $formattedData = $hocPhiList->map(function($item) {
                return [
                    'id_hocphi' => $item->id_hocphi,
                    'id_sinhvien' => $item->id_sinhvien,
                    'ten_sinhvien' => $item->ten_sinhvien,
                    'ten_lop' => $item->ten_lop,
                    'tong_tien' => $item->tong_tien,
                    'tong_mien_giam' => $item->tong_mien_giam,
                    'tong_phai_dong' => $item->tong_tien - $item->tong_mien_giam,
                    'trang_thai' => $item->trang_thai
                ];
            });

            return [
                'success' => true,
                'data' => $formattedData
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiService::getAllHocPhi: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách học phí'
            ];
        }
    }

    public function getHocPhiDetail($id)
    {
        try {
            $hocphi = $this->hocPhiRepository->getHocPhiDetail($id);

            if (!$hocphi) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy học phí'
                ];
            }

            // Format data
            $formattedData = [
                'id_hocphi' => $hocphi->id_hocphi,
                'sinh_vien' => [
                    'id' => $hocphi->id_sinhvien,
                    'ten' => $hocphi->ten_sinhvien,
                    'lop' => $hocphi->ten_lop,
                    'email' => $hocphi->email,
                    'so_dien_thoai' => $hocphi->so_dien_thoai,
                    'chuyen_nganh' => $hocphi->ten_chuyennganh
                ],
                'trang_thai' => $hocphi->trang_thai,
                'tong_tien' => $hocphi->tong_tien,
                'tong_mien_giam' => $hocphi->tong_mien_giam,
                'tong_phai_dong' => $hocphi->tong_tien - $hocphi->tong_mien_giam,
                'chi_tiet' => collect($hocphi->chi_tiet)->map(function($item) {
                    return [
                        'id' => $item->id_chitiethocphi,
                        'ten_khoan_phi' => $item->ten_khoan_phi,
                        'mon_hoc' => [
                            'id' => $item->id_monhoc,
                            'ten' => $item->ten_monhoc,
                            'so_tin_chi' => $item->so_tin_chi
                        ],
                        'so_tien' => $item->so_tien,
                        'mien_giam' => [
                            'id' => $item->id_mien_giam,
                            'ty_le' => $item->ty_le_mien_giam,
                            'so_tien_co_dinh' => $item->so_tien_mien_giam,
                            'mo_ta' => $item->mo_ta_mien_giam,
                            'tong_mien_giam' => $item->tien_mien_giam ?? 0  // Changed from 'tong_tien' to 'tong_mien_giam'
                        ],
                        'thanh_tien' => $item->so_tien - ($item->tien_mien_giam ?? 0)
                    ];
                })->all()
            ];

            return [
                'success' => true,
                'data' => $formattedData
            ];

        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiService::getHocPhiDetail: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy chi tiết học phí'
            ];
        }
    }

    public function getHocPhiForEdit($id)
    {
        try {
            $hocphi = $this->hocPhiRepository->getHocPhiForEdit($id);

            if (!$hocphi) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy học phí'
                ];
            }

            // Format data
            $formattedData = [
                'id_hocphi' => $hocphi->id_hocphi,
                'sinh_vien' => [
                    'id' => $hocphi->id_sinhvien,
                    'ten' => $hocphi->ten_sinhvien,
                    'lop' => $hocphi->ten_lop,
                    'email' => $hocphi->email,
                    'so_dien_thoai' => $hocphi->so_dien_thoai,
                    'chuyen_nganh' => $hocphi->ten_chuyennganh
                ],
                'trang_thai' => $hocphi->trang_thai,
                'tong_tien' => $hocphi->tong_tien,
                'tong_mien_giam' => $hocphi->tong_mien_giam,
                'tong_phai_dong' => $hocphi->tong_tien - $hocphi->tong_mien_giam,
                'chi_tiet' => collect($hocphi->chi_tiet)->map(function($item) {
                    return [
                        'id' => $item->id_chitiethocphi,
                        'id_hocphi' => $item->id_hocphi,
                        'ten_khoan_phi' => $item->ten_khoan_phi,
                        'mon_hoc' => [
                            'id' => $item->id_monhoc,
                            'ten' => $item->ten_monhoc,
                            'so_tin_chi' => $item->so_tin_chi
                        ],
                        'so_tien' => $item->so_tien,
                        'mien_giam' => [
                            'id' => $item->id_mien_giam,
                            'ty_le' => $item->ty_le_mien_giam,
                            'so_tien_co_dinh' => $item->so_tien_mien_giam,
                            'mo_ta' => $item->mo_ta_mien_giam,
                            'tien_mien_giam' => $item->tien_mien_giam
                        ],
                        'thanh_tien' => $item->thanh_tien
                    ];
                })->all(),
                'mien_giam_list' => collect($hocphi->mien_giam_list)->map(function($item) {
                    return [
                        'id_mien_giam' => $item->id_mien_giam,
                        'id_monhoc' => $item->id_monhoc,
                        'ty_le_mien_giam' => $item->ty_le_mien_giam,
                        'so_tien_mien_giam' => $item->so_tien_mien_giam,
                        'mo_ta' => $item->mo_ta
                    ];
                })->all()
            ];

            return [
                'success' => true,
                'data' => $formattedData
            ];

        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiService::getHocPhiForEdit: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy thông tin học phí'
            ];
        }
    }

    public function updateMienGiamByMonHoc($idHocPhi, $idMonHoc, $idMienGiam)
    {
        try {
            DB::beginTransaction();

            // Update all chi tiết học phí with matching môn học
            $updated = DB::table('chitiethocphi')
                ->where('id_hocphi', $idHocPhi)
                ->where('id_monhoc', $idMonHoc)
                ->update(['id_mien_giam' => $idMienGiam]);

            if ($updated === false) {
                DB::rollBack();
                return [
                    'success' => false,
                    'message' => 'Không thể cập nhật miễn giảm'
                ];
            }

            // Get updated totals
            $newTotals = $this->calculateHocPhiTotals($idHocPhi);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Cập nhật miễn giảm thành công',
                'data' => [
                    'tong_tien' => $newTotals->tong_tien,
                    'tong_mien_giam' => $newTotals->tong_mien_giam,
                    'tong_phai_dong' => $newTotals->tong_tien - $newTotals->tong_mien_giam
                ]
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi trong HocPhiService::updateMienGiamByMonHoc: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật miễn giảm'
            ];
        }
    }

    public function updateHocPhi($idHocPhi, array $chiTietList)
    {
        try {
            DB::beginTransaction();

            foreach ($chiTietList as $chiTiet) {
                $this->hocPhiRepository->updateChiTietHocPhi(
                    $chiTiet['id_chitiethocphi'],
                    $chiTiet['id_mien_giam']
                );
            }

            // Recalculate totals
            $totals = $this->calculateHocPhiTotals($idHocPhi);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Cập nhật học phí thành công',
                'data' => $totals
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi trong HocPhiService::updateHocPhi: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật học phí'
            ];
        }
    }

    private function calculateHocPhiTotals($idHocPhi)
    {
        $chiTiet = DB::table('chitiethocphi as ct')
            ->leftJoin('mien_giam_hoc_phi as mg', 'ct.id_mien_giam', '=', 'mg.id_mien_giam')
            ->where('ct.id_hocphi', $idHocPhi)
            ->select([
                'ct.so_tien',
                'mg.ty_le_mien_giam',
                'mg.so_tien_mien_giam'
            ])
            ->get();

        $tongTien = 0;
        $tongMienGiam = 0;

        foreach ($chiTiet as $item) {
            $tongTien += $item->so_tien;
            if ($item->ty_le_mien_giam > 0) {
                $tongMienGiam += ($item->so_tien * $item->ty_le_mien_giam / 100);
            }
            if ($item->so_tien_mien_giam > 0) {
                $tongMienGiam += $item->so_tien_mien_giam;
            }
        }

        return (object)[
            'tong_tien' => $tongTien,
            'tong_mien_giam' => $tongMienGiam
        ];
    }

    public function getSalesOverview()
    {
        try {
            $totalPaid = $this->hocPhiRepository->getTotalPaidAmount();
            $classSummary = $this->hocPhiRepository->getClassSummary();
            $totalClasses = $classSummary->count();

            return [
                'totalPaid' => $totalPaid,
                'totalClasses' => $totalClasses,
                'classSummary' => $classSummary
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiService::getSalesOverview: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getSalesDetailByClass($lop)
    {
        try {
            return $this->hocPhiRepository->getSalesDetailByClass($lop);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiService::getSalesDetailByClass: ' . $e->getMessage());
            throw $e;
        }
    }
}
