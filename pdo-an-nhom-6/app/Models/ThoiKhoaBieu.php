<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThoiKhoaBieu extends Model
{
    protected $table = 'thoikhoabieu';
    protected $primaryKey = 'id_thoikhoabieu';
    public $timestamps = false;

    protected $fillable = [
        'id_monhoc',
        'id_giaovien',
        'id_lop',
        'id_phonghoc',
        'ngay_hoc',
        'gio_bat_dau',
        'gio_ket_thuc'
    ];

    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'id_monhoc');
    }

    public function giaoVien()
    {
        return $this->belongsTo(GiaoVien::class, 'id_giaovien');
    }

    public function lop()
    {
        return $this->belongsTo(Lop::class, 'id_lop');
    }

    public function phongHoc()
    {
        return $this->belongsTo(PhongHoc::class, 'id_phonghoc');
    }
}
