<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class NguoiDung extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'nguoidung';
    protected $primaryKey = 'id_nguoidung';
    public $timestamps = false;

    protected $fillable = [
        'ten_dang_nhap',
        'mat_khau',
        'email',
        'so_dien_thoai',
        'trang_thai'
    ];

    protected $hidden = [
        'mat_khau'
    ];

    public function phanQuyen()
    {
        return $this->hasMany(PhanQuyen::class, 'id_nguoidung');
    }

    public function vaiTro()
    {
        return $this->belongsToMany(VaiTro::class, 'phanquyen', 'id_nguoidung', 'id_vaitro');
    }

    public function hasRole($role)
    {
        return $this->vaiTro()->where('ten_vaitro', $role)->exists();
    }

    public function hasAnyRole($roles)
    {
        return $this->vaiTro()->whereIn('ten_vaitro', (array) $roles)->exists();
    }

    public function hasAllRoles($roles)
    {
        $userRoles = $this->vaiTro->pluck('ten_vaitro')->toArray();
        return !array_diff((array) $roles, $userRoles);
    }
} 