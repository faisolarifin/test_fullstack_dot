<?php

namespace Database\Seeders;

use App\Models\Pekerjaan;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KK extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        for($i=0; $i < 30; $i++) {
            Pekerjaan::create([
               'nm_pekerjaan' => $faker->jobTitle(),
            ]);
            \App\Models\KK::create([
                'no_kk' => rand(11111111111,99999999999),
                'nm_kepala' => $faker->name(),
                'alamat' => $faker->streetAddress(),
                'kabupaten' => $faker->city(),
                'provinsi' => "Jawa Timur",
                'kodepos' => $faker->postcode(),
            ]);
        }
    }
}
