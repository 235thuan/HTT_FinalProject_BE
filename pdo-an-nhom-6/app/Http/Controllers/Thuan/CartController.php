<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($id_chuyennganh)
    {
        try {
            // Get chuyennganh info with more details
            $chuyenNganh = DB::table('chuyennganh')
                ->join('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
                ->where('chuyennganh.id_chuyennganh', $id_chuyennganh)
                ->select(
                    'chuyennganh.id_chuyennganh',
                    'chuyennganh.ten_chuyennganh',
                    'chuyennganh.image_url',
                    'khoa.ten_khoa',
                    'khoa.id_khoa'
                )
                ->first();

            if (!$chuyenNganh) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy chuyên ngành'
                ]);
            }

            // Get list of subjects and their prices
            $monHocList = DB::table('chitietchuyennganh')
                ->join('monhoc', 'chitietchuyennganh.ma_monhoc', '=', 'monhoc.id_monhoc')
                ->join('chitiethocphi', 'monhoc.id_monhoc', '=', 'chitiethocphi.ma_monhoc')
                ->where('chitietchuyennganh.ma_chuyennganh', $id_chuyennganh)
                ->select(
                    'monhoc.id_monhoc',
                    'monhoc.ten_monhoc',
                    'monhoc.so_tin_chi',
                    'chitiethocphi.so_tien as price'
                )
                ->get();

            $totalPrice = $monHocList->sum('price');

            // Get cart from session
            $cart = Session::get('cart', []);

            // Add item to cart with more details
            $cart[$id_chuyennganh] = [
                'id_chuyennganh' => $chuyenNganh->id_chuyennganh,
                'ten_chuyennganh' => $chuyenNganh->ten_chuyennganh,
                'image_url' => $chuyenNganh->image_url,
                'ten_khoa' => $chuyenNganh->ten_khoa,
                'id_khoa' => $chuyenNganh->id_khoa,
                'price' => $totalPrice,
                'monhoc_list' => $monHocList->toArray(),
                'added_at' => now()->toDateTimeString()
            ];

            // Save cart back to session
            Session::put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Đã thêm vào giỏ hàng',
                'cart' => $cart
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ]);
        }
    }

    public function removeFromCart($id_chuyennganh)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id_chuyennganh]);
        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa khỏi giỏ hàng'
        ]);
    }

    public function viewCart()
    {
        $cart = Session::get('cart', []);
        
        // Get list of available chuyen nganh for testing
        $chuyenNganhs = DB::table('chuyennganh')
            ->join('khoa', 'chuyennganh.ma_khoa', '=', 'khoa.id_khoa')
            ->select(
                'chuyennganh.id_chuyennganh',
                'chuyennganh.ten_chuyennganh',
                'khoa.ten_khoa'
            )
            ->get();
        
        // Calculate total price for all items
        $totalPrice = collect($cart)->sum('price');
        
        return view('thuan.hocphi.test', [
            'cart' => $cart,
            'totalPrice' => $totalPrice,
            'chuyenNganhs' => $chuyenNganhs
        ]);
    }
} 