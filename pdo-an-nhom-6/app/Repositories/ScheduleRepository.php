<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScheduleRepository
{
    /**
     * Lấy danh sách lớp theo chuyên ngành
     */
    public function getWeekSchedule($tenLop, $startDate, $endDate)
    {
        try {
            return DB::table('thoikhoabieu as tkb')
                ->join('monhoc as mh', 'tkb.id_monhoc', '=', 'mh.id_monhoc')
                ->join('giaovien as gv', 'tkb.id_giaovien', '=', 'gv.id_giaovien')
                ->join('phonghoc as ph', 'tkb.id_phonghoc', '=', 'ph.id_phonghoc')
                ->join('lop as l', 'tkb.id_lop', '=', 'l.id_lop')
                ->leftJoin('sinhvien as sv', 'l.id_lop', '=', 'sv.id_lop') // Thêm join với bảng sinhvien
                ->select(
                    'tkb.*',
                    'mh.ten_monhoc',
                    'gv.ten_giaovien',
                    'ph.ten_phonghoc',
                    'ph.khu_vuc',
                    'mh.so_tin_chi',
                    'l.ten_lop'
                )
                ->where(function($query) use ($tenLop) {
                    $query->where('l.ten_lop', $tenLop);
                })
                ->whereBetween('tkb.ngay_hoc', [$startDate, $endDate])
                ->orderBy('tkb.ngay_hoc')
                ->orderBy('tkb.gio_bat_dau')
                ->distinct() // Tránh trùng lặp khi join
                ->get();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleRepository::getWeekSchedule: ' . $e->getMessage());
            throw $e;
        }
    }
    /**
     * Lấy danh sách lớp theo chuyên ngành
     */
    public function getLopsByChuyenNganh($id)
    {
        try {
            return DB::table('sinhvien as sv')
                ->select(
                    'l.ten_lop as ten_lop',
                    DB::raw('COUNT(DISTINCT sv.id_sinhvien) as si_so')
                )
                ->join('lop as l', 'sv.id_lop', '=', 'l.id_lop')
                ->where('l.id_chuyennganh', $id)
                ->groupBy('l.ten_lop')
                ->orderBy('l.ten_lop')
                ->get();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleRepository::getLopsByChuyenNganh: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Kiểm tra trùng lịch
     */
    public function checkConflict($lopId, $ngayHoc, $gioBatDau, $gioKetThuc, $excludeId = null)
    {
        try {
            $query = DB::table('thoikhoabieu')
                ->where('id_lop', $lopId)
                ->where('ngay_hoc', $ngayHoc)
                ->where(function ($q) use ($gioBatDau, $gioKetThuc) {
                    $q->whereBetween('gio_bat_dau', [$gioBatDau, $gioKetThuc])
                        ->orWhereBetween('gio_ket_thuc', [$gioBatDau, $gioKetThuc])
                        ->orWhere(function ($q) use ($gioBatDau, $gioKetThuc) {
                            $q->where('gio_bat_dau', '<=', $gioBatDau)
                                ->where('gio_ket_thuc', '>=', $gioKetThuc);
                        });
                });

            if ($excludeId) {
                $query->where('id_thoikhoabieu', '!=', $excludeId);
            }

            return $query->exists();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleRepository::checkConflict: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Lấy thông tin một thời khóa biểu
     */
    public function getScheduleById($id)
    {
        try {
            return DB::table('thoikhoabieu as tkb')
                ->join('monhoc as mh', 'tkb.id_monhoc', '=', 'mh.id_monhoc')
                ->join('giaovien as gv', 'tkb.id_giaovien', '=', 'gv.id_giaovien')
                ->join('phonghoc as ph', 'tkb.id_phonghoc', '=', 'ph.id_phonghoc')
                ->select(
                    'tkb.*',
                    'mh.ten_monhoc',
                    'gv.ten_giaovien',
                    'ph.ten_phonghoc',
                    'mh.so_tin_chi'
                )
                ->where('tkb.id_thoikhoabieu', $id)
                ->first();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleRepository::getScheduleById: ' . $e->getMessage());
            throw $e;
        }
    }


    /**
     * Xóa thời khóa biểu
     */
    public function deleteSchedule($id)
    {
        try {
            return DB::table('thoikhoabieu')
                ->where('id_thoikhoabieu', $id)
                ->delete();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleRepository::deleteSchedule: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Kiểm tra trùng lịch giáo viên
     */

    public function checkTeacherConflict($teacherId, $date, $startTime, $endTime)
    {
        try {
            return DB::table('thoikhoabieu')
                ->where('id_giaovien', $teacherId)
                ->where('ngay_hoc', $date)
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->whereBetween('gio_bat_dau', [$startTime, $endTime])
                        ->orWhereBetween('gio_ket_thuc', [$startTime, $endTime])
                        ->orWhere(function ($q) use ($startTime, $endTime) {
                            $q->where('gio_bat_dau', '<=', $startTime)
                                ->where('gio_ket_thuc', '>=', $endTime);
                        });
                })
                ->exists();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleRepository::checkTeacherConflict: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Kiểm tra xung đột phòng học
     */
    public function checkRoomConflict($roomId, $date, $startTime, $endTime)
    {
        try {
            return DB::table('thoikhoabieu')
                ->where('id_phonghoc', $roomId)
                ->where('ngay_hoc', $date)
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->whereBetween('gio_bat_dau', [$startTime, $endTime])
                        ->orWhereBetween('gio_ket_thuc', [$startTime, $endTime])
                        ->orWhere(function ($q) use ($startTime, $endTime) {
                            $q->where('gio_bat_dau', '<=', $startTime)
                                ->where('gio_ket_thuc', '>=', $endTime);
                        });
                })
                ->exists();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleRepository::checkRoomConflict: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Kiểm tra xung đột lớp học
     */
    public function checkClassConflict($classId, $date, $startTime, $endTime)
    {
        try {
            return DB::table('thoikhoabieu')
                ->where('id_lop', $classId)
                ->where('ngay_hoc', $date)
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->whereBetween('gio_bat_dau', [$startTime, $endTime])
                        ->orWhereBetween('gio_ket_thuc', [$startTime, $endTime])
                        ->orWhere(function ($q) use ($startTime, $endTime) {
                            $q->where('gio_bat_dau', '<=', $startTime)
                                ->where('gio_ket_thuc', '>=', $endTime);
                        });
                })
                ->exists();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleRepository::checkClassConflict: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Tạo lịch học mới
     */
    public function create($data)
    {
        try {
            return DB::table('thoikhoabieu')->insertGetId($data);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleRepository::create: ' . $e->getMessage());
            throw $e;
        }
    }

}
