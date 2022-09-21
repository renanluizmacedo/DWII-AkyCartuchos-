<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;


use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($j = 1; $j <= 25; $j++) {
            DB::table('permissions')->insert([
                'resource_id' => $j,
                'role_id' => 1,
                'permissao' => 1,
            ]);
        }
        $perm = 0;

        for ($j = 1; $j <= 25; $j++) {
            if ($j >= 6 && $j < 21) {
                $perm = 1;
            } else {
                $perm = 0;
            }
            DB::table('permissions')->insert([

                'resource_id' => $j,
                'role_id' => 2,
                'permissao' => $perm,
            ]);
        }
        for ($j = 1; $j <= 25; $j++) {
            if ($j >= 6) {
                $perm = 1;
            } else {
                $perm = 0;
            }
            DB::table('permissions')->insert([

                'resource_id' => $j,
                'role_id' => 3,
                'permissao' => $perm,
            ]);
        }

        for ($j = 1; $j <= 25; $j++) {
            DB::table('permissions')->insert([

                'resource_id' => $j,
                'role_id' => 4,
                'permissao' => 1,
            ]);
        }
    }
}
