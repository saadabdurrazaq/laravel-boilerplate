<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // user
        // com prof
        // role permissin
        $permissions = [
            [
                'group_name' => 1,
                'permissions' => [
                    'MASTER_DATA_CREATE',
                    'MASTER_DATA_READ',
                    'MASTER_DATA_UPDATE',
                    'MASTER_DATA_DELETE',
                ]
            ],
            [
                'group_name' => 2,
                'permissions' => [
                    'MASTER_STYLE_CREATE',
                    'MASTER_STYLE_READ',
                    'MASTER_STYLE_UPDATE',
                    'MASTER_STYLE_DELETE',
                ]
            ],
            [
                'group_name' => 3,
                'permissions' => [
                    'ITEM_CREATE',
                    'ITEM_READ',
                    'ITEM_UPDATE',
                    'ITEM_DELETE',
                ]
            ],
            [
                'group_name' => 4,
                'permissions' => [
                    'ORDER_CREATE',
                    'ORDER_READ',
                    'ORDER_UPDATE',
                    'ORDER_DELETE',
                ]
            ],
            [
                'group_name' => 5,
                'permissions' => [
                    'PURCHASE_CREATE',
                    'PURCHASE_READ',
                    'PURCHASE_UPDATE',
                    'PURCHASE_DELETE',
                ]
            ],
            [
                'group_name' => 6,
                'permissions' => [
                    'INVENTORY_CREATE',
                    'INVENTORY_READ',
                    'INVENTORY_UPDATE',
                    'INVENTORY_DELETE',
                ]
            ],
            [
                'group_name' => 7,
                'permissions' => [
                    'PRODUCTION_CREATE',
                    'PRODUCTION_READ',
                    'PRODUCTION_UPDATE',
                    'PRODUCTION_DELETE',
                ]
            ],
            [
                'group_name' => 8,
                'permissions' => [
                    'SHIPPING_CREATE',
                    'SHIPPING_READ',
                    'SHIPPING_UPDATE',
                    'SHIPPING_DELETE'
                ]
            ],
            [
                'group_name' => 9,
                'permissions' => [
                    'SALES_INVOICE_CREATE',
                    'SALES_INVOICE_READ',
                    'SALES_INVOICE_UPDATE',
                    'SALES_INVOICE_DELETE',
                ]
            ],
            [
                'group_name' => 10,
                'permissions' => [
                    'REPORT_CREATE',
                    'REPORT_READ',
                    'REPORT_UPDATE',
                    'REPORT_DELETE',
                ]
            ],
            [
                'group_name' => 11,
                'permissions' => [
                    'SALES_ADJUSTMENT_CREATE',
                    'SALES_ADJUSTMENT_READ',
                    'SALES_ADJUSTMENT_UPDATE',
                    'SALES_ADJUSTMENT_DELETE',
                ]
            ],
            [
                'group_name' => 12,
                'permissions' => [
                    'PURCHASE_INVOICE_CREATE',
                    'PURCHASE_INVOICE_READ',
                    'PURCHASE_INVOICE_UPDATE',
                    'PURCHASE_INVOICE_DELETE',
                ]
            ],
            [
                'group_name' => 13,
                'permissions' => [
                    'PURCHASE_ADJUSTMENT_CREATE',
                    'PURCHASE_ADJUSTMENT_READ',
                    'PURCHASE_ADJUSTMENT_UPDATE',
                    'PURCHASE_ADJUSTMENT_DELETE',
                ]
            ],
            [
                'group_name' => 14,
                'permissions' => [
                    'MASTER_DATA_USER_CREATE',
                    'MASTER_DATA_USER_READ',
                    'MASTER_DATA_USER_UPDATE',
                    'MASTER_DATA_USER_DELETE',
                ]
            ],
            [
                'group_name' => 15,
                'permissions' => [
                    'MASTER_DATA_COMPANY_PROFILE_UPDATE',
                    'MASTER_DATA_COMPANY_PROFILE_READ',
                ]
            ],
            [
                'group_name' => 16,
                'permissions' => [
                    'MASTER_DATA_ROLE_PERMISSION_UPDATE',
                    'MASTER_DATA_ROLE_PERMISSION_READ',
                ]
            ],
            [
                'group_name' => 17,
                'permissions' => [
                    'PROFORMA_CREATE',
                    'PROFORMA_READ',
                    'PROFORMA_UPDATE',
                    'PROFORMA_DELETE',
                ]
            ],
        ];

        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'guard_name' => 'sanctum', 'group_name' => $permissionGroup]);
            }
        }

        // Create Default Roles
        $superAdmin         = Role::create(['name' => "SUPERADMIN", 'guard_name' => 'sanctum']);
        $manager              = Role::create(['name' => 'MANAGER', 'guard_name' => 'sanctum']);
        $marketing              = Role::create(['name' => 'MARKETING', 'guard_name' => 'sanctum']);
        $sales              = Role::create(['name' => 'SALES', 'guard_name' => 'sanctum']);
        $purchase              = Role::create(['name' => 'PURCHASE', 'guard_name' => 'sanctum']);
        $inventory              = Role::create(['name' => 'INVENTORY', 'guard_name' => 'sanctum']);
        $production              = Role::create(['name' => 'PRODUCTION', 'guard_name' => 'sanctum']);
        $exim              = Role::create(['name' => 'EXIM', 'guard_name' => 'sanctum']);
        $accounting              = Role::create(['name' => 'ACCOUNTING', 'guard_name' => 'sanctum']);
        $beacukai              = Role::create(['name' => 'BEACUKAI', 'guard_name' => 'sanctum']);

        // SUPERADMIN
        $superAdmin->givePermissionTo('MASTER_DATA_CREATE');
        $superAdmin->givePermissionTo('MASTER_DATA_READ');
        $superAdmin->givePermissionTo('MASTER_DATA_UPDATE');
        $superAdmin->givePermissionTo('MASTER_DATA_DELETE');
        $superAdmin->givePermissionTo('MASTER_STYLE_CREATE');
        $superAdmin->givePermissionTo('MASTER_STYLE_READ');
        $superAdmin->givePermissionTo('MASTER_STYLE_UPDATE');
        $superAdmin->givePermissionTo('MASTER_STYLE_DELETE');
        $superAdmin->givePermissionTo('ITEM_CREATE');
        $superAdmin->givePermissionTo('ITEM_READ');
        $superAdmin->givePermissionTo('ITEM_UPDATE');
        $superAdmin->givePermissionTo('ITEM_DELETE');
        $superAdmin->givePermissionTo('ORDER_CREATE');
        $superAdmin->givePermissionTo('ORDER_READ');
        $superAdmin->givePermissionTo('ORDER_UPDATE');
        $superAdmin->givePermissionTo('ORDER_DELETE');
        $superAdmin->givePermissionTo('PURCHASE_CREATE');
        $superAdmin->givePermissionTo('PURCHASE_READ');
        $superAdmin->givePermissionTo('PURCHASE_UPDATE');
        $superAdmin->givePermissionTo('PURCHASE_DELETE');
        $superAdmin->givePermissionTo('INVENTORY_CREATE');
        $superAdmin->givePermissionTo('INVENTORY_READ');
        $superAdmin->givePermissionTo('INVENTORY_UPDATE');
        $superAdmin->givePermissionTo('INVENTORY_DELETE');
        $superAdmin->givePermissionTo('PRODUCTION_CREATE');
        $superAdmin->givePermissionTo('PRODUCTION_READ');
        $superAdmin->givePermissionTo('PRODUCTION_UPDATE');
        $superAdmin->givePermissionTo('PRODUCTION_DELETE');
        $superAdmin->givePermissionTo('SHIPPING_CREATE');
        $superAdmin->givePermissionTo('SHIPPING_READ');
        $superAdmin->givePermissionTo('SHIPPING_UPDATE');
        $superAdmin->givePermissionTo('SHIPPING_DELETE');
        $superAdmin->givePermissionTo('SALES_INVOICE_CREATE');
        $superAdmin->givePermissionTo('SALES_INVOICE_READ');
        $superAdmin->givePermissionTo('SALES_INVOICE_UPDATE');
        $superAdmin->givePermissionTo('SALES_INVOICE_DELETE');
        $superAdmin->givePermissionTo('REPORT_CREATE');
        $superAdmin->givePermissionTo('REPORT_READ');
        $superAdmin->givePermissionTo('REPORT_UPDATE');
        $superAdmin->givePermissionTo('REPORT_DELETE');
        $superAdmin->givePermissionTo('SALES_ADJUSTMENT_CREATE');
        $superAdmin->givePermissionTo('SALES_ADJUSTMENT_READ');
        $superAdmin->givePermissionTo('SALES_ADJUSTMENT_UPDATE');
        $superAdmin->givePermissionTo('SALES_ADJUSTMENT_DELETE');
        $superAdmin->givePermissionTo('PURCHASE_INVOICE_CREATE');
        $superAdmin->givePermissionTo('PURCHASE_INVOICE_READ');
        $superAdmin->givePermissionTo('PURCHASE_INVOICE_UPDATE');
        $superAdmin->givePermissionTo('PURCHASE_INVOICE_DELETE');
        $superAdmin->givePermissionTo('PURCHASE_ADJUSTMENT_CREATE');
        $superAdmin->givePermissionTo('PURCHASE_ADJUSTMENT_READ');
        $superAdmin->givePermissionTo('PURCHASE_ADJUSTMENT_UPDATE');
        $superAdmin->givePermissionTo('PURCHASE_ADJUSTMENT_DELETE');
        $superAdmin->givePermissionTo('MASTER_DATA_USER_CREATE');
        $superAdmin->givePermissionTo('MASTER_DATA_USER_READ');
        $superAdmin->givePermissionTo('MASTER_DATA_USER_UPDATE');
        $superAdmin->givePermissionTo('MASTER_DATA_USER_DELETE');
        $superAdmin->givePermissionTo('MASTER_DATA_COMPANY_PROFILE_UPDATE');
        $superAdmin->givePermissionTo('MASTER_DATA_COMPANY_PROFILE_READ');
        $superAdmin->givePermissionTo('MASTER_DATA_ROLE_PERMISSION_UPDATE');
        $superAdmin->givePermissionTo('MASTER_DATA_ROLE_PERMISSION_READ');

        // MANAGER
        $manager->givePermissionTo('MASTER_DATA_CREATE');
        $manager->givePermissionTo('MASTER_DATA_READ');
        $manager->givePermissionTo('MASTER_DATA_UPDATE');
        $manager->givePermissionTo('MASTER_DATA_DELETE');
        $manager->givePermissionTo('MASTER_STYLE_CREATE');
        $manager->givePermissionTo('MASTER_STYLE_READ');
        $manager->givePermissionTo('MASTER_STYLE_UPDATE');
        $manager->givePermissionTo('MASTER_STYLE_DELETE');
        $manager->givePermissionTo('ITEM_CREATE');
        $manager->givePermissionTo('ITEM_READ');
        $manager->givePermissionTo('ITEM_UPDATE');
        $manager->givePermissionTo('ITEM_DELETE');
        $manager->givePermissionTo('ORDER_CREATE');
        $manager->givePermissionTo('ORDER_READ');
        $manager->givePermissionTo('ORDER_UPDATE');
        $manager->givePermissionTo('ORDER_DELETE');
        $manager->givePermissionTo('PURCHASE_CREATE');
        $manager->givePermissionTo('PURCHASE_READ');
        $manager->givePermissionTo('PURCHASE_UPDATE');
        $manager->givePermissionTo('PURCHASE_DELETE');
        $manager->givePermissionTo('INVENTORY_CREATE');
        $manager->givePermissionTo('INVENTORY_READ');
        $manager->givePermissionTo('INVENTORY_UPDATE');
        $manager->givePermissionTo('INVENTORY_DELETE');
        $manager->givePermissionTo('PRODUCTION_CREATE');
        $manager->givePermissionTo('PRODUCTION_READ');
        $manager->givePermissionTo('PRODUCTION_UPDATE');
        $manager->givePermissionTo('PRODUCTION_DELETE');
        $manager->givePermissionTo('SHIPPING_CREATE');
        $manager->givePermissionTo('SHIPPING_READ');
        $manager->givePermissionTo('SHIPPING_UPDATE');
        $manager->givePermissionTo('SHIPPING_DELETE');
        $manager->givePermissionTo('SALES_INVOICE_CREATE');
        $manager->givePermissionTo('SALES_INVOICE_READ');
        $manager->givePermissionTo('SALES_INVOICE_UPDATE');
        $manager->givePermissionTo('SALES_INVOICE_DELETE');
        $manager->givePermissionTo('REPORT_CREATE');
        $manager->givePermissionTo('REPORT_READ');
        $manager->givePermissionTo('REPORT_UPDATE');
        $manager->givePermissionTo('REPORT_DELETE');
        $manager->givePermissionTo('SALES_ADJUSTMENT_CREATE');
        $manager->givePermissionTo('SALES_ADJUSTMENT_READ');
        $manager->givePermissionTo('SALES_ADJUSTMENT_UPDATE');
        $manager->givePermissionTo('SALES_ADJUSTMENT_DELETE');
        $manager->givePermissionTo('PURCHASE_INVOICE_CREATE');
        $manager->givePermissionTo('PURCHASE_INVOICE_READ');
        $manager->givePermissionTo('PURCHASE_INVOICE_UPDATE');
        $manager->givePermissionTo('PURCHASE_INVOICE_DELETE');
        $manager->givePermissionTo('PURCHASE_ADJUSTMENT_CREATE');
        $manager->givePermissionTo('PURCHASE_ADJUSTMENT_READ');
        $manager->givePermissionTo('PURCHASE_ADJUSTMENT_UPDATE');
        $manager->givePermissionTo('PURCHASE_ADJUSTMENT_DELETE');

        // SALES
        $sales->givePermissionTo('SALES_INVOICE_CREATE');
        $sales->givePermissionTo('SALES_INVOICE_READ');
        $sales->givePermissionTo('SALES_INVOICE_UPDATE');
        $sales->givePermissionTo('SALES_INVOICE_DELETE');
        $sales->givePermissionTo('REPORT_CREATE');
        $sales->givePermissionTo('REPORT_READ');
        $sales->givePermissionTo('REPORT_UPDATE');
        $sales->givePermissionTo('REPORT_DELETE');
        $sales->givePermissionTo('SALES_ADJUSTMENT_CREATE');
        $sales->givePermissionTo('SALES_ADJUSTMENT_READ');
        $sales->givePermissionTo('SALES_ADJUSTMENT_UPDATE');
        $sales->givePermissionTo('SALES_ADJUSTMENT_DELETE');

        // PURCHASE
        $purchase->givePermissionTo('PURCHASE_CREATE');
        $purchase->givePermissionTo('PURCHASE_READ');
        $purchase->givePermissionTo('PURCHASE_UPDATE');
        $purchase->givePermissionTo('PURCHASE_DELETE');
        $purchase->givePermissionTo('REPORT_CREATE');
        $purchase->givePermissionTo('REPORT_READ');
        $purchase->givePermissionTo('REPORT_UPDATE');
        $purchase->givePermissionTo('REPORT_DELETE');
        $purchase->givePermissionTo('PURCHASE_INVOICE_CREATE');
        $purchase->givePermissionTo('PURCHASE_INVOICE_READ');
        $purchase->givePermissionTo('PURCHASE_INVOICE_UPDATE');
        $purchase->givePermissionTo('PURCHASE_INVOICE_DELETE');
        $purchase->givePermissionTo('PURCHASE_ADJUSTMENT_CREATE');
        $purchase->givePermissionTo('PURCHASE_ADJUSTMENT_READ');
        $purchase->givePermissionTo('PURCHASE_ADJUSTMENT_UPDATE');
        $purchase->givePermissionTo('PURCHASE_ADJUSTMENT_DELETE');

        // INVENTORY
        $inventory->givePermissionTo('INVENTORY_CREATE');
        $inventory->givePermissionTo('INVENTORY_READ');
        $inventory->givePermissionTo('INVENTORY_UPDATE');
        $inventory->givePermissionTo('INVENTORY_DELETE');
        $inventory->givePermissionTo('REPORT_CREATE');
        $inventory->givePermissionTo('REPORT_READ');
        $inventory->givePermissionTo('REPORT_UPDATE');
        $inventory->givePermissionTo('REPORT_DELETE');

        // PRODUCTION
        $production->givePermissionTo('PRODUCTION_CREATE');
        $production->givePermissionTo('PRODUCTION_READ');
        $production->givePermissionTo('PRODUCTION_UPDATE');
        $production->givePermissionTo('PRODUCTION_DELETE');
        $production->givePermissionTo('REPORT_CREATE');
        $production->givePermissionTo('REPORT_READ');
        $production->givePermissionTo('REPORT_UPDATE');
        $production->givePermissionTo('REPORT_DELETE');

        // EXIM
        $exim->givePermissionTo('SHIPPING_CREATE');
        $exim->givePermissionTo('SHIPPING_READ');
        $exim->givePermissionTo('SHIPPING_UPDATE');
        $exim->givePermissionTo('SHIPPING_DELETE');
        $exim->givePermissionTo('REPORT_CREATE');
        $exim->givePermissionTo('REPORT_READ');
        $exim->givePermissionTo('REPORT_UPDATE');
        $exim->givePermissionTo('REPORT_DELETE');

        // ACCOUNTING
        $accounting->givePermissionTo('SALES_INVOICE_CREATE');
        $accounting->givePermissionTo('SALES_INVOICE_READ');
        $accounting->givePermissionTo('SALES_INVOICE_UPDATE');
        $accounting->givePermissionTo('SALES_INVOICE_DELETE');
        $accounting->givePermissionTo('REPORT_CREATE');
        $accounting->givePermissionTo('REPORT_READ');
        $accounting->givePermissionTo('REPORT_UPDATE');
        $accounting->givePermissionTo('REPORT_DELETE');
        $accounting->givePermissionTo('SALES_ADJUSTMENT_CREATE');
        $accounting->givePermissionTo('SALES_ADJUSTMENT_READ');
        $accounting->givePermissionTo('SALES_ADJUSTMENT_UPDATE');
        $accounting->givePermissionTo('SALES_ADJUSTMENT_DELETE');
        $accounting->givePermissionTo('PURCHASE_INVOICE_CREATE');
        $accounting->givePermissionTo('PURCHASE_INVOICE_READ');
        $accounting->givePermissionTo('PURCHASE_INVOICE_UPDATE');
        $accounting->givePermissionTo('PURCHASE_INVOICE_DELETE');
        $accounting->givePermissionTo('PURCHASE_ADJUSTMENT_CREATE');
        $accounting->givePermissionTo('PURCHASE_ADJUSTMENT_READ');
        $accounting->givePermissionTo('PURCHASE_ADJUSTMENT_UPDATE');
        $accounting->givePermissionTo('PURCHASE_ADJUSTMENT_DELETE');

        // BEA CUKAI
        $beacukai->givePermissionTo('REPORT_CREATE');
        $beacukai->givePermissionTo('REPORT_READ');
        $beacukai->givePermissionTo('REPORT_UPDATE');
        $beacukai->givePermissionTo('REPORT_DELETE');
    }
}
