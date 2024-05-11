<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Reza', 
                'motto' => 'Semua pasti ada waktunya', 
                'age' => 26, 
                'email' => 'rezaravelinno@yahoo.com',
                'email_verified_at' => now(),
                'password' => Hash::make('1sampai9coba'),

            ],
            [
                'name' => 'Ravel', 
                'motto' => 'Teruslah berenang', 
                'age' => 26, 
                'email' => 'ravelinno9@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('1sampai9coba'),
            ],
            [
                'name' => 'Linno', 
                'motto' => 'Its show time', 
                'age' => 26, 
                'email' => 'rrezaravelinno9@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('1sampai9coba'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
