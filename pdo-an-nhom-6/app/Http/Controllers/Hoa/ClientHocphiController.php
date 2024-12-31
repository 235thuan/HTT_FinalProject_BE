<?php

namespace App\Http\Controllers\Hoa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ClientHocphiController extends Controller
{
    public function addToCart($id_chuyennganh)
    {
        try {
            // Check if user is logged in
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm vào giỏ hàng');
            }

            $userId = Auth::id();

            // Get chuyennganh info
            $chuyenNganh = DB::table('chuyennganh')
                ->join('khoa', 'chuyennganh.id_khoa', '=', 'khoa.id_khoa')
                ->leftJoin('file_upload', function($join) {
                    $join->on('chuyennganh.id_chuyennganh', '=', 'file_upload.id_chuyennganh')
                        ->whereNull('file_upload.id_monhoc')
                        ->whereNull('file_upload.id_lop');
                })
                ->where('chuyennganh.id_chuyennganh', $id_chuyennganh)
                ->select(
                    'chuyennganh.*',
                    'khoa.ten_khoa',
                    'file_upload.duong_dan as image_url'
                )
                ->first();

            // Get monhoc list and calculate total price
            $monHocList = DB::table('monhoc')
                ->where('id_chuyennganh', $id_chuyennganh)
                ->get();

            $totalPrice = $monHocList->sum('gia');

            // Get user's cart or initialize empty array
            $cart = Session::get('cart.' . $userId, []);

            // Add/Update item in user's cart
            $cart[$id_chuyennganh] = [
                'id_chuyennganh' => $id_chuyennganh,
                'ten_chuyennganh' => $chuyenNganh->ten_chuyennganh,
                'image_url' => $chuyenNganh->image_url ?? 'storage/thuan/default.png',
                'ten_khoa' => $chuyenNganh->ten_khoa,
                'id_khoa' => $chuyenNganh->id_khoa,
                'price' => $totalPrice,
                'monhoc_list' => $monHocList->toArray(),
                'added_at' => now()->toDateTimeString()
            ];

            // Save user's cart back to session
            Session::put('cart.' . $userId, $cart);

            return redirect()->route('hoa.hocphi')->with('success', 'Đã thêm vào giỏ hàng');

        } catch (\Exception $e) {
            \Log::error('Error in addToCart:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $totalPrice = array_sum(array_column($cart, 'price'));

        // Get semester data for each major in cart
        $kyHocData = [];
        foreach ($cart as $item) {
            $kyHocData[$item['id_chuyennganh']] = [
                'ten_chuyennganh' => $item['ten_chuyennganh'],
                'ky_hoc' => DB::table('monhoc')
                    ->select('ky_hoc',
                        DB::raw('SUM(gia) as total_price'),
                        DB::raw('GROUP_CONCAT(ten_monhoc) as subjects'))
                    ->where('id_chuyennganh', $item['id_chuyennganh'])
                    ->groupBy('ky_hoc')
                    ->get()
            ];
        }

        return view('hoa.hocphi', compact('cart', 'totalPrice', 'kyHocData'));
    }
    private function getImageUrl($id_chuyennganh)
{
    $file = DB::table('file_upload')
        ->where('id_chuyennganh', $id_chuyennganh)
        ->where('loai_file', 'image')
        ->first();

    return $file ? $file->duong_dan : 'hoa/default.png';
}

    public function removeFromCart($id)
    {
        try {
            \Log::info('Attempting to remove item:', ['id' => $id]);

            if (!Auth::check()) {
                return redirect()->route('login');
            }

            $userId = Auth::id();
            $cart = Session::get('cart.' . $userId, []);

            if (!isset($cart[$id])) {
                \Log::warning('Item not found:', ['id' => $id]);
                return redirect()->back()->with('error', 'Không tìm thấy item trong giỏ hàng');
            }

            // Remove item from cart
            unset($cart[$id]);
            Session::put('cart.' . $userId, $cart);

            // Clear semester selection
            Session::forget("user_selection.$userId");

            \Log::info('Item removed successfully');

            return redirect()->back()->with('success', 'Đã xóa khỏi giỏ hàng');

        } catch (\Exception $e) {
            \Log::error('Error removing item:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function viewCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng');
        }

        $userId = Auth::id();
        $cart = Session::get('cart.' . $userId, []);

        // Get selected semester data from session
        $selectedSemester = Session::get("user_selection.$userId");

        // Calculate total price based on selection or default cart total
        $totalPrice = $selectedSemester ? $selectedSemester['price'] : collect($cart)->sum('price');

        // Get semester data for each major
        $kyHocData = [];
        foreach ($cart as $item) {
            $monHocList = DB::table('monhoc')
                ->where('id_chuyennganh', $item['id_chuyennganh'])
                ->select(
                    'ky_hoc',
                    DB::raw('SUM(gia) as total_price'),
                    DB::raw('GROUP_CONCAT(ten_monhoc SEPARATOR ", ") as subjects')
                )
                ->groupBy('ky_hoc')
                ->orderBy('ky_hoc')
                ->get();

            $kyHocData[$item['id_chuyennganh']] = [
                'ten_chuyennganh' => $item['ten_chuyennganh'],
                'ky_hoc' => $monHocList
            ];
        }

        return view('hoa.hocphi', [
            'cart' => $cart,
            'kyHocData' => $kyHocData,
            'totalPrice' => $totalPrice,
            'selectedSemester' => $selectedSemester // Pass selected semester to view
        ]);
    }


    public function saveSelection(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required',
                'ky_hoc' => 'required|integer',
                'price' => 'required|numeric'
            ]);

            // Save to session with user-specific key
            Session::put('user_semester_selection.' . $validated['user_id'], [
                'ky_hoc' => $validated['ky_hoc'],
                'price' => $validated['price']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Selection saved'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error saving selection:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error saving selection'
            ], 500);
        }
    }

    public function updateSession(Request $request)
    {
        try {
            // Debug log
            \Log::info('Received request data:', $request->all());

            $validated = $request->validate([
                'ky_hoc' => 'required|integer',
                'price' => 'required',
                'chuyennganh_id' => 'required'
            ]);

            $userId = Auth::id();

            // Store selection in session
            Session::put("user_selection.$userId", [
                'ky_hoc' => $validated['ky_hoc'],
                'price' => floatval($validated['price']), // Convert to float
                'chuyennganh_id' => $validated['chuyennganh_id']
            ]);

            \Log::info('Session updated:', Session::get("user_selection.$userId"));

            return redirect()->back()->with('success', 'Đã cập nhật kỳ học');

        } catch (\Exception $e) {
            \Log::error('Error updating session:', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
