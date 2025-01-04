<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SinhVienRepository
{


    public function getLopList()
    {
        try {
            Log::info('Repository: Getting lop list');

            $lops = DB::table('lop')
                ->select('id_lop', 'ten_lop')
                ->orderBy('ten_lop')
                ->get();

            Log::info('Repository: Found lops', ['count' => $lops->count()]);

            return $lops;
        } catch (\Exception $e) {
            Log::error('Repository: Error getting lop list', [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function assignStudent($data)
    {
        try {
            DB::beginTransaction();

            // Ensure ten_sinhvien exists, fallback to getting it from nguoidung if not provided
            if (!isset($data['ten_sinhvien']) || empty($data['ten_sinhvien'])) {
                $nguoidung = DB::table('nguoidung')
                    ->where('id_nguoidung', $data['id_nguoidung'])
                    ->first();

                if (!$nguoidung) {
                    throw new \Exception('Không tìm thấy người dùng');
                }

                $data['ten_sinhvien'] = $nguoidung->ten_dang_nhap;
            }

            // Rest of your code...
            $existingStudent = DB::table('sinhvien')
                ->where('id_nguoidung', $data['id_nguoidung'])
                ->first();

            if ($existingStudent) {
                // Update existing student's class
                DB::table('sinhvien')
                    ->where('id_nguoidung', $data['id_nguoidung'])
                    ->update([
                        'id_lop' => $data['id_lop'],
                        'ten_sinhvien' => $data['ten_sinhvien']
                    ]);

                DB::commit();
                return $existingStudent->id_sinhvien;
            }

            // For new assignments...
            $lastId = DB::table('sinhvien')
                ->orderBy('id_sinhvien', 'desc')
                ->value('id_sinhvien') ?? 0;

            $newId = $lastId + 1;

            // Create new sinh vien record
            DB::table('sinhvien')->insert([
                'id_sinhvien' => $newId,
                'id_nguoidung' => $data['id_nguoidung'],
                'ten_sinhvien' => $data['ten_sinhvien'],
                'id_lop' => $data['id_lop']
            ]);

            DB::commit();
            return $newId;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in assignStudent:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => array_merge($data, ['ten_sinhvien' => '***'])
            ]);
            throw $e;
        }
    }

    public function getStudentsLists()
    {
        try {
            Log::info('Getting both assigned and unassigned students lists');

            // List 1: Students not in sinhvien table
            $unassignedStudents = DB::table('nguoidung as nd')
                ->join('phanquyen as pq', 'nd.id_nguoidung', '=', 'pq.id_nguoidung')
                ->leftJoin('sinhvien as sv', 'nd.id_nguoidung', '=', 'sv.id_nguoidung')
                ->where('pq.id_vaitro', 3)
                ->whereNull('sv.id_nguoidung')
                ->select(
                    'nd.id_nguoidung',
                    'nd.ten_dang_nhap',
                    'nd.email',
                    'nd.so_dien_thoai',
                    'nd.trang_thai'
                )
                ->orderBy('nd.ten_dang_nhap')
                ->get();

            // List 2: Students already in sinhvien table
            $assignedStudents = DB::table('nguoidung as nd')
                ->join('phanquyen as pq', 'nd.id_nguoidung', '=', 'pq.id_nguoidung')
                ->join('sinhvien as sv', 'nd.id_nguoidung', '=', 'sv.id_nguoidung')
                ->join('lop as l', 'sv.id_lop', '=', 'l.id_lop')
                ->where('pq.id_vaitro', 3)
                ->select(
                    'nd.id_nguoidung',
                    'nd.ten_dang_nhap',
                    'nd.email',
                    'nd.so_dien_thoai',
                    'nd.trang_thai',
                    'sv.ten_sinhvien',
                    'l.ten_lop'
                )
                ->orderBy('nd.ten_dang_nhap')
                ->get();

            Log::info('Found students:', [
                'unassigned_count' => $unassignedStudents->count(),
                'assigned_count' => $assignedStudents->count()
            ]);

            return [
                'unassigned' => $unassignedStudents,
                'assigned' => $assignedStudents
            ];

        } catch (\Exception $e) {
            Log::error('Error in getStudentsLists:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
