<?php

namespace App\Repositories;

use App\Models\ChuyenNganh;
use App\Models\FileUpload;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ChuyenNganhRepository
{

    public function getChuyenNganhWithKhoaAndImage()
    {
        try {
            $result = DB::table('chuyennganh')
                ->join('khoa', 'chuyennganh.id_khoa', '=', 'khoa.id_khoa')
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


    public function getChuyenNganhById($id)
    {
        try {
            return ChuyenNganh::with(['khoa', 'files'])
                ->where('id_chuyennganh', $id)
                ->firstOrFail();
        } catch (\Exception $e) {
            Log::error('Lỗi trong ChuyenNganhRepository::getChuyenNganhById: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getMonHocByChuyenNganh($id)
    {
        try {
            // Direct query to get subjects
            $monHocs = DB::table('monhoc as m')
                ->join('chitietchuyennganh as ct', 'm.id_monhoc', '=', 'ct.ma_monhoc')
                ->where('ct.ma_chuyennganh', '=', $id)
                ->select('m.*')
                ->get();


            return $monHocs;

        } catch (\Exception $e) {
            Log::error('Lỗi trong ChuyenNganhRepository::getMonHocByChuyenNganh: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getFilesByChuyenNganh($id)
    {
        try {
            return FileUpload::where('id_chuyennganh', $id)
                ->where('loai_file', 'image')
                ->orderBy('ngay_upload', 'desc')
                ->get();
        } catch (\Exception $e) {
            Log::error('Lỗi trong ChuyenNganhRepository::getFilesByChuyenNganh: ' . $e->getMessage());
            throw $e;
        }
    }
}
