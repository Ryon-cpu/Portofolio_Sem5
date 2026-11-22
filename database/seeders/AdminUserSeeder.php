<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $name = config('portfolio.admin.name');
        $email = config('portfolio.admin.email');
        $password = config('portfolio.admin.password');

        if (! is_string($name) || ! is_string($email) || ! is_string($password) || $password === '') {
            throw new RuntimeException('Set ADMIN_NAME, ADMIN_EMAIL, and ADMIN_PASSWORD before running db:seed.');
        }

        User::query()->updateOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => $password],
        );
    }
}
