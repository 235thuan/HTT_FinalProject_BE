<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use App\Models\ChuyenNganh;
use App\Models\MonHoc;
use App\Services\Thuan\HomeService;
use App\Services\Thuan\ThongKeService;
use Illuminate\Http\Request;
use App\Services\Thuan\ChuyenNganhService;
use App\Services\Thuan\MonHocService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $chuyenNganhService;
    protected $monHocService;
    protected $homeService;
    protected $thongKeService;

    public function __construct(
        ChuyenNganhService $chuyenNganhService,
        MonHocService $monHocService,
        HomeService $homeService,
        ThongKeService $thongKeService
    ) {
        $this->chuyenNganhService = $chuyenNganhService;
        $this->monHocService = $monHocService;
        $this->homeService = $homeService;
        $this->thongKeService = $thongKeService;

        // Share user avatar with all views using view composer
        View::composer('*', function($view) {
            if (Auth::check()) {
                $userAvatar = DB::table('file_nguoidung')
                    ->where('id_nguoidung', Auth::id())
                    ->where('loai_file', 'avatar')
                    ->orderBy('ngay_upload', 'desc')
                    ->first();

                $view->with('userAvatar', $userAvatar ? asset($userAvatar->duong_dan) : null);
            }
        });
    }

    public function index()
    {
        try {
            $monHocResult = $this->monHocService->getMonHocForHomePage();
            $chuyenNganhResult = $this->chuyenNganhService->getChuyenNganhForHomePage();
            $thongkeresult = $this->thongKeService->getTopChuyenNganh();

            // Debug the result
            \Log::info('ThongKe Result:', ['data' => $thongkeresult]);

            if (!$chuyenNganhResult['success']) {
                return view('thuan.home')->with('error', 'Lỗi khi tải dữ liệu chuyên ngành');
            }

            if (!$monHocResult['success']) {
                return view('thuan.home')->with('error', $monHocResult['message'] ?? 'Lỗi khi tải dữ liệu môn học');
            }

            if (!$thongkeresult['success']) {
                return view('thuan.home')->with('error', $thongkeresult['message']);
            }

            $viewData = [
                'topChuyenNganhs' => $thongkeresult['data'] ?? collect([]),
                'chuyenNganhs' => $chuyenNganhResult['chuyenNganhs'],
                'soNhom' => $chuyenNganhResult['soNhom'],
                'monHocs' => $monHocResult['monHocs']
            ];

            // Debug the view data
            \Log::info('View Data:', $viewData);

            return view('thuan.home', $viewData);

        } catch (\Exception $e) {
            Log::error('Lỗi không mong muốn trong HomeController: ' . $e->getMessage());
            return view('thuan.home', [
                'error' => 'Có lỗi xảy ra, vui lòng thử lại sau',
                'topChuyenNganhs' => collect([]),
                'chuyenNganhs' => collect([]),
                'soNhom' => 0,
                'monHocs' => collect([])
            ]);
        }
    }

    public function chuyenNganh()
    {
        try {
            $result = $this->chuyenNganhService->getChuyenNganhForHomePage();

            if (!$result['success']) {
                return back()->with('error', 'Có lỗi xảy ra khi tải dữ liệu');
            }

            return view('thuan.chuyennganh.chuyennganh', [
                'chuyenNganhs' => $result['chuyenNganhs'],
                'soNhom' => $result['soNhom']
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in HomeController@chuyenNganh: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau.');
        }
    }

    public function showChuyenNganh($id)
    {
        try {
            $result = $this->chuyenNganhService->getChuyenNganhDetail($id);

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            return view('thuan.chuyennganh.chuyennganh', [
                'chuyenNganh' => $result['chuyenNganh'],
                'monHocs' => $result['monHocs'],
                'files' => $result['files']
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in HomeController@showChuyenNganh: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau.');
        }
    }

    public function aboutUs(){
        return view('thuan.about-us');
    }
}
