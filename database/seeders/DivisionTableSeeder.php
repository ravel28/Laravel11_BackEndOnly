<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $division = [
            ['division' => 'Manager'],
            ['division' => 'IT'],
            ['division' => 'Admin'],
        ];

        foreach ($division as $division) {
            Division::create($division);
        }
    }
}
