<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhongHoc extends Model
{
    protected $table = 'phonghoc';
    protected $primaryKey = 'id_phonghoc';
    public $timestamps = false;

    protected $fillable = [
        'ten_phonghoc',
        'so_cho_ngoi',
        'co_may_chieu',
        'khu_vuc'
    ];

    /**
     * Cast boolean field
     */
    protected $casts = [
        'co_may_chieu' => 'boolean'
    ];

    /**
     * Lấy danh sách thời khóa biểu của phòng học
     */
    public function thoiKhoaBieu()
    {
        return $this->hasMany(ThoiKhoaBieu::class, 'id_phonghoc');
    }

    /**
     * Kiểm tra phòng có trống trong khoảng thời gian
     */
    public function isAvailable($ngayHoc, $gioBatDau, $gioKetThuc)
    {
        return !$this->thoiKhoaBieu()
            ->where('ngay_hoc', $ngayHoc)
            ->where(function ($query) use ($gioBatDau, $gioKetThuc) {
                $query->whereBetween('gio_bat_dau', [$gioBatDau, $gioKetThuc])
                    ->orWhereBetween('gio_ket_thuc', [$gioBatDau, $gioKetThuc]);
            })
            ->exists();
    }

    /**
     * Lấy danh sách phòng trống trong khoảng thời gian
     */
    public static function getAvailableRooms($ngayHoc, $gioBatDau, $gioKetThuc, $soChoNgoiToiThieu = 0)
    {
        return static::whereNotIn('id_phonghoc', function ($query) use ($ngayHoc, $gioBatDau, $gioKetThuc) {
            $query->select('id_phonghoc')
                ->from('thoikhoabieu')
                ->where('ngay_hoc', $ngayHoc)
                ->where(function ($q) use ($gioBatDau, $gioKetThuc) {
                    $q->whereBetween('gio_bat_dau', [$gioBatDau, $gioKetThuc])
                        ->orWhereBetween('gio_ket_thuc', [$gioBatDau, $gioKetThuc]);
                });
        })
            ->when($soChoNgoiToiThieu > 0, function ($query) use ($soChoNgoiToiThieu) {
                return $query->where('so_cho_ngoi', '>=', $soChoNgoiToiThieu);
            })
            ->orderBy('khu_vuc')
            ->orderBy('ten_phonghoc')
            ->get();
    }
}
