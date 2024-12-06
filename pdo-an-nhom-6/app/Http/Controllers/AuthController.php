<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Models\PhanQuyen;
use App\Models\GiaoVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function registerGiaoVien(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ten_dang_nhap' => 'required|unique:nguoidung',
            'mat_khau' => 'required|min:6',
            'email' => 'required|email|unique:nguoidung',
            'so_dien_thoai' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'ten_giaovien' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Create user account
            $nguoiDung = NguoiDung::create([
                'ten_dang_nhap' => $request->ten_dang_nhap,
                'mat_khau' => Hash::make($request->mat_khau),
                'email' => $request->email,
                'so_dien_thoai' => $request->so_dien_thoai,
                'trang_thai' => 'hoạt động'
            ]);

            // Create teacher record
            $giaoVien = GiaoVien::create([
                'id_nguoidung' => $nguoiDung->id_nguoidung,
                'ten_giaovien' => $request->ten_giaovien,
                'email' => $request->email,
                'so_dien_thoai' => $request->so_dien_thoai
            ]);

            // Assign teacher role
            PhanQuyen::create([
                'id_nguoidung' => $nguoiDung->id_nguoidung,
                'id_vaitro' => 2 // Assuming 2 is the role ID for teachers
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Teacher registered successfully',
                'data' => [
                    'nguoi_dung' => $nguoiDung,
                    'giao_vien' => $giaoVien
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ten_dang_nhap' => 'required',
            'mat_khau' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $nguoiDung = NguoiDung::with('vaiTro')->where('ten_dang_nhap', $request->ten_dang_nhap)->first();

        if (!$nguoiDung || !Hash::check($request->mat_khau, $nguoiDung->mat_khau)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        if ($nguoiDung->trang_thai !== 'hoạt động') {
            return response()->json([
                'status' => false,
                'message' => 'Account is inactive'
            ], 403);
        }

        $token = $nguoiDung->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $nguoiDung,
            'roles' => $nguoiDung->vaiTro->pluck('ten_vaitro')
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    public function profile(Request $request)
    {
        $user = $request->user()->load('vaiTro');
        return response()->json([
            'status' => true,
            'user' => $user,
            'roles' => $user->vaiTro->pluck('ten_vaitro')
        ]);
    }
} 