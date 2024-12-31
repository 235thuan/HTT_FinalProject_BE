<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MonHoc extends Model
{
    protected $table = 'monhoc';
    protected $primaryKey = 'id_monhoc';
    public $timestamps = false;

    protected $fillable = [
        'ten_monhoc',
        'so_tin_chi',
        'id_chuyennganh'
    ];


    public function chiTietChuyenNganh()
    {
        return $this->hasMany(ChiTietChuyenNganh::class, 'id_monhoc', 'id_monhoc');
    }

    public function chuyenNganhs()
    {
        return $this->belongsToMany(
            ChuyenNganh::class,
            'chitietchuyennganh',
            'id_monhoc',
            'id_chuyennganh'
        );
    }

    public function files()
    {
        return $this->hasMany(FileUpload::class, 'id_monhoc', 'id_monhoc');
    }

    public function getImageUrlAttribute()
    {
        $file = DB::table('file_upload')
            ->where('id_monhoc', $this->id_monhoc)
            ->where('loai_file', 'image')
            ->first();

            return $file ? '/hoa/' . $file->ten_file : '/storage/thuan/default.png';
    }
}
