<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    /**
     * Tên bảng trong CSDL
     * @var string
     */
    protected $table = 'khoa';

    /**
     * Khóa chính của bảng
     * @var string
     */
    protected $primaryKey = 'id_khoa';

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
        'ten_khoa'
    ];

    /**
     * Relationship với bảng chuyennganh
     * Một khoa có nhiều chuyên ngành
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chuyenNganhs()
    {
        return $this->hasMany(ChuyenNganh::class, 'ma_khoa', 'id_khoa');
    }

    /**
     * Relationship với bảng file_upload
     * Một khoa có thể có nhiều file
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(FileUpload::class, 'id_khoa', 'id_khoa');
    }
}
