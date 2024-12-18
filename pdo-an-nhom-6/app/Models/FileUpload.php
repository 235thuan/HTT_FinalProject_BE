<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $table = 'file_upload';
    protected $primaryKey = 'id_file';

    protected $fillable = [
        'ten_file',
        'loai_file',
        'duong_dan',
        'ngay_upload',
        'id_chuyennganh',
        'id_khoa',
        'id_monhoc',
        'id_lop'
    ];

    /**
     * Tự động cập nhật thời gian tạo khi upload file
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->ngay_upload = now();
        });
    }

    /**
     * Relationship với bảng chuyennganh
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chuyenNganh()
    {
        return $this->belongsTo(ChuyenNganh::class, 'id_chuyennganh', 'id_chuyennganh');
    }

    /**
     * Relationship với bảng khoa
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'id_khoa', 'id_khoa');
    }

    /**
     * Relationship với bảng monhoc
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'id_monhoc', 'id_monhoc');
    }

    /**
     * Relationship với bảng lop
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lop()
    {
        return $this->belongsTo(Lop::class, 'id_lop', 'id_lop');
    }

    /**
     * Scope để lọc file theo loại
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('loai_file', $type);
    }

    /**
     * Kiểm tra xem file có thuộc về entity nào không
     * @return bool
     */
    public function hasOwner()
    {
        return !is_null($this->id_chuyennganh) ||
            !is_null($this->id_khoa) ||
            !is_null($this->id_monhoc) ||
            !is_null($this->id_lop);
    }

    /**
     * Lấy đường dẫn đầy đủ của file
     * @return string
     */
    public function getFullPathAttribute()
    {
        return asset($this->duong_dan);
    }
}
