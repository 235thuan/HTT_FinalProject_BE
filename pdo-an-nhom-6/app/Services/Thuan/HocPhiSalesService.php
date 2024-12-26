<?php

namespace App\Services\Thuan;

use App\Repositories\HocPhiSalesRepository;

class HocPhiSalesService
{
    protected $salesRepository;

    public function __construct(HocPhiSalesRepository $salesRepository)
    {
        $this->salesRepository = $salesRepository;
    }

    /**
     * Lấy thống kê tổng quan
     */
    public function getSalesOverview()
    {
        try {
            $totalPaid = $this->salesRepository->getTotalPaid();
            $classSummary = $this->salesRepository->getClassSummary();
            $totalClasses = $classSummary->count();

            return [
                'success' => true,
                'data' => [
                    'totalPaid' => $totalPaid,
                    'totalClasses' => $totalClasses,
                    'classSummary' => $classSummary
                ]
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiSalesService::getSalesOverview: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải thống kê doanh thu'
            ];
        }
    }

    /**
     * Lấy chi tiết học phí theo lớp
     */
    public function getClassDetail($lop)
    {
        try {
            $students = $this->salesRepository->getClassDetail($lop);

            return [
                'success' => true,
                'data' => $students
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiSalesService::getClassDetail: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải chi tiết lớp'
            ];
        }
    }
}
