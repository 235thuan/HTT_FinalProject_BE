<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'vaitro';
    protected $primaryKey = 'id_vaitro';
    public $timestamps = false;

    protected $fillable = [
        'ten_vaitro',
        'mo_ta_vaitro'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'phanquyen', 'id_vaitro', 'id_nguoidung');
    }
} 