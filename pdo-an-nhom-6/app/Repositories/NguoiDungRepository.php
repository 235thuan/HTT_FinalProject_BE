<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class NguoiDungRepository
{
    /**
     * Tìm người dùng theo email
     */
    public function findByEmail($email)
    {
        return DB::table('nguoidung')
            ->where('email', $email)
            ->where('trang_thai', 'hoạt động')
            ->first();
    }

    /**
     * Tạo người dùng mới
     */
    public function create(array $data)
    {
        return DB::table('nguoidung')->insertGetId([
            'ten_dang_nhap' => $data['ten_dang_nhap'],
            'mat_khau' => $data['mat_khau'],
            'email' => $data['email'],
            'trang_thai' => 'hoạt động'
        ]);
    }

    /**
     * Lấy thông tin vai trò của người dùng
     */
    public function getUserRole($userId)
    {
        return DB::table('phanquyen')
            ->join('vaitro', 'phanquyen.id_vaitro', '=', 'vaitro.id_vaitro')
            ->where('phanquyen.id_nguoidung', $userId)
            ->first();
    }

    /**
     * Gán vai trò cho người dùng
     */
    public function assignRole($userId, $roleId)
    {
        return DB::table('phanquyen')->insert([
            'id_nguoidung' => $userId,
            'id_vaitro' => $roleId
        ]);
    }
} 