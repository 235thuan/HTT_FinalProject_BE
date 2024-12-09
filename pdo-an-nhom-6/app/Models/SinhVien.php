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
        'lop',
        'email',
        'so_dien_thoai'
        // Add other fields as needed
    ];

    public function lop()
    {
        return $this->belongsTo(Lop::class, 'lop', 'id_lop');
    }
} 