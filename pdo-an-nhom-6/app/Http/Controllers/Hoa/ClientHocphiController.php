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

    public function processPayment(Request $request)
    {
        try {
            DB::beginTransaction();

            $userId = Auth::id();

            // Get JSON data
            $data = $request->json()->all();

            // Log the input values
            \Log::info('Payment request data:', [
                'id_cardnumber' => $data['id_cardnumber'] ?? null,
                'id_cvv' => $data['id_cvv'] ?? null,
                'id_expirydate' => $data['id_expirydate'] ?? null,
                'id_billingaddress' => $data['id_billingaddress'] ?? null
            ]);

            // Get cart and log it
            $cart = Session::get('cart.' . $userId, []);
            $selectedSemester = Session::get("user_selection.$userId");

            \Log::info('Cart data:', [
                'cart' => $cart,
                'selectedSemester' => $selectedSemester
            ]);

            // Validate card information
            $soduTaiKhoan = DB::table('sodutaikhoan')
                ->where('id_cardnumber', $data['id_cardnumber'])
                ->where('id_cvv', $data['id_cvv'])
                ->where('id_expirydate', $data['id_expirydate'])
                ->where('id_billingaddress', $data['id_billingaddress'])
                ->first();

            if (!$soduTaiKhoan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Thông tin thẻ không hợp lệ'
                ], 400);
            }

            // Calculate total amount from cart
            $totalAmount = collect($cart)->sum('price');

            // Check sufficient balance
            if ($soduTaiKhoan->amount < $totalAmount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số dư không đủ để thanh toán'
                ], 400);
            }

            // Get or create sinhvien record
            $sinhvien = DB::table('sinhvien')->where('id_nguoidung', $userId)->first();
            if (!$sinhvien) {
                $nguoidung = DB::table('nguoidung')->where('id_nguoidung', $userId)->first();
                $sinhvienId = DB::table('sinhvien')->insertGetId([
                    'id_nguoidung' => $userId,
                    'ten_sinhvien' => $nguoidung->ten_dang_nhap,

                ]);
            } else {
                $sinhvienId = $sinhvien->id_sinhvien;
            }

            // Create hocphi record
            $hocphiId = DB::table('hocphi')->insertGetId([
                'id_sinhvien' => $userId,
                'so_tien' => $totalAmount,
                'trang_thai' => 'Đang xử lý',
            ]);

            // Create chitiethocphi records for each monhoc in the cart
            foreach ($cart as $chuyenNganh) {
                foreach ($chuyenNganh['monhoc_list'] as $monhoc) {
                    DB::table('chitiethocphi')->insert([
                        'id_hocphi' => $hocphiId,
                        'id_monhoc' => $monhoc->id_monhoc,
                        'ten_khoan_phi' => $monhoc->ten_monhoc,
                        'so_tien' => $monhoc->gia,
                        'ngay_ap_dung' => now()
                    ]);
                }
            }

            // Update account balance
            DB::table('sodutaikhoan')
                ->where('id_sodutaikhoan', $soduTaiKhoan->id_sodutaikhoan)
                ->update([
                    'amount' => $soduTaiKhoan->amount - $totalAmount,
                    'updated_at' => now()
                ]);

            // Create payment record
            $thanhtoanId = DB::table('thanhtoan')->insertGetId([
                'id_hocphi' => $hocphiId,
                'so_tien_da_tra' => $totalAmount,
                'phuong_thuc' => 'Thẻ tín dụng',
                'ngay_thanhtoan' => now(),
                'trang_thai' => 'Thành công'
            ]);

            // Update hocphi status
            DB::table('hocphi')
                ->where('id_hocphi', $hocphiId)
                ->update([
                    'trang_thai' => 'Đã thanh toán'
                ]);

            // Clear cart and semester selection
            Session::forget('cart.' . $userId);
            Session::forget("user_selection.$userId");

            DB::commit();
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Payment processing error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'cart' => Session::get('cart.' . Auth::id()),
                'semester' => Session::get('user_selection.' . Auth::id())
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}
