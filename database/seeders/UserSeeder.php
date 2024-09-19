<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Password has been hashed in User model. So, don't need to be hashed anymore here

        $superadmin = User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
            'password' => 'admin',
            'is_active' => 1,
        ]);

        $manager = User::create([
            'username' => 'manager',
            'email' => 'manager@gmail.com',
            'name' => 'Angie Murti',
            'password' => 'manager1234',
            'is_active' => 1,
        ]);

        $marketing = User::create([
            'username' => 'marketing',
            'email' => 'marketing@gmail.com',
            'name' => 'Bendot',
            'password' => 'marketing1234',
            'is_active' => 1,
        ]);

        $sales = User::create([
            'username' => 'sales',
            'email' => 'sales@gmail.com',
            'name' => 'Sari Widyaningrum',
            'password' => 'sales1234',
            'is_active' => 1,
        ]);

        $purchase = User::create([
            'username' => 'purchase',
            'email' => 'purchase@gmail.com',
            'name' => 'Buluk',
            'password' => 'purchase1234',
            'is_active' => 1,
        ]);

        $inventory = User::create([
            'username' => 'inventory',
            'email' => 'inventory@gmail.com',
            'name' => 'Butet',
            'password' => 'inventory1234',
            'is_active' => 1,
        ]);

        $production = User::create([
            'username' => 'production',
            'email' => 'prod@gmail.com',
            'name' => 'Cupek',
            'password' => 'production1234',
            'is_active' => 1,
        ]);

        $exim = User::create([
            'username' => 'exim',
            'email' => 'exim@gmail.com',
            'name' => 'Putek',
            'password' => 'exim1234',
            'is_active' => 1,
        ]);

        $accounting = User::create([
            'username' => 'acc',
            'email' => 'acc@gmail.com',
            'name' => 'Annisa Rahmawati',
            'password' => 'acc1234',
            'is_active' => 1,
        ]);

        $beacukai = User::create([
            'username' => 'beacukai',
            'email' => 'beacukai@gmail.com',
            'name' => 'Bondet',
            'password' => 'beacukai1234',
            'is_active' => 1,
        ]);

        $superadminRole = Role::where('name', 'SUPERADMIN')->first();
        $managerRole = Role::where('name', 'MANAGER')->first();
        $marketingRole = Role::where('name', 'MARKETING')->first();
        $salesRole = Role::where('name', 'SALES')->first();
        $purchaseRole = Role::where('name', 'PURCHASE')->first();
        $inventoryRole = Role::where('name', 'INVENTORY')->first();
        $productionRole = Role::where('name', 'PRODUCTION')->first();
        $eximRole = Role::where('name', 'EXIM')->first();
        $accountingRole = Role::where('name', 'ACCOUNTING')->first();
        $beacukaiRole = Role::where('name', 'BEACUKAI')->first();

        $superadmin->assignRole($superadminRole->id);
        $manager->assignRole($managerRole->id);
        $marketing->assignRole($marketingRole->id);
        $sales->assignRole($salesRole->id);
        $purchase->assignRole($purchaseRole->id);
        $inventory->assignRole($inventoryRole->id);
        $production->assignRole($productionRole->id);
        $exim->assignRole($eximRole->id);
        $accounting->assignRole($accountingRole->id);
        $beacukai->assignRole($beacukaiRole->id);
    }
}
