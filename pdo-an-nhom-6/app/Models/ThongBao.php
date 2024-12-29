<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ThongBao extends Model
{
    protected $table = 'thong_bao';
    protected $primaryKey = 'id_thongbao';
    public $timestamps = false;

    protected $fillable = [
        'id_nguoidung',
        'tieu_de',
        'noi_dung',
        'loai_thongbao',
        'da_doc',
        'thoi_gian'
    ];

    // Cast thoi_gian to Carbon instance
    protected $casts = [
        'thoi_gian' => 'datetime',
        'da_doc' => 'boolean'
    ];

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'id_nguoidung', 'id_nguoidung');
    }
}
