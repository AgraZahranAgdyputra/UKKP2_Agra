<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $accounts = [
            ['name' => 'Administrator', 'email' => 'admin@mail.com', 'role' => 'admin'],
            ['name' => 'Staff',         'email' => 'staff@mail.com', 'role' => 'staff'],
            ['name' => 'Customer',      'email' => 'customer@mail.com', 'role' => 'customer'],
        ];

        foreach ($accounts as $account) {
            User::query()->firstOrCreate(
                ['email' => $account['email']],
                $account + ['password' => bcrypt('password')]
            );
        }
    }
}
