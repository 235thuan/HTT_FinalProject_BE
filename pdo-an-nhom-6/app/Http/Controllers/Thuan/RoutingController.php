<?php

namespace App\Http\Controllers\Thuan;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class RoutingController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // $this->
        // middleware('auth')->
        // except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            return redirect('index');
        } else {
            return redirect('login');
        }
    }

    /**
     * Display a view based on first route param
     *
     * @return \Illuminate\Http\Response
     */
    public function root($first)
    {
        return view($first);
    }

    /**
     * second level route
     */
    public function secondLevel($first, $second)
    {
        \Log::info('RoutingController@secondLevel', [
            'first' => $first,
            'second' => $second,
            'url' => request()->url(),
            'route' => request()->route()->getName()
        ]);

        // Skip handling QLND routes - let the explicit routes handle them
        if ($first === 'qlnd' && ($second === 'listSinhvien' || $second === 'listGiaovien')) {
            \Log::info('Skipping QLND route in RoutingController');
            return null;
        }

        // If not a special route, try to load the view
        try {
            return view($first.'.'.$second);
        } catch (\Exception $e) {
            \Log::error('View not found: '.$first.'.'.$second);
            abort(404);
        }
    }

    /**
     * third level route
     */
    public function thirdLevel($first, $second, $third)
    {
        // If this is an asset request, return a 404
        if ($first === 'assets') {
            abort(404);
        }

        return view($first.'.'.$second.'.'.$third);
    }

    public function detail(Request $request)
    {
        $type = $request->query('type', 'sinhvien');
        $id = $request->query('id');

        if ($type === 'giaovien') {
            return app(GiaoVienController::class)->detail($id);
        } else {
            return app(SinhVienController::class)->detail($id);
        }
    }
}
