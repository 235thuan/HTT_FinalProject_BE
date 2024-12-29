<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use App\Services\Thuan\HocPhiSalesService;
use App\Services\Thuan\HocPhiService;
use App\Services\Thuan\KhoaService;
use App\Services\Thuan\MonHocService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class HocPhiController extends Controller
{
    protected $hocPhiService;
    protected $khoaService;

    public function __construct(HocPhiService $hocPhiService, KhoaService $khoaService)
    {
        $this->hocPhiService = $hocPhiService;
        $this->khoaService = $khoaService;
    }

    public function index()
    {
        try {
            // Get học phí list
            $result = $this->hocPhiService->getAllHocPhi();

            // Get khoa list for filtering
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            return view('qlhp.listHocphi', [
                'hocPhiList' => $result['data'],
                'khoas' => $khoaResult['success'] ? $khoaResult['data'] : collect([])
            ]);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::index: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải danh sách học phí');
        }
    }

    public function detail($id)
    {
        try {
            $result = $this->hocPhiService->getHocPhiDetail($id);
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();
            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            return view('qlhp.detailHocphi', [
                'hocphi' => $result['data'],
                'khoas' => $khoaResult['success'] ? $khoaResult['data'] : collect([])
            ]);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::detail: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải chi tiết học phí');
        }
    }

    public function edit($id)
    {
        try {
            $result = $this->hocPhiService->getHocPhiForEdit($id);
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            // Debug info
            \Log::info('Edit view data:', [
                'mien_giam_list' => $result['data']['mien_giam_list'],
                'chi_tiet' => collect($result['data']['chi_tiet'])->pluck('mon_hoc.id')->all()
            ]);

            return view('qlhp.editHocphi', [
                'hocphi' => $result['data'],
                'khoas' => $khoaResult['success'] ? $khoaResult['data'] : collect([]),
                'mienGiamList' => $result['data']['mien_giam_list']
            ]);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::edit: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải form sửa học phí');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'chi_tiet' => 'required|array',
                'chi_tiet.*.id_chitiethocphi' => 'required|exists:chitiethocphi,id_chitiethocphi',
                'chi_tiet.*.id_monhoc' => 'required|exists:monhoc,id_monhoc',
                'chi_tiet.*.id_mien_giam' => 'nullable|exists:mien_giam_hoc_phi,id_mien_giam'
            ]);

            $result = $this->hocPhiService->updateHocPhi($id, $validated['chi_tiet']);

            if (!$result['success']) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['message' => $result['message']]);
            }

            return redirect()->route('hocphi.detail', $id)
                ->with('success', 'Cập nhật học phí thành công');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::update: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Có lỗi xảy ra khi cập nhật học phí']);
        }
    }

    public function updateMienGiam(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_hocphi' => 'required|exists:hocphi,id_hocphi',
                'id_monhoc' => 'required|exists:monhoc,id_monhoc',
                'id_mien_giam' => 'nullable|exists:mien_giam_hoc_phi,id_mien_giam'
            ]);

            $result = $this->hocPhiService->updateMienGiamByMonHoc(
                $validated['id_hocphi'],
                $validated['id_monhoc'],
                $validated['id_mien_giam']
            );

            return response()->json($result, $result['success'] ? 200 : 400);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong HocPhiController::updateMienGiam: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật miễn giảm'
            ], 500);
        }
    }


    public function sales()
    {
        try {
            $data = $this->hocPhiService->getSalesOverview();
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();
            return view('qlhp.sale', [
                'totalPaid' => $data['totalPaid'],
                'totalClasses' => $data['totalClasses'],
                'classSummary' => $data['classSummary'],
                'khoas' => $khoaResult['success'] ? $khoaResult['data'] : collect([])
            ]);
        } catch (\Exception $e) {
            \Log::error('Lỗi khi lấy thống kê doanh thu: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải dữ liệu thống kê');
        }
    }

    public function salesDetail($lop)
    {
        try {
            $students = $this->hocPhiService->getSalesDetailByClass($lop);
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();
            return view('qlhp.saleDetail', [
                'lop' => $lop,
                'students' => $students,
                'khoas' => $khoaResult['success'] ? $khoaResult['data'] : collect([])
            ]);
        } catch (\Exception $e) {
            \Log::error('Lỗi khi lấy chi tiết doanh thu lớp: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi tải dữ liệu chi tiết');
        }
    }
}
