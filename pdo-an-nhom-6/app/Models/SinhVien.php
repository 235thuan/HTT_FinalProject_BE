<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    protected $table = 'sinhvien';
    protected $primaryKey = 'id_sinhvien';
    public $timestamps = false;

    protected $fillable = [
        'ten_sinhvien',
        'id_lop',
        'id_nguoidung'
    ];

    public function lop()
    {
        return $this->belongsTo(Lop::class, 'id_lop', 'id_lop');
    }

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'id_nguoidung', 'id_nguoidung');
    }

    public function avatar()
    {
        return $this->hasOne(FileNguoiDung::class, 'id_nguoidung', 'id_nguoidung')
            ->where('loai_file', 'avatar');
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset($this->avatar->duong_dan) : asset('images/vuong/default-avatar.jpg');
    }
}
