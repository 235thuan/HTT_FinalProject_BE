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

    public function listAll(Request $request)
    {
        try {
            $searchLop = $request->get('search_lop');
            $findStudent = $request->get('find_student');
            $findLop = $request->get('find_lop');

            // Get all classes
            $lops = DB::table('lop')
                ->select('lop.*')
                ->when($searchLop || $findLop, function($query) use ($searchLop, $findLop) {
                    $lopToFind = $searchLop ?? $findLop;
                    return $query->orderByRaw('CASE WHEN ten_lop = ? THEN 0 ELSE 1 END', [$lopToFind]);
                })
                ->orderBy('lop.ten_lop')
                ->get();

            foreach ($lops as $lop) {
                // Get major and faculty info
                $majorInfo = DB::table('sinhvien')
                    ->join('chuyennganh', 'sinhvien.ma_chuyen_nganh', '=', 'chuyennganh.id_chuyennganh')
                    ->join('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
                    ->where('sinhvien.lop', '=', $lop->ten_lop)
                    ->select('chuyennganh.ten_chuyennganh', 'khoa.ten_khoa')
                    ->first();

                $lop->ten_chuyennganh = $majorInfo ? $majorInfo->ten_chuyennganh : 'N/A';
                $lop->ten_khoa = $majorInfo ? $majorInfo->ten_khoa : 'N/A';

                // Build base query for students
                $query = DB::table('sinhvien')
                    ->join('nguoidung', 'sinhvien.id_nguoidung', '=', 'nguoidung.id_nguoidung')
                    ->where('sinhvien.lop', '=', $lop->ten_lop);

                // If finding a specific student, calculate their page
                if ($findStudent && $findLop === $lop->ten_lop && !$request->has('page_' . $lop->id_lop)) {
                    $position = DB::table('sinhvien')
                        ->where('lop', $lop->ten_lop)
                        ->where('id_sinhvien', '<', $findStudent)
                        ->count();
                    
                    // Add 1 for 1-based position
                    $position++;
                    $page = ceil($position / 5);
                    
                    // Only redirect if we're not already on the correct page
                    if (!$request->ajax()) {
                        return redirect()->to($request->url() . '?' . http_build_query([
                            'find_student' => $findStudent,
                            'find_lop' => $findLop,
                            'page_' . $lop->id_lop => $page
                        ]));
                    }
                    
                    // For AJAX requests, just set the page
                    $request->merge(['page_' . $lop->id_lop => $page]);
                }

                // Get all students for client-side sorting
                $lop->all_students = $query->select(
                    'sinhvien.id_sinhvien',
                    'sinhvien.ten_sinhvien',
                    'sinhvien.nam_vao_hoc',
                    'sinhvien.lop',
                    'nguoidung.email',
                    'nguoidung.so_dien_thoai'
                )->get();

                // Get paginated students
                $lop->sinhviens = $query->select(
                    'sinhvien.id_sinhvien',
                    'sinhvien.ten_sinhvien',
                    'sinhvien.nam_vao_hoc',
                    'sinhvien.lop',
                    'nguoidung.email',
                    'nguoidung.so_dien_thoai'
                )
                ->paginate(5, ['*'], 'page_'.$lop->id_lop)
                ->appends($request->except('page_'.$lop->id_lop));

                // Store total count
                $lop->total_students = DB::table('sinhvien')
                    ->where('lop', '=', $lop->ten_lop)
                    ->count();
            }

            // Get all classes for the edit modal dropdown
            $allLops = DB::table('lop')->get();

            // Get all chuyenNganhs for the create form
            $chuyenNganhs = DB::table('chuyennganh')
                ->select(
                    'id_chuyennganh',
                    'ten_chuyennganh'
                )
                ->get()
                ->map(function($cn) {
                    // Create abbreviation from the first letters of each word
                    $words = explode(' ', $cn->ten_chuyennganh);
                    $abbreviation = '';
                    foreach ($words as $word) {
                        $abbreviation .= mb_substr($word, 0, 1);
                    }
                    $cn->abbreviation = $abbreviation;
                    return $cn;
                });

            // Get all lops (without joins)
            $lopsByChuyenNganh = DB::table('lop')
                ->select('id_lop', 'ten_lop')
                ->get()
                ->groupBy(function($lop) use ($chuyenNganhs) {
                    // Find matching chuyenNganh based on lop prefix
                    foreach ($chuyenNganhs as $cn) {
                        if (str_starts_with($lop->ten_lop, $cn->abbreviation)) {
                            return $cn->id_chuyennganh;
                        }
                    }
                    return null;
                })
                ->filter(function($group, $key) {
                    return $key !== null;
                });

            if ($request->ajax()) {
                return view('qlnd.partials.student-list', compact('lops', 'allLops'))->render();
            }

            return view('qlnd.listSinhvien', [
                'lops' => $lops,
                'allLops' => $allLops,
                'chuyenNganhs' => $chuyenNganhs,
                'lopsByChuyenNganh' => $lopsByChuyenNganh,
                'title' => 'Danh sách sinh viên',
                'findStudent' => $findStudent
            ]);

        } catch (\Exception $e) {
            \Log::error('LopController@listAll: Error occurred', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
            
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function searchSinhvien(Request $request)
    {
        $searchTerm = $request->search;
        $isSuggestion = $request->has('suggest');

        if ($isSuggestion) {
            // First, search for classes
            $classResults = DB::table('lop')
                ->leftJoin('sinhvien', 'sinhvien.lop', '=', 'lop.ten_lop')
                ->leftJoin('chuyennganh', 'sinhvien.ma_chuyen_nganh', '=', 'chuyennganh.id_chuyennganh')
                ->leftJoin('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
                ->where('lop.ten_lop', 'LIKE', "%{$searchTerm}%")
                ->select(
                    'lop.id_lop',
                    'lop.ten_lop',
                    'chuyennganh.ten_chuyennganh',
                    'khoa.ten_khoa',
                    DB::raw('COUNT(DISTINCT sinhvien.id_sinhvien) as student_count')
                )
                ->groupBy('lop.id_lop', 'lop.ten_lop', 'chuyennganh.ten_chuyennganh', 'khoa.ten_khoa')
                ->limit(3)
                ->get()
                ->map(function($item) {
                    return [
                        'type' => 'class',
                        'id_lop' => $item->id_lop,
                        'ten_lop' => $item->ten_lop,
                        'ten_chuyennganh' => $item->ten_chuyennganh ?? 'N/A',
                        'ten_khoa' => $item->ten_khoa ?? 'N/A',
                        'student_count' => $item->student_count
                    ];
                });

            // Then, search for students
            $studentResults = DB::table('sinhvien as s1')
                ->join('nguoidung', 'nguoidung.id_nguoidung', '=', 's1.id_nguoidung')
                ->where(function($q) use ($searchTerm) {
                    $q->where('s1.ten_sinhvien', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('s1.id_sinhvien', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('nguoidung.email', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('nguoidung.so_dien_thoai', 'LIKE', "%{$searchTerm}%");
                })
                ->select(
                    's1.id_sinhvien',
                    's1.ten_sinhvien',
                    's1.lop',
                    'nguoidung.email',
                    DB::raw('(
                        SELECT COUNT(*) 
                        FROM sinhvien as s2 
                        WHERE s2.lop = s1.lop 
                        AND s2.id_sinhvien < s1.id_sinhvien
                    ) as position')
                )
                ->limit(5)
                ->get()
                ->map(function($item) {
                    // Add 1 to position since we want 1-based indexing
                    $position = $item->position + 1;
                    return [
                        'type' => 'student',
                        'id_sinhvien' => $item->id_sinhvien,
                        'ten_sinhvien' => $item->ten_sinhvien,
                        'lop' => $item->lop,
                        'email' => $item->email,
                        'page' => ceil($position / 5)
                    ];
                });

            $suggestions = $classResults->concat($studentResults);
            return response()->json(['suggestions' => $suggestions]);
        }

        // For direct search
        $student = DB::table('sinhvien as s1')
            ->join('nguoidung', 'nguoidung.id_nguoidung', '=', 's1.id_nguoidung')
            ->where(function($q) use ($searchTerm) {
                $q->where('s1.ten_sinhvien', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('s1.id_sinhvien', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('nguoidung.email', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('nguoidung.so_dien_thoai', 'LIKE', "%{$searchTerm}%");
            })
            ->select(
                's1.*',
                DB::raw('(
                    SELECT COUNT(*) 
                    FROM sinhvien as s2 
                    WHERE s2.lop = s1.lop 
                    AND s2.id_sinhvien < s1.id_sinhvien
                ) as position')
            )
            ->first();

        if ($student) {
            // Add 1 to position since we want 1-based indexing
            $position = $student->position + 1;
            $page = ceil($position / 5);
            return response()->json([
                'found' => true,
                'type' => 'student',
                'student' => $student,
                'page' => $page
            ]);
        }

        return response()->json([
            'found' => false
        ]);
    }
} 