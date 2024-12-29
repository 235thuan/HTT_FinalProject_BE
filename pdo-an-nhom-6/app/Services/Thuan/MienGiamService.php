<?php

namespace App\Services\Thuan;

use App\Repositories\MienGiamRepository;
use Illuminate\Support\Facades\DB;

class MienGiamService
{
    protected $mienGiamRepository;

    public function __construct(MienGiamRepository $mienGiamRepository)
    {
        $this->mienGiamRepository = $mienGiamRepository;
    }

    public function getAllMienGiam()
    {
        try {
            $mienGiamList = $this->mienGiamRepository->getAll();
            return [
                'success' => true,
                'data' => $mienGiamList
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamService::getAllMienGiam: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách miễn giảm'
            ];
        }
    }

    public function getMonHocList()
    {
        try {
            $monHocList = $this->mienGiamRepository->getMonHocList();
            return [
                'success' => true,
                'data' => $monHocList
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamService::getMonHocList: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách môn học'
            ];
        }
    }
    public function checkOverlappingDates($idMonHoc, $ngayBatDau, $ngayKetThuc = null, $excludeId = null)
    {
        try {
            // Kiểm tra xem có miễn giảm nào đang active trong khoảng thời gian này không
            $existingMienGiam = $this->mienGiamRepository->findOverlappingMienGiam(
                $idMonHoc,
                $ngayBatDau,
                $ngayKetThuc,
                $excludeId
            );

            return !empty($existingMienGiam);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamService::checkOverlappingDates: ' . $e->getMessage());
            throw $e;
        }
    }
    public function getMienGiamById($id)
    {
        try {
            $mienGiam = $this->mienGiamRepository->findById($id);

            if (!$mienGiam) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy miễn giảm'
                ];
            }

            return [
                'success' => true,
                'data' => $mienGiam
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamService::getMienGiamById: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy thông tin miễn giảm'
            ];
        }
    }

    public function createMienGiam(array $data)
    {
        try {
            DB::beginTransaction();

            $mienGiam = $this->mienGiamRepository->create($data);

            DB::commit();

            return [
                'success' => true,
                'data' => $mienGiam
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi trong MienGiamService::createMienGiam: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi thêm miễn giảm'
            ];
        }
    }

    public function updateMienGiam($id, array $data)
    {
        try {
            DB::beginTransaction();

            $updated = $this->mienGiamRepository->update($id, $data);

            if (!$updated) {
                DB::rollBack();
                return [
                    'success' => false,
                    'message' => 'Không thể cập nhật miễn giảm'
                ];
            }

            DB::commit();

            return [
                'success' => true,
                'data' => $updated
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi trong MienGiamService::updateMienGiam: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật miễn giảm'
            ];
        }
    }

    public function deleteMienGiam($id)
    {
        try {
            DB::beginTransaction();

            // Xóa tất cả các bản ghi liên quan trong chitiethocphi
            $deletedDetailsCount = DB::table('chitiethocphi')
                ->where('id_mien_giam', $id)
                ->delete();

            // Log số bản ghi đã xóa một cách chính xác
            \Log::info('Đã xóa ' . $deletedDetailsCount . ' bản ghi từ chitiethocphi');

            // Xóa bản ghi trong mien_giam_hoc_phi
            $deletedMienGiam = DB::table('mien_giam_hoc_phi')
                ->where('id_mien_giam', $id)
                ->delete();

            if (!$deletedMienGiam) {
                DB::rollBack();
                \Log::warning('Không thể xóa bản ghi từ mien_giam_hoc_phi');
                return [
                    'success' => false,
                    'message' => 'Không thể xóa miễn giảm'
                ];
            }

            DB::commit();
            \Log::info('Xóa miễn giảm thành công. ID: ' . $id);
            return [
                'success' => true,
                'message' => 'Xóa miễn giảm thành công'
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi trong MienGiamService::deleteMienGiam: ' . $e->getMessage());
            \Log::error('Chi tiết lỗi:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa miễn giảm'
            ];
        }
    }
}
