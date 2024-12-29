<?php

namespace App\Http\Controllers\Cuong;

use App\Http\Controllers\Controller;


class ProfileController extends Controller
{
    public function index() {
        return view('cuong.tcn');
    }

}
