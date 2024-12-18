<?php

namespace App\Services\Thuan;

use App\Models\ChuyenNganh;
use App\Models\MonHoc;
use App\Repositories\ChuyenNganhRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class ChuyenNganhService
{
    /**
     * Repository xử lý dữ liệu chuyên ngành
     * @var ChuyenNganhRepository
     */
    protected ChuyenNganhRepository $chuyenNganhRepository;

    /**
     * Khởi tạo service với repository
     * @param ChuyenNganhRepository $chuyenNganhRepository
     */
    public function __construct(ChuyenNganhRepository $chuyenNganhRepository)
    {
        $this->chuyenNganhRepository = $chuyenNganhRepository;
    }

    /**
     * Lấy và xử lý danh sách chuyên ngành cho trang chủ
     * @return array{
     *     categories: Collection,
     *     totalGroups: int,
     *     success: bool,
     *     message?: string,
     *     error?: string
     * }
     */
    public function getChuyenNganhForHomePage(): array
    {
        try {
            // Lấy dữ liệu từ repository
            $chuyenNganhs = $this->chuyenNganhRepository->getChuyenNganhWithKhoaAndImage();



            if ($chuyenNganhs->isEmpty()) {
                return [
                    'success' => true,
                    'chuyenNganhs' => collect(),
                    'soNhom' => 0
                ];
            }

            // Xử lý dữ liệu
            $processedChuyenNganhs = $chuyenNganhs->map(function ($chuyenNganh) {
                return (object)[
                    'id_chuyennganh' => $chuyenNganh->id_chuyennganh,
                    'ten_chuyennganh' => $chuyenNganh->ten_chuyennganh,
                    'ten_khoa' => $chuyenNganh->ten_khoa,
                    'image_url' => $chuyenNganh->image_url
                ];
            });

            $soNhom = ceil($processedChuyenNganhs->count() / 4);

            return [
                'success' => true,
                'chuyenNganhs' => $processedChuyenNganhs,
                'soNhom' => $soNhom
            ];

        } catch (\Exception $e) {

            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy dữ liệu chuyên ngành',
                'error' => $e->getMessage()
            ];
        }
    }


    public function getChuyenNganhDetail($id): array
    {
        try {
            $chuyenNganh = $this->chuyenNganhRepository->getChuyenNganhById($id);
            $monHocs = $this->chuyenNganhRepository->getMonHocByChuyenNganh($id);


            return [
                'success' => true,
                'chuyenNganh' => $chuyenNganh,
                'monHocs' => $monHocs,
                'files' => []  // We'll handle files later
            ];

        } catch (\Exception $e) {
            Log::error('Lỗi trong ChuyenNganhService::getChuyenNganhDetail: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Không tìm thấy chuyên ngành này hoặc có lỗi xảy ra'
            ];
        }
    }
}
