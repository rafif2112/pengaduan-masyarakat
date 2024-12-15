<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\StaffProvince;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'email' => 'guest@tes',
            'password' => bcrypt('guest'),
            'role' => 'guest',
        ]);

        $this->call(UserHeadStaffSeeder::class);
    }
}
