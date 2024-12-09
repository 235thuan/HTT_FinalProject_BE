<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GiaoVienController extends Controller
{
    public function listAll()
{
    \Log::info('GiaoVienController@listAll: Starting method');
    
    try {
        // Get only khoas that have teachers
        $khoas = DB::table('khoa')
            ->join('giaovien', 'khoa.id_khoa', '=', 'giaovien.ma_khoa')
            ->select('khoa.*')
            ->groupBy('khoa.id_khoa', 'khoa.ten_khoa')  // Add all non-aggregated columns
            ->orderBy('khoa.ten_khoa')
            ->get();

        \Log::info('GiaoVienController@listAll: Khoas fetched', [
            'count' => $khoas->count(),
            'first_khoa' => $khoas->first()
        ]);

        // For each khoa, get its teachers with pagination
        foreach ($khoas as $khoa) {
            $khoa->giaoviens = DB::table('giaovien')
                ->join('nguoidung', 'giaovien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->where('giaovien.ma_khoa', '=', $khoa->id_khoa)
                ->select(
                    'giaovien.id_giaovien',
                    'giaovien.ten_giaovien',
                    'giaovien.ma_khoa',
                    'nguoidung.email',
                    'nguoidung.so_dien_thoai',
                    DB::raw("'{$khoa->ten_khoa}' as ten_khoa")  // Include khoa name
                )
                ->paginate(5);
        }

        if (request()->ajax()) {
            return response()->json([
                'html' => view('qlnd.partials.teacher-list', compact('khoas'))->render(),
            ]);
        }

        return view('qlnd.listGiaovien', compact('khoas'));
    } catch (\Exception $e) {
        \Log::error('GiaoVienController@listAll: Error occurred', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }
}

public function edit($id)
{
    try {
        // Store return URL parameters
        session([
            'return_page' => request('return_page', 1),
            'return_khoa' => request('khoa')
        ]);

        $giaovien = DB::table('giaovien')
            ->join('nguoidung', 'giaovien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
            ->where('giaovien.id_giaovien', $id)
            ->first();

        if (!$giaovien) {
            return redirect()->back()->with('error', 'Không tìm thấy giáo viên');
        }

        $khoas = DB::table('khoa')->get();

        return view('qlnd.editGiaovien', compact('giaovien', 'khoas'));
    } catch (\Exception $e) {
        \Log::error('Error in GiaoVienController@edit: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }
}

public function update(Request $request, $id)
{
    try {
        $validated = $request->validate([
            'ten_giaovien' => 'required',
            'ma_khoa' => 'required|exists:khoa,id_khoa',
            'email' => 'required|email',
            'so_dien_thoai' => 'required'
        ]);

        // Update giaovien
        DB::table('giaovien')
            ->where('id_giaovien', $id)
            ->update([
                'ten_giaovien' => $validated['ten_giaovien'],
                'ma_khoa' => $validated['ma_khoa']
            ]);

        // Get giaovien record
        $giaovien = DB::table('giaovien')
            ->where('id_giaovien', $id)
            ->first();

        // Update nguoidung
        DB::table('nguoidung')
            ->where('id_nguoidung', $giaovien->id_nguoidung)
            ->update([
                'email' => $validated['email'],
                'so_dien_thoai' => $validated['so_dien_thoai']
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công',
            'data' => [
                'id' => $id,
                'ten_giaovien' => $validated['ten_giaovien'],
                'email' => $validated['email'],
                'so_dien_thoai' => $validated['so_dien_thoai'],
                'ma_khoa' => $validated['ma_khoa']
            ]
        ]);
    } catch (\Exception $e) {
        \Log::error('Error in GiaoVienController@update: ' . $e->getMessage());
        return response()->json([
            'error' => 'Có lỗi xảy ra: ' . $e->getMessage()
        ], 500);
    }
}

public function detail($id)
{
    try {
        $giaovien = DB::table('giaovien')
            ->join('nguoidung', 'giaovien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
            ->join('khoa', 'giaovien.ma_khoa', '=', 'khoa.id_khoa')
            ->where('giaovien.id_giaovien', $id)
            ->select(
                'giaovien.*',
                'nguoidung.email',
                'nguoidung.so_dien_thoai',
                'khoa.ten_khoa'
            )
            ->first();

        if (!$giaovien) {
            return redirect()->back()->with('error', 'Không tìm thấy giáo viên');
        }

        return view('qlnd.giaovienDetail', compact('giaovien'));
    } catch (\Exception $e) {
        \Log::error('Error in GiaoVienController@detail: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }
}
} 