<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SinhVienController extends Controller
{
    public function show($id)
    {
        try {
            $sinhvien = DB::table('sinhvien')
                ->join('nguoidung', 'sinhvien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->where('sinhvien.id_sinhvien', $id)
                ->first();

            if (!$sinhvien) {
                return redirect()->back()->with('error', 'Không tìm thấy sinh viên');
            }

            return view('qlnd.showStudent', compact('sinhvien'));
        } catch (\Exception $e) {
            \Log::error('Error in SinhVienController@show: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function edit($id)
    {
        try {
            // Store return URL parameters
            session([
                'return_page' => request('return_page', 1),
                'return_lop' => request('lop')
            ]);

            $sinhvien = DB::table('sinhvien')
                ->join('nguoidung', 'sinhvien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->where('sinhvien.id_sinhvien', $id)
                ->first();

            if (!$sinhvien) {
                return redirect()->back()->with('error', 'Không tìm thấy sinh viên');
            }

            $lops = DB::table('lop')->get();

            return view('qlnd.editStudent', compact('sinhvien', 'lops'));
        } catch (\Exception $e) {
            \Log::error('Error in SinhVienController@edit: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'ten_sinhvien' => 'required',
                'lop' => 'required|exists:lop,ten_lop',
                'nam_vao_hoc' => 'required|numeric',
                'email' => 'required|email',
                'so_dien_thoai' => 'required'
            ]);

            // Update sinhvien
            DB::table('sinhvien')
                ->where('id_sinhvien', $id)
                ->update([
                    'ten_sinhvien' => $validated['ten_sinhvien'],
                    'lop' => $validated['lop'],
                    'nam_vao_hoc' => $validated['nam_vao_hoc']
                ]);

            // Get sinhvien record
            $sinhvien = DB::table('sinhvien')
                ->where('id_sinhvien', $id)
                ->first();

            // Update nguoidung
            DB::table('nguoidung')
                ->where('id_nguoidung', $sinhvien->id_nguoidung)
                ->update([
                    'email' => $validated['email'],
                    'so_dien_thoai' => $validated['so_dien_thoai']
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công',
                'data' => [
                    'id' => $id,
                    'ten_sinhvien' => $validated['ten_sinhvien'],
                    'lop' => $validated['lop'],
                    'nam_vao_hoc' => $validated['nam_vao_hoc'],
                    'email' => $validated['email'],
                    'so_dien_thoai' => $validated['so_dien_thoai']
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in SinhVienController@update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function detail($id)
    {
        try {
            $sinhvien = DB::table('sinhvien')
                ->join('nguoidung', 'sinhvien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->join('chuyennganh', 'sinhvien.ma_chuyen_nganh', '=', 'chuyennganh.id_chuyennganh')
                ->join('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
                ->where('sinhvien.id_sinhvien', $id)
                ->select(
                    'sinhvien.*',
                    'nguoidung.email',
                    'nguoidung.so_dien_thoai',
                    'chuyennganh.ten_chuyennganh',
                    'khoa.ten_khoa'
                )
                ->first();

            if (!$sinhvien) {
                return redirect()->back()->with('error', 'Không tìm thấy sinh viên');
            }

            return view('qlnd.sinhvienDetail', compact('sinhvien'));
        } catch (\Exception $e) {
            \Log::error('Error in SinhVienController@detail: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }
} 