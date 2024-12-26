<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use App\Models\Khoa;
use App\Services\Thuan\KhoaService;
use App\Services\Thuan\ScheduleService;
use App\Models\ChuyenNganh;
use App\Models\Lop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ScheduleController extends Controller
{
    protected $scheduleService;
    protected $khoaService;

    public function __construct(
        ScheduleService $scheduleService,
        KhoaService $khoaService
    ) {
        $this->scheduleService = $scheduleService;
        $this->khoaService = $khoaService;

        // Lấy danh sách khoa và share cho tất cả view
        try {
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();
            $khoas = $khoaResult['success'] ? $khoaResult['data'] : collect([]);
            View::share('khoas', $khoas);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleController::constructor: ' . $e->getMessage());
            View::share('khoas', collect([]));
        }
    }

    /**
     * Hiển thị trang chủ thời khóa biểu
     */
    public function index()
    {
        try {
            // Lấy danh sách khoa và chuyên ngành cho sidebar
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();

            if (!$khoaResult['success']) {
                return back()->with('error', $khoaResult['message']);
            }

            // Share khoas với view
            View::share('khoas', $khoaResult['data']);

            return view('index');
        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleController::index: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải trang thời khóa biểu');
        }
    }

    /**
     * Hiển thị danh sách lớp theo chuyên ngành
     */
    public function chuyenNganh($id)
    {
        try {
            // Lấy thông tin chuyên ngành
            $chuyenNganh = ChuyenNganh::findOrFail($id);

            // Lấy danh sách lớp
            $result = $this->scheduleService->getChuyenNganhSchedule($id);

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            return view('tkb.listLop', [
                'chuyenNganh' => $chuyenNganh,
                'lops' => $result['data']
            ]);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleController::chuyenNganh: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải danh sách lớp');
        }
    }

    /**
     * Hiển thị thời khóa biểu của một lớp
     */
    public function lopSchedule($ten_Lop, $week = null)
    {
        try {
            $decodedTenLop = urldecode($ten_Lop);

            // Lấy danh sách khoa cho sidebar
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();
            if ($khoaResult['success']) {
                View::share('khoas', $khoaResult['data']);
            }

            // Lấy thời khóa biểu
            $result = $this->scheduleService->getLopSchedule($decodedTenLop, $week);

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            return view('tkb.detailLop', [
                'ten_lop' => $decodedTenLop,
                'schedule' => $result['data']['schedule'] ?? collect([]),
                'currentWeek' => $result['data']['currentWeek'],
                'prevWeek' => $result['data']['prevWeek'],
                'nextWeek' => $result['data']['nextWeek'],
                'hasSchedule' => !empty($result['data']['schedule'])
            ]);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleController::lopSchedule: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải thời khóa biểu');
        }
    }

    /**
     * API endpoint để lấy thời khóa biểu (nếu cần AJAX)
     */
    public function getScheduleData(Request $request, $lopId)
    {
        try {
            $week = $request->input('week');
            $result = $this->scheduleService->getLopSchedule($lopId, $week);

            if (!$result['success']) {
                return response()->json([
                    'success' => false,
                    'message' => $result['message']
                ], 400);
            }

            return response()->json([
                'success' => true,
                'data' => $result['data']
            ]);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleController::getScheduleData: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải dữ liệu'
            ], 500);
        }
    }

    /**
     * Hiển thị form tạo/sửa thời khóa biểu (nếu cần)
     */
    public function edit($id)
    {
        try {
            $schedule = $this->scheduleService->getScheduleById($id);

            if (!$schedule['success']) {
                return back()->with('error', $schedule['message']);
            }

            return view('tkb.editTKB', [
                'schedule' => $schedule['data']
            ]);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleController::edit: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải thông tin thời khóa biểu');
        }
    }

    public function create()
    {
        try {
            // Lấy dữ liệu cho form
            $formData = $this->scheduleService->getFormData();

            if (!$formData['success']) {
                return back()->with('error', $formData['message']);
            }

            // Lấy danh sách khoa cho sidebar
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();
            if ($khoaResult['success']) {
                View::share('khoas', $khoaResult['data']);
            }

            return view('tkb.createTkb', $formData['data']);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleController::create: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải form thêm lịch học');
        }
    }

    /**
     * Lưu lịch học mới
     */
    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'id_monhoc' => 'required|exists:monhoc,id_monhoc',
                'id_giaovien' => 'required|exists:giaovien,id_giaovien',
                'id_lop' => 'required|exists:lop,id_lop',
                'id_phonghoc' => 'required|exists:phonghoc,id_phonghoc',
                'ngay_hoc' => 'required|date|after_or_equal:today',
                'gio_bat_dau' => 'required|date_format:H:i',
                'gio_ket_thuc' => 'required|date_format:H:i|after:gio_bat_dau',
            ]);

            // Kiểm tra xung đột
            $conflicts = $this->scheduleService->checkAllConflicts($validated);

            if (!empty($conflicts)) {
                return back()
                    ->withInput()
                    ->with('error', $this->formatConflictMessages($conflicts));
            }

            // Tạo lịch học mới
            $result = $this->scheduleService->createSchedule($validated);

            if (!$result['success']) {
                return back()
                    ->withInput()
                    ->with('error', $result['message']);
            }

            return redirect()
                ->route('schedule.lop', ['ten_lop' => $result['data']['ten_lop']])
                ->with('success', 'Đã thêm lịch học thành công');

        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleController::store: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra khi thêm lịch học');
        }
    }

    /**
     * Format thông báo lỗi xung đột
     */
    private function formatConflictMessages($conflicts)
    {
        $messages = [];

        if (isset($conflicts['teacher'])) {
            $messages[] = "Giáo viên đã có lịch dạy lớp {$conflicts['teacher']['ten_lop']} " .
                "môn {$conflicts['teacher']['ten_monhoc']} " .
                "từ {$conflicts['teacher']['gio_bat_dau']} đến {$conflicts['teacher']['gio_ket_thuc']}";
        }

        if (isset($conflicts['class'])) {
            $messages[] = "Lớp đã có lịch học môn {$conflicts['class']['ten_monhoc']} " .
                "với giáo viên {$conflicts['class']['ten_giaovien']} " .
                "từ {$conflicts['class']['gio_bat_dau']} đến {$conflicts['class']['gio_ket_thuc']}";
        }

        if (isset($conflicts['room'])) {
            $messages[] = "Phòng học đã được sử dụng cho lớp {$conflicts['room']['ten_lop']} " .
                "môn {$conflicts['room']['ten_monhoc']} " .
                "từ {$conflicts['room']['gio_bat_dau']} đến {$conflicts['room']['gio_ket_thuc']}";
        }

        return implode('<br>', $messages);
    }
    /**
     * Xóa thời khóa biểu (nếu cần)
     */
    public function destroy($id)
    {
        try {
            $result = $this->scheduleService->deleteSchedule($id);

            if (!$result['success']) {
                return response()->json([
                    'success' => false,
                    'message' => $result['message']
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Đã xóa thời khóa biểu thành công'
            ]);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong ScheduleController::destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa thời khóa biểu'
            ], 500);
        }
    }



}
