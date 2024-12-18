<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietChuyenNganh extends Model
{
    protected $table = 'chitietchuyennganh';
    protected $primaryKey = 'id_chitiet';
    public $timestamps = false;

    protected $fillable = [
        'ma_chuyennganh',
        'ma_monhoc'
    ];

    // Relationship with ChuyenNganh
    public function chuyenNganh()
    {
        return $this->belongsTo(ChuyenNganh::class, 'ma_chuyennganh', 'id_chuyennganh');
    }

    // Relationship with MonHoc
    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'ma_monhoc', 'id_monhoc');
    }
}
