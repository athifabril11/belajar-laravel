<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);
        if (class_exists(SupplierSeeder::class)) {
            $this->call(SupplierSeeder::class);
        }
    }
}
