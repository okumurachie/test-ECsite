<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 管理者ユーザー
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'email_verified_at' => now(),
                'password' => Hash::make('admin1234'),
                'remember_token' => Str::random(10),
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // テストユーザー
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email_verified_at' => now(),
                'password' => Hash::make('abcd1234'),
                'remember_token' => Str::random(10),
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // その他のテストユーザー
        User::factory(4)->create();
    }
}
