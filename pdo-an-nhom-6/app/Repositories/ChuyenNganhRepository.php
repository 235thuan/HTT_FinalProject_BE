<?php

namespace App\Repositories;

use App\Models\ChuyenNganh;
use Illuminate\Support\Facades\DB;


class ChuyenNganhRepository
{

    public function getChuyenNganhWithKhoaAndImage()
    {
        try {
            $result = DB::table('chuyennganh')
                ->join('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
                ->leftJoin('file_upload', function($join) {
                    $join->on('chuyennganh.id_chuyennganh', '=', 'file_upload.id_chuyennganh')
                        ->where('file_upload.loai_file', '=', 'image');
                })
                ->select(
                    'chuyennganh.id_chuyennganh',
                    'chuyennganh.ten_chuyennganh',
                    'khoa.ten_khoa',
                    DB::raw('COALESCE(file_upload.duong_dan, "storage/thuan/default.png") as image_url')
                )
                ->get();


            return $result;

        } catch (\Exception $e) {

            throw $e;
        }
    }
}
