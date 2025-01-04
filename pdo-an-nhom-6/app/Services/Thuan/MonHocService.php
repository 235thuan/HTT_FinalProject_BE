<?php

namespace App\Services\Thuan;

use App\Repositories\MonHocRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MonHocService
{
    protected $monHocRepository;

    public function __construct(MonHocRepository $monHocRepository)
    {
        $this->monHocRepository = $monHocRepository;
    }


    public function getMonHocForHomePage()
    {
        try {
            if (!Auth::check()) {
                return [
                    'success' => true,
                    'monHocs' => collect([])
                ];
            }

            $userId = Auth::user()->id_nguoidung;
            $currentStudent = $this->monHocRepository->getCurrentStudent($userId);

            if (!$currentStudent) {
                return [
                    'success' => true,
                    'monHocs' => collect([]),
                    'message' => 'Người dùng không phải là sinh viên'
                ];
            }

            $monHocs = $this->monHocRepository->getMonHocByLop($currentStudent->id_lop);

            return [
                'success' => true,
                'monHocs' => $monHocs
            ];

        } catch (\Exception $e) {
            Log::error('Error in MonHocService@getMonHocForHomePage: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách môn học'
            ];
        }
    }
}
