<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    protected $table = 'monhoc';
    protected $primaryKey = 'id_monhoc';
    public $timestamps = false;

    protected $fillable = [
        'ten_monhoc',
        'so_tin_chi',
        'ma_chuyen_nganh'
    ];


    public function chiTietChuyenNganh()
    {
        return $this->hasMany(ChiTietChuyenNganh::class, 'ma_monhoc', 'id_monhoc');
    }

    public function chuyenNganhs()
    {
        return $this->belongsToMany(
            ChuyenNganh::class,
            'chitietchuyennganh',
            'ma_monhoc',
            'ma_chuyennganh'
        );
    }

    public function files()
    {
        return $this->hasMany(FileUpload::class, 'id_monhoc', 'id_monhoc');
    }
}
