<?php

namespace App\Services;

use App\Repositories\NguoiDungRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $nguoiDungRepo;

    public function __construct(NguoiDungRepository $nguoiDungRepo)
    {
        $this->nguoiDungRepo = $nguoiDungRepo;
    }

    /**
     * Xử lý đăng nhập
     */
    public function login($email, $password)
    {
        // Tìm người dùng theo email
        $user = $this->nguoiDungRepo->findByEmail($email);
        if (!$user) {
            return [
                'success' => false,
                'message' => 'Email không tồn tại'
            ];
        }

        // Kiểm tra mật khẩu
        if (!Hash::check($password, $user->mat_khau)) {
            return [
                'success' => false,
                'message' => 'Mật khẩu không chính xác'
            ];
        }

        // Kiểm tra vai trò
        $role = $this->nguoiDungRepo->getUserRole($user->id_nguoidung);
        if ($role && $role->id_vaitro === 1) { // 1 là Admin
            return [
                'success' => false,
                'message' => 'Tài khoản admin không thể đăng nhập qua giao diện này'
            ];
        }

        // Đăng nhập thành công
        Auth::loginUsingId($user->id_nguoidung);
        return [
            'success' => true,
            'message' => 'Đăng nhập thành công',
            'user' => [
                'email' => $user->email,
                'role' => $role ? $role->ten_vaitro : null
            ]
        ];
    }

    /**
     * Xử lý đăng ký
     */
    public function register($data)
    {
        try {
            // Kiểm tra email đã tồn tại
            if ($this->nguoiDungRepo->findByEmail($data['email'])) {
                return [
                    'success' => false,
                    'message' => 'Email đã được sử dụng'
                ];
            }

            // Tạo người dùng mới
            $userId = $this->nguoiDungRepo->create([
                'ten_dang_nhap' => explode('@', $data['email'])[0],
                'mat_khau' => Hash::make($data['password']),
                'email' => $data['email']
            ]);

            // Gán vai trò
            $roleId = $data['user_type'] === 'student' ? 3 : 5; // 3: Sinh viên, 5: Khác
            $this->nguoiDungRepo->assignRole($userId, $roleId);

            return [
                'success' => true,
                'message' => 'Đăng ký thành công'
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ];
        }
    }
} 