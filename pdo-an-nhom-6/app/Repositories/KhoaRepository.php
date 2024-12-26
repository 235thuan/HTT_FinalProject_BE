<?php

namespace App\Repositories;

use App\Models\Khoa;

class KhoaRepository
{
    /**
     * Lấy danh sách khoa và chuyên ngành
     */
    public function getKhoasWithChuyenNganh()
    {
        try {
            return Khoa::with(['chuyenNganhs' => function ($query) {
                $query->orderBy('ten_chuyennganh');
            }])
                ->orderBy('ten_khoa')
                ->get();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong KhoaRepository::getKhoasWithChuyenNganh: ' . $e->getMessage());
            throw $e;
        }
    }
}
