<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class MienGiamRepository
{
    public function getAll()
    {
        try {
            return DB::table('mien_giam_hoc_phi as mg')
                ->select(
                    'mg.*',
                    'm.ten_monhoc',
                    'm.so_tin_chi'
                )
                ->join('monhoc as m', 'mg.id_monhoc', '=', 'm.id_monhoc')
                ->orderBy('mg.ngay_bat_dau', 'desc')
                ->get();
        } catch (\Exception $e) {

            throw $e;
        }
    }

    public function find($id)
    {
        try {
            return DB::table('mien_giam_hoc_phi as mg')
                ->select(
                    'mg.*',
                    'm.ten_monhoc',
                    'm.so_tin_chi'
                )
                ->join('monhoc as m', 'mg.id_monhoc', '=', 'm.id_monhoc')
                ->where('mg.id_mien_giam', $id)
                ->first();
        } catch (\Exception $e) {

            throw $e;
        }
    }

    public function create(array $data)
    {
        try {
            return DB::table('mien_giam_hoc_phi')->insert([
                'id_monhoc' => $data['id_monhoc'],
                'ty_le_mien_giam' => $data['ty_le_mien_giam'] ?? null,
                'so_tien_mien_giam' => $data['so_tien_mien_giam'] ?? null,
                'ngay_bat_dau' => $data['ngay_bat_dau'],
                'ngay_ket_thuc' => $data['ngay_ket_thuc'],
                'mo_ta' => $data['mo_ta'],
                'trang_thai' => 'active'
            ]);
        } catch (\Exception $e) {

            throw $e;
        }
    }

    public function update($id, array $data)
    {
        try {
            return DB::table('mien_giam_hoc_phi')
                ->where('id_mien_giam', $id)
                ->update([
                    'id_monhoc' => $data['id_monhoc'] ?? null,
                    'ty_le_mien_giam' => $data['ty_le_mien_giam'] ?? null,
                    'so_tien_mien_giam' => $data['so_tien_mien_giam'] ?? null,
                    'ngay_bat_dau' => $data['ngay_bat_dau'],
                    'ngay_ket_thuc' => $data['ngay_ket_thuc'],
                    'mo_ta' => $data['mo_ta'],
                    'trang_thai' => $data['trang_thai'] ?? 'active'
                ]);
        } catch (\Exception $e) {

            throw $e;
        }
    }

    public function delete($id)
    {
        try {
            return DB::table('mien_giam_hoc_phi')
                ->where('id_mien_giam', $id)
                ->delete();
        } catch (\Exception $e) {

            throw $e;
        }
    }

    public function checkExistingDiscount($idMonHoc, $ngayBatDau, $ngayKetThuc, $excludeId = null)
    {
        try {
            $query = DB::table('mien_giam_hoc_phi')
                ->where('id_monhoc', $idMonHoc)
                ->where('trang_thai', 'active')
                ->where(function ($q) use ($ngayBatDau, $ngayKetThuc) {
                    $q->whereBetween('ngay_bat_dau', [$ngayBatDau, $ngayKetThuc])
                        ->orWhereBetween('ngay_ket_thuc', [$ngayBatDau, $ngayKetThuc])
                        ->orWhere(function ($q) use ($ngayBatDau, $ngayKetThuc) {
                            $q->where('ngay_bat_dau', '<=', $ngayBatDau)
                                ->where('ngay_ket_thuc', '>=', $ngayKetThuc);
                        });
                });

            if ($excludeId) {
                $query->where('id_mien_giam', '!=', $excludeId);
            }

            return $query->exists();
        } catch (\Exception $e) {

            throw $e;
        }
    }
}
