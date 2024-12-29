<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use App\Services\Thuan\KhoaService;
use App\Services\Thuan\MienGiamService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MienGiamController extends Controller
{
    protected $mienGiamService;
    protected $khoaService;

    public function __construct(MienGiamService $mienGiamService, KhoaService $khoaService)
    {
        $this->mienGiamService = $mienGiamService;
        $this->khoaService = $khoaService;
    }

    public function index()
    {
        try {
            $result = $this->mienGiamService->getAllMienGiam();
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();
            return view('miengiam.index', ['mienGiamList' => $result['data'],'khoas' => $khoaResult['success'] ? $khoaResult['data'] : collect([])]);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamController::index: ' . $e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Có lỗi xảy ra']);
        }
    }

    public function create()
    {
        try {
            $monHocList = $this->mienGiamService->getMonHocList();
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();
            return view('miengiam.create', ['monHocList' => $monHocList['data'],'khoas' => $khoaResult['success'] ? $khoaResult['data'] : collect([])]);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamController::create: ' . $e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Có lỗi xảy ra']);
        }
    }

    public function checkOverlap(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_monhoc' => 'required|exists:monhoc,id_monhoc',
                'ngay_bat_dau' => 'required|date',
                'ngay_ket_thuc' => 'nullable|date|after:ngay_bat_dau',
                'id_mien_giam' => 'nullable|exists:mien_giam_hoc_phi,id_mien_giam' // For edit form
            ]);

            // Check for overlapping dates in repository
            $hasOverlap = $this->mienGiamService->checkOverlappingDates(
                $validated['id_monhoc'],
                $validated['ngay_bat_dau'],
                $validated['ngay_ket_thuc'],
                $validated['id_mien_giam'] ?? null // Pass current ID when editing
            );

            return response()->json([
                'overlap' => $hasOverlap,
                'message' => $hasOverlap
                    ? 'Đã có miễn giảm trong khoảng thời gian này'
                    : 'Không có miễn giảm trùng lặp'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'overlap' => true,
                'message' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamController::checkOverlap: ' . $e->getMessage());
            return response()->json([
                'overlap' => true,
                'message' => 'Có lỗi xảy ra khi kiểm tra trùng lặp'
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_monhoc' => 'required|exists:monhoc,id_monhoc',
                'ty_le_mien_giam' => 'required|numeric|min:0|max:100',
                'so_tien_mien_giam' => 'nullable|numeric|min:0',
                'ngay_bat_dau' => 'required|date',
                'ngay_ket_thuc' => 'nullable|date|after:ngay_bat_dau',
                'mo_ta' => 'required|string|max:255'
            ]);

            $result = $this->mienGiamService->createMienGiam($validated);

            if (!$result['success']) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['message' => $result['message']]);
            }

            return redirect()->route('miengiam.index')
                ->with('success', 'Thêm miễn giảm thành công');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamController::store: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Có lỗi xảy ra khi thêm miễn giảm']);
        }
    }

    public function edit($id)
    {
        try {
            $result = $this->mienGiamService->getMienGiamById($id);
            $monHocList = $this->mienGiamService->getMonHocList();
            $khoaResult = $this->khoaService->getKhoasWithChuyenNganh();
            if (!$result['success']) {
                return redirect()->route('miengiam.index')
                    ->withErrors(['message' => $result['message']]);
            }

            return view('miengiam.edit', [
                'mienGiam' => $result['data'],
                'monHocList' => $monHocList['data'],
                'khoas' => $khoaResult['success'] ? $khoaResult['data'] : collect([])
            ]);

        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamController::edit: ' . $e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Có lỗi xảy ra']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'id_monhoc' => 'required|exists:monhoc,id_monhoc',
                'ty_le_mien_giam' => 'required|numeric|min:0|max:100',
                'so_tien_mien_giam' => 'nullable|numeric|min:0',
                'ngay_bat_dau' => 'required|date',
                'ngay_ket_thuc' => 'nullable|date|after:ngay_bat_dau',
                'mo_ta' => 'required|string|max:255',
                'trang_thai' => 'required|in:active,inactive'
            ]);

            $result = $this->mienGiamService->updateMienGiam($id, $validated);

            if (!$result['success']) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['message' => $result['message']]);
            }

            return redirect()->route('miengiam.index')
                ->with('success', 'Cập nhật miễn giảm thành công');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamController::update: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Có lỗi xảy ra khi cập nhật miễn giảm']);
        }
    }

    public function destroy($id)
    {
        try {
            \Log::info('Attempting to delete mien giam with ID: ' . $id); // Add logging

            $result = $this->mienGiamService->deleteMienGiam($id);

            if (!$result['success']) {
                \Log::warning('Failed to delete mien giam: ' . $result['message']);
                return response()->json([
                    'success' => false,
                    'message' => $result['message']
                ], 400);
            }

            \Log::info('Successfully deleted mien giam with ID: ' . $id);
            return response()->json([
                'success' => true,
                'message' => 'Xóa miễn giảm thành công'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in MienGiamController::destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa miễn giảm'
            ], 500);
        }
    }
}
