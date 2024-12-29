<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class MienGiamRepository
{
    public function getAll()
    {
        try {
            return DB::table('mien_giam_hoc_phi as mg')
                ->select([
                    'mg.id_mien_giam',
                    'mg.id_monhoc',
                    'mg.ty_le_mien_giam',
                    'mg.so_tien_mien_giam',
                    'mg.ngay_bat_dau',
                    'mg.ngay_ket_thuc',
                    'mg.mo_ta',
                    'mg.trang_thai',
                    'm.ten_monhoc',
                    'm.so_tin_chi'
                ])
                ->join('monhoc as m', 'mg.id_monhoc', '=', 'm.id_monhoc')
                ->orderBy('mg.ngay_bat_dau', 'desc')
                ->get();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamRepository::getAll: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getMonHocList()
    {
        try {
            return DB::table('monhoc')
                ->select([
                    'id_monhoc',
                    'ten_monhoc',
                    'so_tin_chi'
                ])
                ->orderBy('ten_monhoc')
                ->get();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamRepository::getMonHocList: ' . $e->getMessage());
            throw $e;
        }
    }

    public function findOverlappingMienGiam($idMonHoc, $ngayBatDau, $ngayKetThuc = null, $excludeId = null)
    {
        try {
            $query = DB::table('mien_giam_hoc_phi')
                ->where('id_monhoc', $idMonHoc)
                ->where('trang_thai', 'active')
                ->where(function($q) use ($ngayBatDau, $ngayKetThuc) {
                    // Trường hợp 1: Ngày bắt đầu mới nằm trong khoảng thời gian của miễn giảm cũ
                    $q->where(function($q1) use ($ngayBatDau) {
                        $q1->where('ngay_bat_dau', '<=', $ngayBatDau)
                            ->where(function($q2) use ($ngayBatDau) {
                                $q2->whereNull('ngay_ket_thuc')
                                    ->orWhere('ngay_ket_thuc', '>=', $ngayBatDau);
                            });
                    });

                    // Trường hợp 2: Ngày kết thúc mới nằm trong khoảng thời gian của miễn giảm cũ
                    if ($ngayKetThuc) {
                        $q->orWhere(function($q1) use ($ngayKetThuc) {
                            $q1->where('ngay_bat_dau', '<=', $ngayKetThuc)
                                ->where(function($q2) use ($ngayKetThuc) {
                                    $q2->whereNull('ngay_ket_thuc')
                                        ->orWhere('ngay_ket_thuc', '>=', $ngayKetThuc);
                                });
                        });
                    }

                    // Trường hợp 3: Miễn giảm cũ nằm hoàn toàn trong khoảng thời gian mới
                    $q->orWhere(function($q1) use ($ngayBatDau, $ngayKetThuc) {
                        $q1->where('ngay_bat_dau', '>=', $ngayBatDau)
                            ->where(function($q2) use ($ngayKetThuc) {
                                if ($ngayKetThuc) {
                                    $q2->where('ngay_bat_dau', '<=', $ngayKetThuc);
                                }
                            });
                    });
                });

            // Loại trừ ID hiện tại khi đang edit
            if ($excludeId) {
                $query->where('id_mien_giam', '!=', $excludeId);
            }

            return $query->first();

        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamRepository::findOverlappingMienGiam: ' . $e->getMessage());
            throw $e;
        }
    }
    public function findById($id)
    {
        try {
            return DB::table('mien_giam_hoc_phi as mg')
                ->select([
                    'mg.id_mien_giam',
                    'mg.id_monhoc',
                    'mg.ty_le_mien_giam',
                    'mg.so_tien_mien_giam',
                    'mg.ngay_bat_dau',
                    'mg.ngay_ket_thuc',
                    'mg.mo_ta',
                    'mg.trang_thai',
                    'm.ten_monhoc',
                    'm.so_tin_chi'
                ])
                ->join('monhoc as m', 'mg.id_monhoc', '=', 'm.id_monhoc')
                ->where('mg.id_mien_giam', $id)
                ->first();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamRepository::findById: ' . $e->getMessage());
            throw $e;
        }
    }

    public function create(array $data)
    {
        try {
            $id = DB::table('mien_giam_hoc_phi')->insertGetId([
                'id_monhoc' => $data['id_monhoc'],
                'ty_le_mien_giam' => $data['ty_le_mien_giam'],
                'so_tien_mien_giam' => $data['so_tien_mien_giam'],
                'ngay_bat_dau' => $data['ngay_bat_dau'],
                'ngay_ket_thuc' => $data['ngay_ket_thuc'],
                'mo_ta' => $data['mo_ta'],
                'trang_thai' => 'active',

            ]);

            return $this->findById($id);
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamRepository::create: ' . $e->getMessage());
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        try {
            $updated = DB::table('mien_giam_hoc_phi')
                ->where('id_mien_giam', $id)
                ->update([
                    'id_monhoc' => $data['id_monhoc'],
                    'ty_le_mien_giam' => $data['ty_le_mien_giam'],
                    'so_tien_mien_giam' => $data['so_tien_mien_giam'],
                    'ngay_bat_dau' => $data['ngay_bat_dau'],
                    'ngay_ket_thuc' => $data['ngay_ket_thuc'],
                    'mo_ta' => $data['mo_ta'],
                    'trang_thai' => $data['trang_thai'],
                ]);

            if ($updated) {
                return $this->findById($id);
            }
            return false;
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamRepository::update: ' . $e->getMessage());
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
            \Log::error('Lỗi trong MienGiamRepository::delete: ' . $e->getMessage());
            throw $e;
        }
    }

    public function isBeingUsed($id)
    {
        try {
            return DB::table('chitiethocphi')
                ->where('id_mien_giam', $id)
                ->exists();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamRepository::isBeingUsed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getActiveMienGiamByMonHoc($idMonHoc)
    {
        try {
            return DB::table('mien_giam_hoc_phi')
                ->where('id_monhoc', $idMonHoc)
                ->where('trang_thai', 'active')
                ->whereDate('ngay_bat_dau', '<=', now())
                ->where(function($query) {
                    $query->whereDate('ngay_ket_thuc', '>=', now())
                        ->orWhereNull('ngay_ket_thuc');
                })
                ->get();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamRepository::getActiveMienGiamByMonHoc: ' . $e->getMessage());
            throw $e;
        }
    }

    public function checkOverlappingDates($idMonHoc, $ngayBatDau, $ngayKetThuc, $excludeId = null)
    {
        try {
            $query = DB::table('mien_giam_hoc_phi')
                ->where('id_monhoc', $idMonHoc)
                ->where('trang_thai', 'active');

            if ($excludeId) {
                $query->where('id_mien_giam', '!=', $excludeId);
            }

            return $query->where(function($query) use ($ngayBatDau, $ngayKetThuc) {
                $query->where(function($q) use ($ngayBatDau) {
                    $q->whereDate('ngay_bat_dau', '<=', $ngayBatDau)
                        ->where(function($q2) use ($ngayBatDau) {
                            $q2->whereDate('ngay_ket_thuc', '>=', $ngayBatDau)
                                ->orWhereNull('ngay_ket_thuc');
                        });
                })->orWhere(function($q) use ($ngayKetThuc) {
                    $q->whereDate('ngay_bat_dau', '<=', $ngayKetThuc)
                        ->where(function($q2) use ($ngayKetThuc) {
                            $q2->whereDate('ngay_ket_thuc', '>=', $ngayKetThuc)
                                ->orWhereNull('ngay_ket_thuc');
                        });
                });
            })->exists();
        } catch (\Exception $e) {
            \Log::error('Lỗi trong MienGiamRepository::checkOverlappingDates: ' . $e->getMessage());
            throw $e;
        }
    }
}
