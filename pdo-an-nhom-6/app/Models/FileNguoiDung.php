<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileNguoiDung extends Model
{
    protected $table = 'file_nguoidung';
    protected $primaryKey = 'id_file';
    public $timestamps = false;

    protected $fillable = [
        'id_nguoidung',
        'ten_file',
        'loai_file',
        'duong_dan',
        'ngay_upload'
    ];

    public function user()
    {
        return $this->belongsTo(NguoiDung::class, 'id_nguoidung', 'id_nguoidung');
    }
}
