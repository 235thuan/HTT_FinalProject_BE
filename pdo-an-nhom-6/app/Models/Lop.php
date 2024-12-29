<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    protected $table = 'lop';
    protected $primaryKey = 'id_lop';
    public $timestamps = false;

    protected $fillable = [
        'ten_lop',
        'mo_ta',
        'id_chuyennganh',
        'nam_vao_hoc'
    ];

    public function sinhViens()
    {
        return $this->hasMany(SinhVien::class, 'id_lop', 'id_lop');
    }
}
