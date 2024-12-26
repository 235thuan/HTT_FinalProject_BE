<?php

namespace App\Services\Thuan;

use App\Repositories\MonHocRepository;
use Illuminate\Support\Facades\Log;

class MonHocService
{
    protected $monHocRepository;

    public function __construct(MonHocRepository $monHocRepository)
    {
        $this->monHocRepository = $monHocRepository;
    }

    public function getMonHocForHomePage(): array
    {
        try {
            $monHocs = $this->monHocRepository->getAllMonHoc();

            if ($monHocs->isEmpty()) {
                return [
                    'success' => true,
                    'monHocs' => collect(),
                ];
            }

            return [
                'success' => true,
                'monHocs' => $monHocs
            ];

        } catch (\Exception $e) {
            Log::error('Lỗi trong MonHocService: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy dữ liệu môn học',
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllMonHoc()
    {
        try {
            $monhocs = $this->monHocRepository->getAll();

            return [
                'success' => true,
                'data' => $monhocs
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MonHocService::getAllMonHoc: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải danh sách môn học',
                'data' => []
            ];
        }
    }
}
