<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiaoVien extends Model
{
    protected $table = 'giaovien';
    protected $primaryKey = 'id_giaovien';
    public $timestamps = false;

    protected $fillable = [
        'id_nguoidung',
        'ma_khoa',
        'ten_giaovien',
        'email',
        'so_dien_thoai'
    ];

    /**
     * Lấy thông tin khoa của giáo viên
     */
    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'ma_khoa', 'id_khoa');
    }

    /**
     * Lấy thông tin người dùng của giáo viên
     */
    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'id_nguoidung');
    }

    /**
     * Lấy danh sách thời khóa biểu của giáo viên
     */
    public function thoiKhoaBieu()
    {
        return $this->hasMany(ThoiKhoaBieu::class, 'id_giaovien');
    }
}
