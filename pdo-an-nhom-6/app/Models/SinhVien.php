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

    ];

    public function lop()
    {
        return $this->belongsTo(Lop::class, 'id_lop', 'id_lop');
    }
}
