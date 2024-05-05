<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
 
    public function run()
    {
        // // Dummy data 10
        // User::factory(10)->create();
        $this->call(UserTableSeeder::class);
        $this->call(DivisionTableSeeder::class);
 
        $this->command->info('User table seeded!');
        $this->command->info('Have a nice day, ravelinno !');
    }
 
}