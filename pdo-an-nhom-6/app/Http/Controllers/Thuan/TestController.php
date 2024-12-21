<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    public function testCart()
    {
        // Clear existing cart
        Session::forget('cart');
        
        // Get a sample chuyennganh for testing
        $chuyenNganh = DB::table('chuyennganh')
            ->join('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
            ->first();
            
        if ($chuyenNganh) {
            // Add to cart
            $cartController = new CartController();
            $cartController->addToCart($chuyenNganh->id_chuyennganh);
            
            // View cart
            return $cartController->viewCart();
        }
        
        return "No chuyennganh found for testing";
    }
} 