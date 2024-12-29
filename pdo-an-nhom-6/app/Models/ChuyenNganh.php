<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChuyenNganh extends Model
{
    /**
     * Tên bảng trong CSDL
     * @var string
     */
    protected $table = 'chuyennganh';

    /**
     * Khóa chính của bảng
     * @var string
     */
    protected $primaryKey = 'id_chuyennganh';

    /**
     * Không sử dụng timestamps (created_at, updated_at)
     * @var bool
     */
    public $timestamps = false;

    /**
     * Các trường có thể gán giá trị hàng loạt
     * @var array
     */
    protected $fillable = [
        'ten_chuyennganh',
        'id_khoa'

    ];

    /**
     * Relationship với bảng khoa
     * Một chuyên ngành thuộc về một khoa
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'id_khoa', 'id_khoa');
    }

    /**
     * Relationship với bảng file_upload
     * Một chuyên ngành có thể có nhiều file
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(FileUpload::class, 'id_chuyennganh', 'id_chuyennganh');
    }

    /**
     * Lấy file ảnh đại diện mới nhất của chuyên ngành
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getLatestImageAttribute()
    {
        return $this->files()
            ->where('loai_file', 'image')
            ->orderBy('ngay_upload', 'desc')
            ->first();
    }

    /**
     * Lấy URL ảnh đại diện của chuyên ngành
     * @return string
     */
    public function getImageUrlAttribute()
    {
        $file = $this->latest_image;
        return $file ? asset($file->duong_dan) : asset('path/to/default/image.jpg');
    }



    public function chiTietChuyenNganh()
    {
        return $this->hasMany(ChiTietChuyenNganh::class, 'id_chuyennganh', 'id_chuyennganh');
    }

    public function monHocs()
    {
        return $this->belongsToMany(
            MonHoc::class,
            'chitietchuyennganh',
            'id_chuyennganh',
            'id_monhoc'
        );
    }
}
