<?php

namespace Database\Seeders;

use App\Models\Master\PermissionHasGroupName;
use Illuminate\Database\Seeder;

class PermissionHasGroupNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupName = [
            [
                "id" => 1,
                "name" => "Master Data",
            ],
            [
                "id" => 2,
                "name" => "Master Style",
            ],
            [
                "id" => 3,
                "name" => "Item",
            ],
            [
                "id" => 4,
                "name" => "Sales Order",
            ],
            [
                "id" => 5,
                "name" => "Purchase",
            ],
            [
                "id" => 6,
                "name" => "Inventory",
            ],
            [
                "id" => 7,
                "name" => "Production",
            ],
            [
                "id" => 8,
                "name" => "Shipping",
            ],
            [
                "id" => 9,
                "name" => "Sales Invoice",
            ],
            [
                "id" => 10,
                "name" => "Report",
            ],
            [
                "id" => 11,
                "name" => "Sales Adjustment",
            ],
            [
                "id" => 12,
                "name" => "Purchase Invoice",
            ],
            [
                "id" => 13,
                "name" => "Purchase Adjustment",
            ],
            [
                "id" => 14,
                "name" => "Master User",
            ],
            [
                "id" => 15,
                "name" => "Company Profile",
            ],
            [
                "id" => 16,
                "name" => "Role Permission",
            ],
            [
                "id" => 17,
                "name" => "Proforma",
            ],
        ];

        PermissionHasGroupName::insert($groupName);
    }
}
