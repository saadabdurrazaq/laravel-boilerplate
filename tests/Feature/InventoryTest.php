<?php

namespace Tests\Feature;

use App\Models\Inventory\InventoryDetail;
use App\Models\Inventory\InventoryIn;
use App\Models\Master\Item;
use App\Models\Master\Unit;
use App\Models\User;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\IOTypeSeeder;
use Database\Seeders\ItemSeeder;
use Database\Seeders\MasterStyleSeeder;
use Database\Seeders\PPH23sSeeder;
use Database\Seeders\UnitSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class InventoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function runCommonSeeder()
    {
        $this->seed([
            ItemSeeder::class,
            CustomerSeeder::class,
            UnitSeeder::class,
            WarehouseSeeder::class,
            MasterStyleSeeder::class,
            CurrencySeeder::class,
            PPH23sSeeder::class,
            IOTypeSeeder::class
        ]);
    }

    public function test_index_inventory_in(): void
    {
        $this->runCommonSeeder();
        $user = User::factory()->create();
        $this->createPermission(user: $user);
        $this->actingAs($user);

        $payload = $this->create_inventory_payload();
        $route = route('store.inventory', [], false);
        $response = $this->postJson($route, $payload);

        $route = route('get.inventory', [], false);
        $response = $this->getJson($route, $payload);
        $response->assertOk();
    }

    public function test_show_single_inventory_in(): void
    {
        $this->runCommonSeeder();
        $user = User::factory()->create();
        $this->createPermission(user: $user);
        $this->actingAs($user);

        $payload = $this->create_inventory_payload();
        $route = route('store.inventory', [], false);
        $response = $this->postJson($route, $payload)->json();

        $route = route('show.inventory', ['id' => 1], false);
        $response = $this->getJson($route, $payload);
        $response->assertOk();
    }

    public function test_store_inventory(): void
    {
        $this->seed([
            ItemSeeder::class
        ]);

        $user = User::factory()->create();
        $this->createPermission(user: $user);
        $this->actingAs($user);
        $payload = $this->create_inventory_payload();
        $route = route('store.inventory', [], false);
        $response = $this->postJson($route, $payload);
        $response->assertOk();
    }

    public function test_summary_in(): void
    {
        $this->runCommonSeeder();
        $user = User::factory()->create();
        $this->createPermission(user: $user);
        $this->actingAs($user);
        $payload = $this->create_inventory_payload();
        $route = route('store.inventory', [], false);
        $response = $this->postJson($route, $payload);
        $payload = $this->create_inventory_payload();
        $route = route('store.inventory', [], false);
        $response = $this->postJson($route, $payload);
        $route = route('get.card.summary', [], false);
        $response = $this->getJson($route);
        dump($response);
        $response->assertOk();
    }

    public function test_summary_out(): void
    {
        $this->runCommonSeeder();
        $user = User::factory()->create();
        $this->createPermission(user: $user);
        $this->actingAs($user);
        $payload = $this->create_inventory_payload();
        $route = route('store.inventory', [], false);
        $response = $this->postJson($route, $payload);
        $payload = $this->create_inventory_payload();
        $route = route('store.inventory', [], false);
        $response = $this->postJson($route, $payload);
        $route = route('get.card.summary', [], false);
        $response = $this->getJson($route);
        dump($response);
        $response->assertOk();
    }

    public function test_generate_inventory_number(): void
    {
        $user = User::factory()->create();
        $this->createPermission(user: $user);
        $this->actingAs($user);
        $route = route('get.inv-number.inventory', [], false);
        $response = $this->getJson($route);
        $response->assertOk();
    }

    public function test_generate_do_number(): void
    {
        $user = User::factory()->create();
        $this->createPermission(user: $user);
        $this->actingAs($user);
        $route = route('get.do-number.inventory', [], false);
        $response = $this->getJson($route);
        $response->assertOk();
    }

    public function test_update_inventory(): void
    {
        $this->seed([
            ItemSeeder::class
        ]);

        $user = User::factory()->create();
        $this->createPermission(user: $user);
        $this->actingAs($user);
        $payload = $this->create_inventory_payload();
        $route = route('store.inventory', [], false);
        $response = $this->postJson($route, $payload)
            ->json();
        // update
        $sampleItem = Item::find(2);
        $itemData = $this->create_inventory_data_item(
            item: $sampleItem
        );
        $payload['inventory_detail'] = [$itemData];
        $route = route('put.inventory', [
            'id' => $response['data']['id']
        ], false);
        $response = $this->putJson($route, $payload);
        $response->assertOk();
    }

    public function test_delete_inventory(): void
    {
        $this->seed([
            ItemSeeder::class
        ]);

        $user = User::factory()->create();
        $this->createPermission(user: $user);
        $this->actingAs($user);
        $payload = $this->create_inventory_payload();
        $route = route('store.inventory', [], false);
        $response = $this->postJson($route, $payload)
            ->json();
        // delete
        $route = route('delete.inventory', [
            'id' => $response['data']['id']
        ], false);
        $response = $this->deleteJson($route, $payload);
        $response->assertOk();
        $response = $response->json();
        $data = InventoryDetail::all();
        $this->assertDatabaseMissing(InventoryIn::class, [
            'id' => $response['data']['id'],
            'deleted_at' => null
        ]);
        $this->assertDatabaseMissing(InventoryDetail::class, [
            'inv_id' => $response['data']['id']
        ]);
    }

    private function create_inventory_payload(): array
    {
        $sampleItem = Item::find(1);
        $itemData1 = $this->create_inventory_data_item(
            item: $sampleItem
        );
        $itemData2 = $this->create_inventory_data_item(
            item: $sampleItem
        );
        return [
            "customer_id" => 1,
            "io_type_id" => fake()->randomElement([1, 2]),
            "ingoing_date" => "2024-01-24",
            "warehouse_id" => 1,
            "do_number" => "DO001",
            "do_date" => "2024-01-24",
            "invoice_number" => "INV001",
            "invoice_date" => "2024-01-24",
            "currency_id" => fake()->randomElement([1, 2]),
            "exchange_rate" => 15000.25,
            "pph23_id" => 1,
            "use_vat" => "YES",
            "doc_type" => "DOC1",
            "doc_number" => 1,
            "doc_date" => "2024-01-24",
            "aju_number" => "AJU001",
            "inventory_detail" => [
                $itemData1,
                $itemData2
            ]
        ];
    }

    private function create_inventory_data_item(Item $item): array
    {
        return [
            "inv_id" => 1,
            "item_id" => $item->id,
            "unit_id" => 1,
            "reference" => 'INVTEST',
            "reference_id" => 1,
            "reference_type" => fake()->randomElement([
                'PO', 'WIP', 'MASTER', 'CEISA'
            ]),
            "amount" => fake()->randomElement([
                100900, 9000, 70000, 75000
            ]),
            "style_id" => 1,
            "price" => fake()->randomElement([
                100900, 9000, 70000, 75000
            ]),
            'qty' => fake()->randomElement([
                1, 5, 6, 10
            ]),
            'remark' => fake()->words(3, true)
        ];
    }

    private function createPermission(User $user)
    {
        Permission::create([
            'name' => 'INVENTORY_CREATE',
            'guard_name' => 'sanctum'
        ]);
        Permission::create([
            'name' =>
            'INVENTORY_READ',
            'guard_name' => 'sanctum'
        ]);
        Permission::create([
            'name' => 'INVENTORY_UPDATE',
            'guard_name' => 'sanctum'
        ]);
        Permission::create([
            'name' => 'INVENTORY_DELETE',
            'guard_name' => 'sanctum'
        ]);
        $user->givePermissionTo('INVENTORY_CREATE');
        $user->givePermissionTo('INVENTORY_READ');
        $user->givePermissionTo('INVENTORY_UPDATE');
        $user->givePermissionTo('INVENTORY_DELETE');
    }
}
