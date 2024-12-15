<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\StaffProvince;

class UserHeadStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ["id" => "11", "name" => "ACEH"],
            ["id" => "12", "name" => "SUMUT"],
            ["id" => "13", "name" => "SUMBAR"],
            ["id" => "14", "name" => "RIAU"],
            ["id" => "15", "name" => "JAMBI"],
            ["id" => "16", "name" => "SUMSEL"],
            ["id" => "17", "name" => "BENGKULU"],
            ["id" => "18", "name" => "LAMPUNG"],
            ["id" => "19", "name" => "BANGKA BELITUNG"],
            ["id" => "21", "name" => "KEPULAUAN RIAU"],
            ["id" => "31", "name" => "JAKARTA"],
            ["id" => "32", "name" => "JABAR"],
            ["id" => "33", "name" => "JATENG"],
            ["id" => "34", "name" => "YOGYAKARTA"],
            ["id" => "35", "name" => "JATIM"],
            ["id" => "36", "name" => "BANTEN"],
            ["id" => "51", "name" => "BALI"],
            ["id" => "52", "name" => "NTB"],
            ["id" => "53", "name" => "NTT"],
            ["id" => "61", "name" => "KALBAR"],
            ["id" => "62", "name" => "KALTENG"],
            ["id" => "63", "name" => "KALSEL"],
            ["id" => "64", "name" => "KALTIM"],
            ["id" => "65", "name" => "KALUT"],
            ["id" => "71", "name" => "SULAWESI UTARA"],
            ["id" => "72", "name" => "SULAWESI TENGAH"],
            ["id" => "73", "name" => "SULAWESI SELATAN"],
            ["id" => "74", "name" => "SULAWESI TENGGARA"],
            ["id" => "75", "name" => "GORONTALO"],
            ["id" => "76", "name" => "SULAWESI BARAT"],
            ["id" => "81", "name" => "MALUKU"],
            ["id" => "82", "name" => "MALUKU UTARA"],
            ["id" => "91", "name" => "PAPUA BARAT"],
            ["id" => "94", "name" => "PAPUA"],
        ];

        foreach ($regions as $region) {
            User::create([
                'email' => 'head_staff.' . strtolower(str_replace(' ', '_', $region['name'])) . '@tes',
                'password' => bcrypt(strtolower(str_replace(' ', '_', $region['name']))),
                'role' => 'head_staff',
            ]);
        }

        foreach ($regions as $index => $region) {
            StaffProvince::create([
            'user_id' => $index + 2,
            'province' => $region['id'],
            ]);
        }
    }
}
