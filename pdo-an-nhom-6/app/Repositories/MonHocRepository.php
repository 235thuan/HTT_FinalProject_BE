<?php

namespace App\Repositories;

use App\Models\MonHoc;
use Illuminate\Support\Facades\DB;
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

    public function getAll()
    {
        try {
            return DB::table('monhoc')
                ->select('id_monhoc', 'ten_monhoc', 'so_tin_chi')
                ->orderBy('ten_monhoc')
                ->get();
        } catch (\Exception $e) {

            throw $e;
        }
    }
}
