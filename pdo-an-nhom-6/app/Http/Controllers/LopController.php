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
            // Get requested lop_id and page from query parameters
            $currentLopId = request('lop_id');
            $currentPage = request('page', 1);

            // Get all classes first
            $lops = DB::table('lop')
                ->select('lop.*')
                ->orderBy('lop.ten_lop')
                ->get();

            // For each class, get its students with pagination
            foreach ($lops as $lop) {
                // Only use the requested page for the specific lop
                $page = ($currentLopId == $lop->id_lop) ? $currentPage : 1;
                
                // Set the current page for this lop's pagination
                request()->merge(['page' => $page]);

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
                    ->paginate(5)
                    ->appends(['lop_id' => $lop->id_lop]); // Add lop_id to pagination URLs

                // Store total count
                $lop->total_students = DB::table('sinhvien')
                    ->where('lop', '=', $lop->ten_lop)
                    ->count();
            }

            // Get all classes for the edit modal dropdown
            $allLops = DB::table('lop')->get();

            if (request()->ajax()) {
                return view('qlnd.partials.student-list', compact('lops', 'allLops'))->render();
            }

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
            
            if (request()->ajax()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
            
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
} 