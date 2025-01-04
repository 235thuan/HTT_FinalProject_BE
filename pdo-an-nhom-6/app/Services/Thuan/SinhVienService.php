<?php

namespace App\Services\Thuan;

use App\Repositories\SinhVienRepository;
use Illuminate\Support\Facades\Log;

class SinhVienService
{
    protected $sinhVienRepository;

    public function __construct(SinhVienRepository $sinhVienRepository)
    {
        $this->sinhVienRepository = $sinhVienRepository;
    }



    public function getLopList()
    {
        try {
            Log::info('SinhVienService: Getting lop list');
            $lops = $this->sinhVienRepository->getLopList();

            Log::info('SinhVienService: Successfully retrieved lop list', [
                'count' => $lops->count()
            ]);

            return [
                'success' => true,
                'data' => $lops
            ];
        } catch (\Exception $e) {
            Log::error('SinhVienService: Error in getLopList', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách lớp'
            ];
        }
    }

    public function assignStudent($data)
    {
        try {

            $newId = $this->sinhVienRepository->assignStudent($data);


            return [
                'success' => true,
                'message' => 'Phân lớp thành công',
                'data' => ['id_sinhvien' => $newId]
            ];
        } catch (\Exception $e) {
            Log::error('SinhVienService: Error in assignStudent', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi phân lớp: ' . $e->getMessage()
            ];
        }
    }

    public function getStudentsLists()
    {
        try {
            return [
                'success' => true,
                'data' => $this->sinhVienRepository->getStudentsLists()
            ];
        } catch (\Exception $e) {
            Log::error('Error in getStudentsLists: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách sinh viên'
            ];
        }
    }
}
