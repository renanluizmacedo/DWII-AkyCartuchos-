<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'name' => 'HP 664 PRETO',
            'serial_number' => 1234567890,
            'price' => 75,
            'item_type_id' => 1,
        ]);

        DB::table('items')->insert([
            'name' => 'HP 664 COLORIDO',
            'serial_number' => 9876543210,
            'price' => 70,
            'item_type_id' => 1,
        ]);

        DB::table('items')->insert([
            'name' => 'HP DESKJET 2776',
            'serial_number' => 5674893021,
            'price' => 580,
            'item_type_id' => 2,
        ]);

        DB::table('items')->insert([
            'name' => 'HP LASERJET PRO MFP M125A',
            'serial_number' => 8950638221,
            'price' => 1890,
            'item_type_id' => 2,
        ]);

        for ($i = 1; $i <= 10; $i++) {
            DB::table('items')->insert([
                'name' => Str::random(10),
                'serial_number' => rand(1000, 9000),
                'item_type_id' => $i,
                'price' => rand(100, 2000),
            ]);
        }
    }
}
