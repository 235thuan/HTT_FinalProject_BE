<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    protected $table = 'vaitro';
    protected $primaryKey = 'id_vaitro';
    public $timestamps = false;

    protected $fillable = [
        'ten_vaitro',
        'mo_ta_vaitro'
    ];

    public function nguoiDung()
    {
        return $this->belongsToMany(NguoiDung::class, 'phanquyen', 'id_vaitro', 'id_nguoidung');
    }
} 