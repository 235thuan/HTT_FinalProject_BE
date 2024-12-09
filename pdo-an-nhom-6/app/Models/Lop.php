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
        'mo_ta'
    ];

    public function sinhViens()
    {
        return $this->hasMany(SinhVien::class, 'lop', 'id_lop');
    }
} 