<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use App\Models\ThongBao;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()
            ->orderBy('thoi_gian', 'desc')
            ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    public function markAllAsRead()
    {
        try {
            // Debug log
            \Log::info('Marking all notifications as read for user: ' . auth()->id());

            // Direct DB update to ensure it works
            $updated = \DB::table('thong_bao')
                ->where('id_nguoidung', auth()->id())
                ->update(['da_doc' => 1]);

            \Log::info('Updated notifications count: ' . $updated);

            return response()->json([
                'success' => true,
                'message' => 'Đã đánh dấu tất cả là đã đọc',
                'updated_count' => $updated
            ]);
        } catch (\Exception $e) {
            \Log::error('Error marking all as read: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function markAsRead(Request $request)
    {
        $notification = ThongBao::findOrFail($request->id);
        $notification->update(['da_doc' => 1]);  // Use 1 instead of true

        return response()->json([
            'success' => true,
            'message' => 'Đã đánh dấu là đã đọc'
        ]);
    }
}
