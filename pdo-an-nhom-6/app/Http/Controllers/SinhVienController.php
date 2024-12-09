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
                'nam_vao_hoc' => 'required|numeric'
            ]);

            DB::table('sinhvien')
                ->where('id_sinhvien', $id)
                ->update($validated);

            return redirect()->route('qlnd.listSinhvien', [
                'page' => session('return_page', 1),
                'lop' => session('return_lop')
            ])->with('success', 'Cập nhật thông tin sinh viên thành công');
        } catch (\Exception $e) {
            \Log::error('Error in SinhVienController@update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
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