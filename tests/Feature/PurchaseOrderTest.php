<?php

namespace Tests\Feature;

use App\Models\Master\Item;
use App\Models\User;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\ItemSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchaseOrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_purchase_order(): void
    {
        $this->seed([
            ItemSeeder::class,
            CustomerSeeder::class
        ]);
        $sampleItem = Item::find(1);
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->create_purchase_order($sampleItem);
        $route = route('index.purchase.order', [], false);
        $response = $this->getJson($route);
        $response->assertOk();
    }

    private function create_purchase_order()
    {
        $route = route('store.purchase.order', [], false);

        $response = $this->postJson($route, [
            "id" => "",
            "purchase_order_number" => "PO/4123",
            "customer_id" => 193,
            "customer_name" => "BOGOR FOTO",
            "discount" => 0,
            "purchase_type_id" => 1,
            "purchase_order_date" => "2024-07-23",
            "shipping_date" => "2024-07-23",
            "status" => "Process",
            "shipping_destination" =>
            "Lenggerong, Jalan Raya, Lenggerong, Kec. Bantarbolang, Kabupaten Pemalang",
            "shipping_term_id" => 5,
            "term_of_payment" => 3,
            "currency_id" => 2,
            "exchange_rate" => 16212.294,
            "use_vat" => 0,
            "remark" => "Re",
            "pph23_id" => null,
            "item_ids" => [],
            "items_amount" => [],
            "qty_orders" => [],
            "unit_prices" => [],
            "need_qty" => [],
            "selectedItems" => [
                [
                    "id" => 1126,
                    "uid" => "MC44MTI3NTk2MDYyNzI0MTg5",
                    "item_code" => "311317",
                    "item_name" => "( 18 X 22)AMK TOPTRESSGANTI (16 X 22 )",
                    "buyer_po_number" => "-",
                    "item_id" => 1126,
                    "spesification" => "",
                    "unit" => "Piece",
                    "wh_qty" => 0,
                    "sales_order_number" => "-",
                    "style_code" => "-",
                    "style_name" => "-",
                    "need_qty" => 4,
                    "minimum_stock" => 4,
                    "stock" => 0,
                    "balance_qty" => -4,
                    "description" => "-",
                    "ro_number" => "-",
                    "qty_order" => 2,
                    "unit_price" => 3,
                    "amount" => 6,
                    "test" => "itemData",
                ],
            ],
            "summary" => [
                "total_amount" => "6.000",
                "total_discount" => "0.000",
                "total_pph23" => "0.000",
                "total_vat" => "0.000",
                "grand_total" => "6.000",
            ],
            "selected_type" => "ITEM",
        ]);

        return $response;
    }
}
