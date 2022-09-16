<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => 'RENAN LUIZ MACEDO DE SOUZA',
            'phone' => 41992192360,
            'email' => '',
            'address_id' => 1
        ]);


        DB::table('customers')->insert([
            'name' => 'KAUAN MACEDO DE SOUZA',
            'phone' => 4134531304,
            'email' => '',
            'address_id' => 2,
        ]);

        for ($i = 1; $i <= 10; $i++) {
            DB::table('customers')->insert([
                'name' => Str::random(10),
                'phone' => rand(1000000000, 9000000000),
                'email' => '',
                'address_id' => $i,
            ]);
        }
    }
}
