<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhanQuyen extends Model
{
    protected $table = 'phanquyen';
    protected $primaryKey = 'id_phanquyen';
    public $timestamps = false;

    protected $fillable = [
        'id_nguoidung',
        'id_vaitro'
    ];

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'id_nguoidung');
    }

    public function vaiTro()
    {
        return $this->belongsTo(VaiTro::class, 'id_vaitro');
    }
} 