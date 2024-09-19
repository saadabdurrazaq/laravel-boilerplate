<?php

namespace Tests\Feature;

use App\Models\Master\Item;
use App\Models\Request\RequestOrder;
use App\Models\User;
use Database\Seeders\ItemSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertNotEmpty;

class RequestOrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_request_order(): void
    {
        $this->seed(ItemSeeder::class);
        $sampleItem = Item::find(1);
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->create_request_order($sampleItem);
        $route = route('index.request.order', [], false);
        $response = $this->getJson($route);
        $response->assertOk();
    }

    private function generate_faker_order_detail(Item $sampleItem) {
        return [
            $sampleItem->id => [
                'price' => fake()->randomElement([
                    100900,9000,70000,75000,null
                ]),
                'qty' => fake()->randomElement([
                    1,5,6,10,null
                ]),
                'need_qty' => fake()->randomElement([
                    1, null
                ]),
                'discount' => fake()->randomElement([
                    1,10,11,25,50,null
                ]),
                'amount' => fake()->randomElement([
                    100900,9000,70000,75000,null
                ]),
                'remark' => fake()->words(3, true)
            ]
        ];
    }

    private function create_request_order() {
        $route = route('post.request.order', [], false);
        $sampleItem = Item::find(1);
        $response = $this->postJson($route, [
            'request_date' => fake()
                ->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d'),
            'remark' => fake()->words(3, true),
            'items' => $this->generate_faker_order_detail($sampleItem)
        ]);
        return $response;
    }

    public function test_save_request_order(): void
    {
        $this->seed(ItemSeeder::class);
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->create_request_order();
        $response->assertCreated();
        $route = route('index.request.order', [], false);
        $response = $this->getJson($route);
        $response->assertOk();
    }

    public function test_filter_date_request_order(): void
    {
        $start = fake()->dateTimeBetween('-4 week', '-3 week')
            ->format('Y-m-d');
        $end = fake()->dateTimeBetween('+3 week', '+4 week')
            ->format('Y-m-d');
        $this->seed(ItemSeeder::class);
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->create_request_order();
        $ro_number = $response->json('data')['ro_number'];
        $response->assertCreated();
        $route = route('index.request.order', [], false);
        $route = "{$route}?start_date={$start}&end_date={$end}&ro_number={$ro_number}";
        $response = $this->getJson($route);
        $response->assertOk();
        $response->assertJsonFragment([
            'ro_number' => "{$ro_number}"
        ]);
    }

    public function test_edit_request_order(): void
    {
        $this->seed(ItemSeeder::class);
        $user = User::factory()->create();
        $sampleItem = Item::find(2);
        $sampleItem2 = Item::find(3);
        $this->actingAs($user);
        $response = $this->create_request_order()->json();
        $route = route('put.request.order', 
            ['model' => $response['data']['id']], false);
        $items = $this->generate_faker_order_detail($sampleItem);
        $items2 = $this->generate_faker_order_detail($sampleItem2);
        $response = $this->putJson($route, [
            'request_date' => fake()
                ->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d'),
            'remark' => fake()->words(3, true),
            'items' => [$sampleItem->id => $items[$sampleItem->id], $sampleItem2->id => $items2[$sampleItem2->id]]
        ]);
        $response->assertOk();
        $route = route('index.request.order', [], false);
        $response = $this->getJson($route);
        $response->assertOk();
    }

    public function test_show_request_order(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $request = RequestOrder::factory()->create();
        $route = route('show.request.order', 
            ['model' => $request->id], false);
        $response = $this->getJson($route);
        $response->assertOk();
    }

    public function test_soft_delete_request_order(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $request = RequestOrder::factory()->create();
        $route = route('delete.request.order', 
            ['model' => $request->id], false);
        $response = $this->deleteJson($route);
        $allTrashed = RequestOrder::onlyTrashed()->get();
        $all = RequestOrder::all();
        $response->assertOk();
        assertEmpty($all);
        assertNotEmpty($allTrashed);
    }
}
