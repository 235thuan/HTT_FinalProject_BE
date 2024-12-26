<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use App\Services\Thuan\HocPhiSalesService;
use App\Services\Thuan\HocPhiService;
use App\Services\Thuan\MonHocService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class HocPhiController extends Controller
{
    protected $hocPhiService;
    protected $monHocService;

    protected $hocPhiSalesService;

    public function __construct(
        HocPhiService $hocPhiService,
        MonHocService $monHocService,
        HocPhiSalesService $hocPhiSalesService
    ) {
        $this->hocPhiService = $hocPhiService;
        $this->monHocService = $monHocService;
        $this->hocPhiSalesService = $hocPhiSalesService;
    }

    // Hiển thị danh sách học phí
    public function index()
    {
        try {
            $result = $this->hocPhiService->getAllHocPhi();

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            return view('qlhp.listHocphi', [
                'hocPhiList' => $result['data']
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi tải danh sách học phí');
        }
    }

    // Hiển thị chi tiết học phí
    public function detail($id)
    {
        try {
            $result = $this->hocPhiService->getHocPhiDetail($id);

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            // Đảm bảo view file là detailHocphi.blade.php
            return view('qlhp.detailHocphi', [
                'hocphi' => $result['data']
            ]);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::detail: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải thông tin chi tiết học phí');
        }
    }

    // Hiển thị trang miễn giảm
    public function discount()
    {
        try {
            // Lấy tất cả môn học thay vì chỉ lấy active
            $monhocsResult = $this->monHocService->getAllMonHoc();
            $discountsResult = $this->hocPhiService->getAllMienGiam();

            if (!$monhocsResult['success']) {
                return back()->with('error', $monhocsResult['message']);
            }

            if (!$discountsResult['success']) {
                return back()->with('error', $discountsResult['message']);
            }

            return view('qlhp.discount', [
                'monhocs' => $monhocsResult['data'],
                'discounts' => $discountsResult['data']
            ]);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::discount: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải trang miễn giảm');
        }
    }

    public function getDiscount($id)
    {
        try {
            $result = $this->hocPhiService->getMienGiam($id);

            return response()->json($result);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::getDiscount: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải thông tin miễn giảm'
            ], 500);
        }
    }

    public function storeDiscount(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_monhoc' => 'required|exists:monhoc,id_monhoc',
                'discount_type' => 'required|in:percent,fixed',
                'ty_le_mien_giam' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:100',
                'so_tien_mien_giam' => 'required_if:discount_type,fixed|nullable|numeric|min:0',
                'ngay_bat_dau' => 'required|date_format:d/m/Y',
                'ngay_ket_thuc' => 'nullable|date_format:d/m/Y|after_or_equal:ngay_bat_dau',
                'mo_ta' => 'nullable|string|max:255',
            ]);

            $result = $this->hocPhiService->createMienGiam($validated);

            return response()->json($result);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Lỗi validation: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::storeDiscount: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi thêm miễn giảm'
            ], 500);
        }
    }

    public function updateDiscount(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'id_monhoc' => 'required|exists:monhoc,id_monhoc',
                'discount_type' => 'required|in:percent,fixed',
                'ty_le_mien_giam' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:100',
                'so_tien_mien_giam' => 'required_if:discount_type,fixed|nullable|numeric|min:0',
                'ngay_bat_dau' => 'required|date_format:d/m/Y',
                'ngay_ket_thuc' => 'nullable|date_format:d/m/Y|after_or_equal:ngay_bat_dau',
                'mo_ta' => 'nullable|string|max:255',
            ]);

            $result = $this->hocPhiService->updateMienGiam($id, $validated);

            return response()->json($result);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Lỗi validation: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::updateDiscount: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật miễn giảm'
            ], 500);
        }
    }

    public function deleteDiscount($id)
    {
        try {
            $result = $this->hocPhiService->deleteMienGiam($id);

            return response()->json($result);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::deleteDiscount: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa miễn giảm'
            ], 500);
        }
    }

    public function sales()
    {
        try {
            $result = $this->hocPhiSalesService->getSalesOverview();

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            return view('qlhp.sale', [
                'totalPaid' => $result['data']['totalPaid'],
                'totalClasses' => $result['data']['totalClasses'],
                'classSummary' => $result['data']['classSummary']
            ]);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::sales: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải trang thống kê');
        }
    }

    public function salesDetail($lop)
    {
        try {
            $result = $this->hocPhiSalesService->getClassDetail($lop);

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            return view('qlhp.saleDetail', [
                'lop' => $lop,
                'students' => $result['data']
            ]);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::salesDetail: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải chi tiết lớp');
        }
    }


}
