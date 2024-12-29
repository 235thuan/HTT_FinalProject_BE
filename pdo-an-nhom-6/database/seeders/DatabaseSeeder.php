<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NguoiDung;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        NguoiDung::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);
    }
}
