<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Master\Barcode;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->isProduction()) {
            $this->call([
                PermissionHasGroupNameSeeder::class,
                RolePermissionSeeder::class,
                UserSeeder::class
            ]);
        } else {
            $this->call([
                PermissionHasGroupNameSeeder::class,
                RolePermissionSeeder::class,
                UserSeeder::class
            ]);
        }
    }
}
