<?php

namespace App\Services\Thuan;

use App\Repositories\HocPhiRepository;
use App\Repositories\MienGiamRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HocPhiService
{
    protected $hocPhiRepository;
    protected $mienGiamRepository;

    public function __construct(HocPhiRepository $hocPhiRepository, MienGiamRepository $mienGiamRepository)
    {
        $this->hocPhiRepository = $hocPhiRepository;
        $this->mienGiamRepository = $mienGiamRepository;
    }

    // Lấy danh sách học phí
    public function getAllHocPhi()
    {
        try {
            $hocPhiList = $this->hocPhiRepository->getHocPhiWithDetails();
            return [
                'success' => true,
                'data' => $hocPhiList
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiService::getAllHocPhi: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách học phí'
            ];
        }
    }

    // Lấy chi tiết học phí theo ID
    public function getHocPhiDetail($id)
    {
        try {
            $hocphi = $this->hocPhiRepository->getHocPhiById($id);

            if (!$hocphi) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy thông tin học phí'
                ];
            }

            return [
                'success' => true,
                'data' => $hocphi
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiService::getHocPhiDetail: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy thông tin chi tiết học phí'
            ];
        }
    }

    // Lấy danh sách chi tiết học phí cho trang miễn giảm
    public function getChiTietHocPhi()
    {
        try {
            $chiTietList = $this->hocPhiRepository->getChiTietHocPhi();
            return [
                'success' => true,
                'data' => $chiTietList
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiService::getChiTietHocPhi: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy chi tiết học phí'
            ];
        }
    }


    public function getAllMienGiam()
    {
        try {
            $mienGiams = $this->mienGiamRepository->getAll();

            // Format dates for display
            foreach ($mienGiams as $mienGiam) {
                $mienGiam->ngay_bat_dau = Carbon::parse($mienGiam->ngay_bat_dau)->format('d/m/Y');
                if ($mienGiam->ngay_ket_thuc) {
                    $mienGiam->ngay_ket_thuc = Carbon::parse($mienGiam->ngay_ket_thuc)->format('d/m/Y');
                }
            }

            return [
                'success' => true,
                'data' => $mienGiams
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiService::getAllMienGiam: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải danh sách miễn giảm'
            ];
        }
    }

    public function getMienGiam($id)
    {
        try {
            $mienGiam = $this->mienGiamRepository->find($id);

            if (!$mienGiam) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy thông tin miễn giảm'
                ];
            }

            // Format dates for display
            $mienGiam->ngay_bat_dau = Carbon::parse($mienGiam->ngay_bat_dau)->format('d/m/Y');
            if ($mienGiam->ngay_ket_thuc) {
                $mienGiam->ngay_ket_thuc = Carbon::parse($mienGiam->ngay_ket_thuc)->format('d/m/Y');
            }

            return [
                'success' => true,
                'data' => $mienGiam
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiService::getMienGiam: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải thông tin miễn giảm'
            ];
        }
    }

    public function createMienGiam(array $data)
    {
        DB::beginTransaction();
        try {
            // Chuyển đổi format ngày từ d/m/Y sang Y-m-d
            $ngayBatDau = Carbon::createFromFormat('d/m/Y', $data['ngay_bat_dau'])->format('Y-m-d');
            $ngayKetThuc = isset($data['ngay_ket_thuc']) ?
                Carbon::createFromFormat('d/m/Y', $data['ngay_ket_thuc'])->format('Y-m-d') : null;

            // Kiểm tra trùng lặp thời gian
            if ($this->mienGiamRepository->checkExistingDiscount(
                $data['id_monhoc'],
                $ngayBatDau,
                $ngayKetThuc ?? $ngayBatDau
            )) {
                return [
                    'success' => false,
                    'message' => 'Đã tồn tại miễn giảm trong khoảng thời gian này'
                ];
            }

            // Chuẩn bị dữ liệu
            $mienGiamData = [
                'id_monhoc' => $data['id_monhoc'],
                'ngay_bat_dau' => $ngayBatDau,
                'ngay_ket_thuc' => $ngayKetThuc,
                'mo_ta' => $data['mo_ta'] ?? null,
            ];

            // Thêm tỷ lệ hoặc số tiền miễn giảm
            if ($data['discount_type'] === 'percent') {
                $mienGiamData['ty_le_mien_giam'] = $data['ty_le_mien_giam'];
                $mienGiamData['so_tien_mien_giam'] = null;
            } else {
                $mienGiamData['ty_le_mien_giam'] = null;
                $mienGiamData['so_tien_mien_giam'] = $data['so_tien_mien_giam'];
            }

            $result = $this->mienGiamRepository->create($mienGiamData);

            if (!$result) {
                DB::rollBack();
                return [
                    'success' => false,
                    'message' => 'Không thể thêm miễn giảm'
                ];
            }

            DB::commit();
            return [
                'success' => true,
                'message' => 'Thêm miễn giảm thành công'
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi trong HocPhiService::createMienGiam: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi thêm miễn giảm'
            ];
        }
    }

    public function updateMienGiam($id, array $data)
    {
        DB::beginTransaction();
        try {
            // Kiểm tra tồn tại
            if (!$this->mienGiamRepository->find($id)) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy thông tin miễn giảm'
                ];
            }

            // Chuyển đổi format ngày
            $ngayBatDau = Carbon::createFromFormat('d/m/Y', $data['ngay_bat_dau'])->format('Y-m-d');
            $ngayKetThuc = isset($data['ngay_ket_thuc']) ?
                Carbon::createFromFormat('d/m/Y', $data['ngay_ket_thuc'])->format('Y-m-d') : null;

            // Kiểm tra trùng lặp thời gian
            if ($this->mienGiamRepository->checkExistingDiscount(
                $data['id_monhoc'],
                $ngayBatDau,
                $ngayKetThuc ?? $ngayBatDau,
                $id
            )) {
                return [
                    'success' => false,
                    'message' => 'Đã tồn tại miễn giảm trong khoảng thời gian này'
                ];
            }

            // Chuẩn bị dữ liệu
            $mienGiamData = [
                'id_monhoc' => $data['id_monhoc'],
                'ngay_bat_dau' => $ngayBatDau,
                'ngay_ket_thuc' => $ngayKetThuc,
                'mo_ta' => $data['mo_ta'] ?? null,
                'trang_thai' => 'active'
            ];

            // Cập nhật tỷ lệ hoặc số tiền miễn giảm
            if ($data['discount_type'] === 'percent') {
                $mienGiamData['ty_le_mien_giam'] = $data['ty_le_mien_giam'];
                $mienGiamData['so_tien_mien_giam'] = null;
            } else {
                $mienGiamData['ty_le_mien_giam'] = null;
                $mienGiamData['so_tien_mien_giam'] = $data['so_tien_mien_giam'];
            }

            $result = $this->mienGiamRepository->update($id, $mienGiamData);

            if (!$result) {
                DB::rollBack();
                return [
                    'success' => false,
                    'message' => 'Không thể cập nhật miễn giảm'
                ];
            }

            DB::commit();
            return [
                'success' => true,
                'message' => 'Cập nhật miễn giảm thành công'
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi trong HocPhiService::updateMienGiam: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật miễn giảm'
            ];
        }
    }

    public function deleteMienGiam($id)
    {
        DB::beginTransaction();
        try {
            // Kiểm tra tồn tại
            if (!$this->mienGiamRepository->find($id)) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy thông tin miễn giảm'
                ];
            }

            $result = $this->mienGiamRepository->delete($id);

            if (!$result) {
                DB::rollBack();
                return [
                    'success' => false,
                    'message' => 'Không thể xóa miễn giảm'
                ];
            }

            DB::commit();
            return [
                'success' => true,
                'message' => 'Xóa miễn giảm thành công'
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi trong HocPhiService::deleteMienGiam: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa miễn giảm'
            ];
        }
    }
}
