<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MonHoc;
use App\Models\SinhVien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClientLophocController extends Controller
{
    public function index()
    {
        try {
            if (!Auth::check()) {
                return redirect()->route('home');
            }

            $userId = Auth::user()->id_nguoidung;
            // Check user role
            $vaiTro = DB::table('phanquyen')
                ->where('id_nguoidung', $userId)
                ->value('id_vaitro');

            Log::info('User role check:', ['id_vaitro' => $vaiTro]);

            // For Sinh Viên (id_vaitro = 3)
            if ($vaiTro == 3) {
                // Existing logic for students
                $currentStudent = SinhVien::with(['lop', 'avatar'])
                    ->where('id_nguoidung', $userId)
                    ->first();

                if (!$currentStudent) {
                    return back()->with('error', 'Không tìm thấy thông tin sinh viên');
                }

                return $this->showClassDetails($currentStudent->id_lop);
            }
            elseif ($vaiTro == 4) {
                // If id_lop is selected, show that class's details
                if (request()->has('id_lop')) {
                    return $this->showClassDetails(request()->id_lop);
                }

                // Otherwise, show class selection view
                $teacherClasses = $this->getTeacherClasses($userId);
                return view('thuan.clientLophoc.selectClass', compact('teacherClasses'));
            }

            return back()->with('error', 'Không có quyền truy cập');

        } catch (\Exception $e) {
            \Log::error('Error in ClientLophocController@index: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function getLessons($id_monhoc)
    {
        try {
            // Get lessons from noidungmonhoc table with file info
            $lessons = DB::table('noidungmonhoc')
                ->select([
                    'noidungmonhoc.id_noidung',
                    'noidungmonhoc.ten_bai_giang',
                    'file_upload.duong_dan',
                    'file_upload.thoi_luong'
                ])
                ->join('file_upload', 'noidungmonhoc.id_file', '=', 'file_upload.id_file')
                ->where('noidungmonhoc.id_monhoc', $id_monhoc)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $lessons
            ]);
        } catch (\Exception $e) {
            \Log::error('Error getting lessons: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải danh sách bài học'
            ], 500);
        }
    }

    public function getLesson($id_noidung)
    {
        try {
            // Get lesson detail from baihoc table with file info
            $lesson = DB::table('baihoc')
                ->select([
                    'baihoc.*',
                    'file_upload.duong_dan',
                    'file_upload.thoi_luong',
                    'noidungmonhoc.ten_bai_giang'
                ])
                ->join('noidungmonhoc', 'baihoc.id_monhoc', '=', 'noidungmonhoc.id_monhoc')
                ->leftJoin('file_upload', 'baihoc.id_file', '=', 'file_upload.id_file')
                ->where('noidungmonhoc.id_noidung', $id_noidung)
                ->first();

            if (!$lesson) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy bài học'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'lesson' => $lesson
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error getting lesson: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải bài học'
            ], 500);
        }
    }



    private function getTeacherClasses($userId)
    {
        // Get teacher's classes through khoa and chuyennganh
        return DB::table('lop')
            ->select([
                'lop.*',
                'chuyennganh.ten_chuyennganh',
                DB::raw('(SELECT COUNT(*) FROM sinhvien WHERE sinhvien.id_lop = lop.id_lop) as so_luong_sv')
            ])
            ->join('chuyennganh', 'lop.id_chuyennganh', '=', 'chuyennganh.id_chuyennganh')
            ->join('giaovien', 'chuyennganh.id_khoa', '=', 'giaovien.id_khoa')
            ->where('giaovien.id_nguoidung', $userId)
            ->get();
    }

    private function showClassDetails($id_lop)
    {
        // Get all students in the class
        $allStudents = SinhVien::with(['avatar'])
            ->where('id_lop', $id_lop)
            ->get();

        // Get subjects for the class
        $subjects = MonHoc::select([
            'monhoc.*',
            'file_upload.duong_dan as image_url'
        ])
            ->leftJoin('file_upload', function($join) {
                $join->on('monhoc.id_monhoc', '=', 'file_upload.id_monhoc')
                    ->where('file_upload.loai_file', 'image');
            })
            ->join('chuyennganh', 'monhoc.id_chuyennganh', '=', 'chuyennganh.id_chuyennganh')
            ->join('lop', 'chuyennganh.id_chuyennganh', '=', 'lop.id_chuyennganh')
            ->where('lop.id_lop', $id_lop)
            ->get();

        return view('vuong.lophoc', compact(
            'subjects',
            'allStudents',
            'id_lop'
        ));
    }
}
