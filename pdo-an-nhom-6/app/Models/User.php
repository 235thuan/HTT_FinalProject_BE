<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'nguoidung';
    protected $primaryKey = 'id_nguoidung';
    public $timestamps = false;

    protected $fillable = [
        'ten_dang_nhap',
        'email',
        'mat_khau',
        'so_dien_thoai',
        'trang_thai'
    ];

    protected $hidden = [
        'mat_khau',
    ];

    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    public function username()
    {
        return 'ten_dang_nhap';
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'phanquyen', 'id_nguoidung', 'id_vaitro');
    }

    public function hasRole($roleName)
    {
        return DB::table('nguoidung')
            ->join('phanquyen', 'nguoidung.id_nguoidung', '=', 'phanquyen.id_nguoidung')
            ->join('vaitro', 'phanquyen.id_vaitro', '=', 'vaitro.id_vaitro')
            ->where('nguoidung.id_nguoidung', $this->id_nguoidung)
            ->where('vaitro.ten_vaitro', $roleName)
            ->exists();
    }

    public function files()
    {
        return $this->hasMany(FileNguoiDung::class, 'id_nguoidung', 'id_nguoidung');
    }

    public function getAvatarUrlAttribute()
    {
        try {
            // First try to get from file_nguoidung table
            $avatar = DB::table('file_nguoidung')
                ->where('id_nguoidung', $this->id_nguoidung)
                ->where('loai_file', 'avatar')
                ->orderBy('ngay_upload', 'desc')
                ->first();

            if ($avatar && file_exists(public_path($avatar->duong_dan))) {
                return asset($avatar->duong_dan);
            }

            // If no record in file_nguoidung, use default naming convention
            $defaultPath = 'storage/avatars/' . $this->ten_dang_nhap . '_avatar.png';
            if (file_exists(public_path($defaultPath))) {
                return asset($defaultPath);
            }

            // Fallback to default image - make sure this file exists!
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
}
