<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

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
        'trang_thai',
    ];

    protected $hidden = [
        'mat_khau',
    ];

    // Authentication methods
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    public function username()
    {
        return 'ten_dang_nhap';
    }

    // Role relationships
    public function phanQuyen()
    {
        return $this->hasMany(PhanQuyen::class, 'id_nguoidung');
    }

    public function vaiTro()
    {
        return $this->belongsToMany(VaiTro::class, 'phanquyen', 'id_nguoidung', 'id_vaitro');
    }

    // Role checks
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

    // Avatar management
    public function getAvatarUrlAttribute()
    {
        try {
            // Try fetching from file_nguoidung table
            $avatar = DB::table('file_nguoidung')
                ->where('id_nguoidung', $this->id_nguoidung)
                ->where('loai_file', 'avatar')
                ->orderBy('ngay_upload', 'desc')
                ->first();

            if ($avatar && file_exists(public_path($avatar->duong_dan))) {
                return asset($avatar->duong_dan);
            }

            // Default naming convention fallback
            $defaultPath = 'storage/avatars/' . $this->ten_dang_nhap . '_avatar.png';
            if (file_exists(public_path($defaultPath))) {
                return asset($defaultPath);
            }

            // Fallback to a default image
            return asset('assets/images/default-avatar.png');
        } catch (\Exception $e) {
            \Log::error('Avatar URL error: ' . $e->getMessage());
            return asset('assets/images/default-avatar.png');
        }
    }

    public function saveAvatar($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/avatars', $fileName);

        DB::table('file_nguoidung')->insert([
            'id_nguoidung' => $this->id_nguoidung,
            'ten_file' => $fileName,
            'loai_file' => 'avatar',
            'duong_dan' => 'storage/avatars/' . $fileName,
            'ngay_upload' => now()
        ]);
    }

    // Notifications
    public function notifications()
    {
        return $this->hasMany(ThongBao::class, 'id_nguoidung', 'id_nguoidung');
    }

    public function unreadNotifications()
    {
        return $this->notifications()->where('da_doc', 0);
    }

    public function recentNotifications()
    {
        return $this->notifications()
            ->orderBy('thoi_gian', 'desc')
            ->limit(10);
    }

    // Additional relationships
    public function files()
    {
        return $this->hasMany(FileNguoiDung::class, 'id_nguoidung', 'id_nguoidung');
    }
}
