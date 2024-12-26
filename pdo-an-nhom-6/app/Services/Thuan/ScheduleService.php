<?php

namespace App\Services\Thuan;

use App\Repositories\ScheduleRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ScheduleService
{
    protected $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * Lấy thời khóa biểu theo chuyên ngành
     */
    public function getChuyenNganhSchedule($id)
    {
        try {
            $lops = $this->scheduleRepository->getLopsByChuyenNganh($id);

            return [
                'success' => true,
                'data' => $lops
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleService::getChuyenNganhSchedule: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải danh sách lớp'
            ];
        }
    }

    /**
     * Lấy thời khóa biểu theo lớp và tuần
     */
    public function getLopSchedule($tenLop, $week = null)
    {
        try {
            // Xác định tuần hiện tại nếu không có tham số week
            $currentWeek = $week ? Carbon::parse($week) : Carbon::now()->startOfWeek();

            // Đảm bảo luôn bắt đầu từ thứ 2
            $currentWeek = $currentWeek->startOfWeek();

            // Tính toán tuần trước và tuần sau
            $prevWeek = $currentWeek->copy()->subWeek()->format('Y-m-d');
            $nextWeek = $currentWeek->copy()->addWeek()->format('Y-m-d');

            // Lấy thời khóa biểu trong khoảng thời gian của tuần
            $startDate = $currentWeek->format('Y-m-d');
            $endDate = $currentWeek->copy()->endOfWeek()->format('Y-m-d');

            $schedule = $this->scheduleRepository->getWeekSchedule($tenLop, $startDate, $endDate);

            return [
                'success' => true,
                'data' => [
                    'schedule' => collect($schedule), // Chuyển đổi thành collection
                    'currentWeek' => $startDate,
                    'prevWeek' => $prevWeek,
                    'nextWeek' => $nextWeek,
                ]
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleService::getLopSchedule: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải thời khóa biểu'
            ];
        }
    }

    /**
     * Lấy thông tin một thời khóa biểu
     */
    public function getScheduleById($id)
    {
        try {
            $schedule = $this->scheduleRepository->getScheduleById($id);

            if (!$schedule) {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy thời khóa biểu'
                ];
            }

            return [
                'success' => true,
                'data' => $schedule
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleService::getScheduleById: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải thông tin thời khóa biểu'
            ];
        }
    }



    /**
     * Xóa thời khóa biểu
     */
    public function deleteSchedule($id)
    {
        try {
            $deleted = $this->scheduleRepository->deleteSchedule($id);

            if (!$deleted) {
                return [
                    'success' => false,
                    'message' => 'Không thể xóa thời khóa biểu'
                ];
            }

            return [
                'success' => true,
                'message' => 'Đã xóa thời khóa biểu thành công'
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleService::deleteSchedule: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa thời khóa biểu'
            ];
        }
    }



    /**
     * Xác định buổi học (sáng/chiều)
     */
    private function getTimeSlot($time)
    {
        $hour = Carbon::parse($time)->hour;
        return $hour < 12 ? 'morning' : 'afternoon';
    }

    /**
     * Validate dữ liệu thời khóa biểu
     */
    private function validateScheduleData($data)
    {
        return isset($data['id_monhoc']) &&
            isset($data['id_giaovien']) &&
            isset($data['id_lop']) &&
            isset($data['id_phonghoc']) &&
            isset($data['ngay_hoc']) &&
            isset($data['gio_bat_dau']) &&
            isset($data['gio_ket_thuc']);
    }

    /**
     * Kiểm tra trùng lịch
     */
    private function checkScheduleConflict($data)
    {
        return $this->scheduleRepository->checkConflict(
            $data['id_lop'],
            $data['ngay_hoc'],
            $data['gio_bat_dau'],
            $data['gio_ket_thuc'],
            $data['id_thoikhoabieu'] ?? null
        );
    }

    public function getFormData()
    {
        try {
            return [
                'success' => true,
                'data' => [
                    'monhocs' => DB::table('monhoc')->orderBy('ten_monhoc')->get(),
                    'giaoviens' => DB::table('giaovien')->orderBy('ten_giaovien')->get(),
                    'lops' => DB::table('lop')->orderBy('ten_lop')->get(),
                    'phonghocs' => DB::table('phonghoc')->orderBy('ten_phonghoc')->get(),
                ]
            ];
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleService::getFormData: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Không thể lấy dữ liệu cho form'
            ];
        }
    }

    /**
     * Tạo lịch học mới
     */
    public function createSchedule($data)
    {
        try {
            DB::beginTransaction();

            // Kiểm tra xung đột giáo viên
            if ($this->scheduleRepository->checkTeacherConflict(
                $data['id_giaovien'],
                $data['ngay_hoc'],
                $data['gio_bat_dau'],
                $data['gio_ket_thuc']
            )) {
                return [
                    'success' => false,
                    'message' => 'Giáo viên đã có lịch dạy trong thời gian này'
                ];
            }

            // Kiểm tra xung đột phòng học
            if ($this->scheduleRepository->checkRoomConflict(
                $data['id_phonghoc'],
                $data['ngay_hoc'],
                $data['gio_bat_dau'],
                $data['gio_ket_thuc']
            )) {
                return [
                    'success' => false,
                    'message' => 'Phòng học đã được sử dụng trong thời gian này'
                ];
            }

            // Kiểm tra xung đột lớp học
            if ($this->scheduleRepository->checkClassConflict(
                $data['id_lop'],
                $data['ngay_hoc'],
                $data['gio_bat_dau'],
                $data['gio_ket_thuc']
            )) {
                return [
                    'success' => false,
                    'message' => 'Lớp đã có lịch học trong thời gian này'
                ];
            }

            // Tạo lịch học mới
            $scheduleId = $this->scheduleRepository->create($data);

            // Lấy tên lớp để redirect
            $lop = DB::table('lop')->where('id_lop', $data['id_lop'])->first();

            DB::commit();

            return [
                'success' => true,
                'data' => [
                    'id' => $scheduleId,
                    'ten_lop' => $lop->ten_lop
                ]
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi trong ScheduleService::createSchedule: ' . $e->getMessage());
            throw $e;
        }
    }

    public function checkAllConflicts($data)
    {
        try {
            $conflicts = [];

            // Kiểm tra xung đột giáo viên
            $teacherConflict = DB::table('thoikhoabieu as tkb')
                ->join('lop as l', 'tkb.id_lop', '=', 'l.id_lop')
                ->join('monhoc as m', 'tkb.id_monhoc', '=', 'm.id_monhoc')
                ->where('tkb.id_giaovien', $data['id_giaovien'])
                ->where('tkb.ngay_hoc', $data['ngay_hoc'])
                ->where(function ($query) use ($data) {
                    $query->whereBetween('tkb.gio_bat_dau', [$data['gio_bat_dau'], $data['gio_ket_thuc']])
                        ->orWhereBetween('tkb.gio_ket_thuc', [$data['gio_bat_dau'], $data['gio_ket_thuc']])
                        ->orWhere(function ($q) use ($data) {
                            $q->where('tkb.gio_bat_dau', '<=', $data['gio_bat_dau'])
                                ->where('tkb.gio_ket_thuc', '>=', $data['gio_ket_thuc']);
                        });
                })
                ->select('l.ten_lop', 'm.ten_monhoc', 'tkb.gio_bat_dau', 'tkb.gio_ket_thuc')
                ->first();

            if ($teacherConflict) {
                $conflicts['teacher'] = [
                    'ten_lop' => $teacherConflict->ten_lop,
                    'ten_monhoc' => $teacherConflict->ten_monhoc,
                    'gio_bat_dau' => $teacherConflict->gio_bat_dau,
                    'gio_ket_thuc' => $teacherConflict->gio_ket_thuc
                ];
            }

            // Kiểm tra xung đột lớp học
            $classConflict = DB::table('thoikhoabieu as tkb')
                ->join('monhoc as m', 'tkb.id_monhoc', '=', 'm.id_monhoc')
                ->join('giaovien as gv', 'tkb.id_giaovien', '=', 'gv.id_giaovien')
                ->where('tkb.id_lop', $data['id_lop'])
                ->where('tkb.ngay_hoc', $data['ngay_hoc'])
                ->where(function ($query) use ($data) {
                    $query->whereBetween('tkb.gio_bat_dau', [$data['gio_bat_dau'], $data['gio_ket_thuc']])
                        ->orWhereBetween('tkb.gio_ket_thuc', [$data['gio_bat_dau'], $data['gio_ket_thuc']])
                        ->orWhere(function ($q) use ($data) {
                            $q->where('tkb.gio_bat_dau', '<=', $data['gio_bat_dau'])
                                ->where('tkb.gio_ket_thuc', '>=', $data['gio_ket_thuc']);
                        });
                })
                ->select('m.ten_monhoc', 'gv.ten_giaovien', 'tkb.gio_bat_dau', 'tkb.gio_ket_thuc')
                ->first();

            if ($classConflict) {
                $conflicts['class'] = [
                    'ten_monhoc' => $classConflict->ten_monhoc,
                    'ten_giaovien' => $classConflict->ten_giaovien,
                    'gio_bat_dau' => $classConflict->gio_bat_dau,
                    'gio_ket_thuc' => $classConflict->gio_ket_thuc
                ];
            }

            // Tương tự cho phòng học...

            return $conflicts;

        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleService::checkAllConflicts: ' . $e->getMessage());
            throw $e;
        }
    }
}
