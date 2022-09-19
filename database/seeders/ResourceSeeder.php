<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr_perm = [
            'employees' => [0, 0, 0, 0, 0],
            'customers' => [1, 1, 1, 1, 1],
            'addresses' => [1, 1, 1, 1, 1],
            'items' => [1, 1, 1, 1, 1],
            'receipts' => [1, 1, 1, 1, 1],
        ];
        $arr_cat = ['employees', 'customers', 'addresses', 'items', 'receipts'];
        $arr_pag = ['index', 'create', 'destroy', 'edit', 'show'];

        foreach ($arr_cat as $cat) {
            foreach ($arr_pag as $pag) {
                DB::table('resources')->insert([
                    'name' => $cat . '.' . $pag,
                ]);
            }
        }
    }
}
