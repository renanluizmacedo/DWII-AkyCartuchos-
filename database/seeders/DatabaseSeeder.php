<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AddressSeeder::class,
            CustomerSeeder::class,
            ItemTypeSeeder::class,
            ItemSeeder::class,
            RoleSeeder::class,
            ResourceSeeder::class,
            PermissionSeeder::class,
            EmployeeSeeder::class

        ]);

    }
}
