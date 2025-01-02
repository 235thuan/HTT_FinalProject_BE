<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClientChuyennganhController extends Controller
{

    public function index()
    {
        return view('thuan.clientChuyennganh.clientCn');
    }

}
