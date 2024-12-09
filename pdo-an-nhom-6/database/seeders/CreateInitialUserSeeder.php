<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateInitialUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'ten_dang_nhap' => 'user01',
            'email' => 'user01@example.com',
            'mat_khau' => Hash::make('123456@a'),
            'trang_thai' => 'hoạt động'
        ]);
    }
} 