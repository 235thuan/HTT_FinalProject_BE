<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use App\Models\ChuyenNganh;
use App\Models\MonHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClientMonhocController extends Controller
{
    public function index()
    {
        try {
            // Verify if ChuyenNganh model exists and table has data
            $chuyenNganhs = ChuyenNganh::select('id_chuyennganh', 'ten_chuyennganh')->get();

            // Log if query returns empty
            if ($chuyenNganhs->isEmpty()) {
                \Log::warning('No ChuyenNganh data found');
            }

            $randomSubjects = MonHoc::select('id_monhoc', 'ten_monhoc')
                ->orderByRaw('RAND()')
                ->limit(4)
                ->get();

            $randomMonhoc = MonHoc::select('id_monhoc', 'ten_monhoc')
                ->orderByRaw('RAND()')
                ->limit(4)
                ->get();
            // Get all monhoc for the right column
            $allMonhoc = MonHoc::select('id_monhoc', 'ten_monhoc')
                ->get();

            // Separate into featured (2) and remaining monhoc
            $featuredMonhoc = $allMonhoc->random(2);
            $remainingMonhoc = $allMonhoc->whereNotIn('id_monhoc', $featuredMonhoc->pluck('id_monhoc'));


            // Make sure all variables are defined before passing to view
            return view('vuong.monhoc', [
                'chuyenNganhs' => $chuyenNganhs,
                'randomSubjects' => $randomSubjects,
                'randomMonhoc' => $randomMonhoc,
                'featuredMonhoc'=> $featuredMonhoc,
                'remainingMonhoc' =>$remainingMonhoc,
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in monhoc index: ' . $e->getMessage());

            // Always return empty collections if error occurs
            return view('vuong.monhoc', [
                'chuyenNganhs' => collect(),
                'randomSubjects' => collect(),
                'randomMonhoc' => collect()
            ]);
        }
    }

    public function getMonhocByChuyenNganh($id_chuyennganh)
    {
        try {
            // Get all monhoc for this chuyennganh
            $monhocs = MonHoc::where('id_chuyennganh', $id_chuyennganh)
                ->select('id_monhoc', 'ten_monhoc')
                ->get();

            // Split into featured (first 2) and remaining
            $featured = $monhocs->take(2);
            $remaining = $monhocs->skip(2);

            return response()->json([
                'status' => true,  // Changed from 'success' to 'status'
                'featured' => $featured,
                'remaining' => $remaining
            ]);

        } catch (\Exception $e) {
            \Log::error('Error fetching monhoc: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra'
            ], 500);
        }
    }
}
