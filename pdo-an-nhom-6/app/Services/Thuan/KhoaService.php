<?php

namespace App\Services\Thuan;

use App\Repositories\KhoaRepository;

class KhoaService
{
    protected $khoaRepository;

    public function __construct(KhoaRepository $khoaRepository)
    {
        $this->khoaRepository = $khoaRepository;
    }

    /**
     * Lấy danh sách khoa và chuyên ngành
     */
    public function getKhoasWithChuyenNganh()
    {
        try {
            $khoas = $this->khoaRepository->getKhoasWithChuyenNganh();

            return [
                'success' => true,
                'data' => $khoas
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong KhoaService::getKhoasWithChuyenNganh: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải danh sách khoa'
            ];
        }
    }
}
