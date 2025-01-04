<?php

namespace App\Repositories;

use App\Models\MonHoc;
use App\Models\SinhVien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MonHocRepository
{
    protected $monHoc;
    protected $sinhVien;

    public function __construct(MonHoc $monHoc, SinhVien $sinhVien)
    {
        $this->monHoc = $monHoc;
        $this->sinhVien = $sinhVien;
    }


    public function getCurrentStudent($userId)
    {
        return $this->sinhVien->with(['lop', 'avatar'])
            ->where('id_nguoidung', $userId)
            ->first();
    }

    public function getMonHocByLop($lopId)
    {
        return $this->monHoc->select([
            'monhoc.id_monhoc',
            'monhoc.ten_monhoc',
            'monhoc.so_tin_chi',
            'monhoc.id_chuyennganh',
            'monhoc.gia',
            'monhoc.ky_hoc',
            DB::raw('MAX(file_upload.duong_dan) as image_url')
        ])
            ->leftJoin('file_upload', function($join) {
                $join->on('monhoc.id_monhoc', '=', 'file_upload.id_monhoc')
                    ->where('file_upload.loai_file', 'image');
            })
            ->join('chuyennganh', 'monhoc.id_chuyennganh', '=', 'chuyennganh.id_chuyennganh')
            ->join('lop', 'chuyennganh.id_chuyennganh', '=', 'lop.id_chuyennganh')
            ->where('lop.id_lop', $lopId)
            ->groupBy([
                'monhoc.id_monhoc',
                'monhoc.ten_monhoc',
                'monhoc.so_tin_chi',
                'monhoc.id_chuyennganh',
                'monhoc.gia',
                'monhoc.ky_hoc'
            ])
            ->get();
    }
}
