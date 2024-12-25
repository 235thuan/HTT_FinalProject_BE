<?php

namespace App\Services\Thuan;

use App\Repositories\ThongKeRepository;

class ThongKeService
{
    protected $thongKeRepository;

    public function __construct(ThongKeRepository $thongKeRepository)
    {
        $this->thongKeRepository = $thongKeRepository;
    }

    public function getTopChuyenNganh()
    {
        try {
            $topChuyenNganhs = $this->thongKeRepository->getTopChuyenNganh();
            
            return [
                'success' => true,
                'data' => $topChuyenNganhs
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ThongKeService::getTopChuyenNganh: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy thông tin thống kê'
            ];
        }
    }
}