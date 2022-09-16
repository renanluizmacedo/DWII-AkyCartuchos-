<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_types')->insert([
            'name' => 'CARTUCHO',
        ]);

        DB::table('item_types')->insert([
            'name' => 'IMPRESSORA',
        ]);

        for ($i = 1; $i <= 10; $i++) {
            DB::table('item_types')->insert([
                'name' => Str::random(10),
            ]);
        }
    }
}
