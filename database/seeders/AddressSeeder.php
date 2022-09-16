<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'address' => 'RUA 19 DE DEZEMBRO',
            'number' => 2121,
            'neighborhood' => 'RIVIEIRA',
            'city' => 'MATINHOS',
            'zipcode' => 8326000,
        ]);

        DB::table('addresses')->insert([
            'address' => 'AVENIDA JUSCELINO KUBISTCHEK',
            'number' => 101,
            'neighborhood' => 'CENTRO',
            'city' => 'MATINHOS',
            'zipcode' => 8326000,
        ]);

        for ($i = 1; $i <= 10; $i++) {
            DB::table('addresses')->insert([
                'address' => Str::random(10),
                'number' => rand(1000, 9000),
                'neighborhood' => Str::random(10),
                'city' => Str::random(10),
                'zipcode' => rand(100000, 900000),
            ]);
        }
    }
}
