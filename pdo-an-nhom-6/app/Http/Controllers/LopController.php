<?php

namespace App\Http\Controllers;

use App\Models\Lop;
use App\Models\SinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LopController extends Controller
{
    public function index()
    {
        try {
            // Get all classes with their students
            $lops = DB::table('lop')
                ->orderBy('ten_lop')
                ->get();

            // Get students for each class
            foreach ($lops as $lop) {
                $lop->sinhviens = DB::table('sinhvien')
                    ->join('nguoidung', 'sinhvien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                    ->where('sinhvien.lop', '=', $lop->ten_lop)
                    ->select(
                        'sinhvien.id_sinhvien',
                        'sinhvien.ten_sinhvien',
                        'sinhvien.nam_vao_hoc',
                        'nguoidung.email',
                        'nguoidung.so_dien_thoai'
                    )
                    ->get();
            }

            return view('qlnd.listLop', compact('lops'));
        } catch (\Exception $e) {
            \Log::error('Error in LopController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function show($id_lop)
    {
        try {
            // Debug log
            \Log::info('Looking for class', ['id_lop' => $id_lop]);

            // Get class data
            $lop = DB::table('lop')
                ->where('id_lop', $id_lop)
                ->first();

            \Log::info('Found class', ['lop' => $lop]);

            if (!$lop) {
                return redirect()->back()->with('error', 'Không tìm thấy lớp');
            }

            // Get students in class with their major and faculty info
            $sinhviens = DB::table('sinhvien')
                ->join('nguoidung', 'sinhvien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                ->join('chuyennganh', 'sinhvien.ma_chuyen_nganh', '=', 'chuyennganh.id_chuyennganh')
                ->join('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
                ->where('sinhvien.lop', '=', $lop->ten_lop)
                ->select(
                    'sinhvien.id_sinhvien',
                    'sinhvien.ten_sinhvien',
                    'sinhvien.nam_vao_hoc',
                    'nguoidung.email',
                    'nguoidung.so_dien_thoai',
                    'chuyennganh.ten_chuyennganh',
                    'khoa.ten_khoa'
                )
                ->get();

            \Log::info('Found students', [
                'count' => $sinhviens->count(),
                'first_student' => $sinhviens->first()
            ]);

            return view('qlnd.listSinhvien', compact('lop', 'sinhviens'));
            
        } catch (\Exception $e) {
            \Log::error('Error in LopController@show: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function listAll()
    {
        \Log::info('LopController@listAll: Starting method');
        
        try {
            // Debug log
            \Log::info('Request info:', [
                'url' => request()->url(),
                'method' => request()->method(),
                'path' => request()->path(),
                'route' => request()->route()->getName()
            ]);

            // Get all classes first
            $lops = DB::table('lop')
                ->select('lop.*')
                ->orderBy('lop.ten_lop')
                ->get();

            \Log::info('Classes fetched:', ['count' => $lops->count()]);

            // For each class, get its students and other info
            foreach ($lops as $lop) {
                // Get first student's major and faculty info
                $majorInfo = DB::table('sinhvien')
                    ->join('chuyennganh', 'sinhvien.ma_chuyen_nganh', '=', 'chuyennganh.id_chuyennganh')
                    ->join('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
                    ->where('sinhvien.lop', '=', $lop->ten_lop)
                    ->select(
                        'chuyennganh.ten_chuyennganh',
                        'khoa.ten_khoa'
                    )
                    ->first();

                // Add major and faculty info to class object
                $lop->ten_chuyennganh = $majorInfo ? $majorInfo->ten_chuyennganh : 'N/A';
                $lop->ten_khoa = $majorInfo ? $majorInfo->ten_khoa : 'N/A';

                // Get students with pagination
                $lop->sinhviens = DB::table('sinhvien')
                    ->join('nguoidung', 'sinhvien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                    ->where('sinhvien.lop', '=', $lop->ten_lop)
                    ->select(
                        'sinhvien.id_sinhvien',
                        'sinhvien.ten_sinhvien',
                        'sinhvien.nam_vao_hoc',
                        'sinhvien.lop',
                        'nguoidung.email',
                        'nguoidung.so_dien_thoai'
                    )
                    ->paginate(5);

                // Store total count separately
                $lop->total_students = DB::table('sinhvien')
                    ->where('lop', '=', $lop->ten_lop)
                    ->count();
            }

            // Get all classes for the edit modal dropdown
            $allLops = DB::table('lop')->get();

            \Log::info('Rendering view with data');

            return view('qlnd.listSinhvien', [
                'lops' => $lops,
                'allLops' => $allLops,
                'title' => 'Danh sách sinh viên'
            ]);

        } catch (\Exception $e) {
            \Log::error('LopController@listAll: Error occurred', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
} 