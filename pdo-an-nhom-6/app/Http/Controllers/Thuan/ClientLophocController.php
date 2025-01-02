<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MonHoc;
use App\Models\SinhVien;
use Illuminate\Support\Facades\DB;

class ClientLophocController extends Controller
{
    public function index()
    {
        try {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            $userId = Auth::user()->id_nguoidung;
            
            // Get current student with class info
            $currentStudent = SinhVien::with(['lop', 'avatar'])
                ->where('id_nguoidung', $userId)
                ->first();

            if (!$currentStudent) {
                return back()->with('error', 'Người dùng không phải là sinh viên');
            }

            // Get all classmates including current student
            $allStudents = SinhVien::with(['avatar'])
                ->where('id_lop', $currentStudent->id_lop)
                ->orderByRaw('CASE WHEN id_nguoidung = ? THEN 0 ELSE 1 END', [$userId]) // Current user first
                ->get();

            // Get subjects (your existing code)
            $subjects = MonHoc::select([
                'monhoc.*',
                'file_upload.duong_dan as image_url'
            ])
            ->leftJoin('file_upload', 'monhoc.id_monhoc', '=', 'file_upload.id_monhoc')
            ->join('chuyennganh', 'monhoc.id_chuyennganh', '=', 'chuyennganh.id_chuyennganh')
            ->join('lop', 'chuyennganh.id_chuyennganh', '=', 'lop.id_chuyennganh')
            ->where('lop.id_lop', $currentStudent->id_lop)
            ->where('file_upload.loai_file', 'image')
            ->get();

            return view('vuong.lophoc', compact(
                'subjects',
                'allStudents',
                'currentStudent'
            ));

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
}
