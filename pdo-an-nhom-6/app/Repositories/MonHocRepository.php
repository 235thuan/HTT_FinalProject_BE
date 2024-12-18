<?php

namespace App\Repositories;

use App\Models\MonHoc;
use Illuminate\Support\Facades\Log;

class MonHocRepository
{
    public function getAllMonHoc()
    {
        try {
            $monHocs = MonHoc::select('id_monhoc', 'ten_monhoc')
                ->distinct('ten_monhoc')
                ->orderBy('ten_monhoc')
                ->get();

            Log::info('Lấy danh sách môn học thành công. Số lượng: ' . $monHocs->count());
            return $monHocs;

        } catch (\Exception $e) {
            Log::error('Lỗi khi lấy danh sách môn học: ' . $e->getMessage());
            throw $e;
        }
    }
}
