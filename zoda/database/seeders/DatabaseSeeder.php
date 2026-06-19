<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()
            ->count(3) // Match this to the number of arrays in sequence()
            ->sequence(
                [
                    'name' => 'Admin User',
                    'email' => 'admin@gmail.com',
                    'role' => 'admin',
                    'password' => bcrypt('Martsoft@2131'),
                    'gender' => 'Male',
                ],
                [
                    'name' => 'Michael Smith',
                    'email' => 'advertiser@gmail.com',
                    'role' => 'advertiser',
                    'password' => bcrypt('Martsoft@2131'),
                    'gender' => 'Male',
                ],
               
            )
            ->create([
                // You can still put SHARED attributes here to avoid repeating them
                'country' => 'GH',
                'age_group' => '18-25',
            ]);

         $this->call([
        CountriesTableSeeder::class,
        ]);

    }

    
}
