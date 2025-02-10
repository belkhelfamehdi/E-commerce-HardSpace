<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a user can place an order and generate a PDF invoice.
     */
    public function test_user_can_place_order_and_generate_invoice()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a product in the database
        $product = Product::factory()->create([
            'product_qty' => 10,
            'price' => 100,
        ]);

        // Add product to the cart (assuming a cart package is being used)
        \Cart::add($product->id, $product->name, 100, 1); // price 100, quantity 1

        $response = $this->post(route('order.store'));

        // Assert that the order has been created
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'price' => $product->price,
            'quantity' => 1,
        ]);

        // Assert that the product quantity has been decremented
        $product->refresh();
        $this->assertEquals(9, $product->product_qty);

        // Check if PDF was generated (you can mock the PDF generation here or test it manually)
        $response->assertHeader('Content-Type', 'application/pdf');

        // Check that the cart is cleared
        $this->assertEquals(0, \Cart::getContent()->count());
    }

    /**
     * Test if the user can view their orders.
     */
    public function test_user_can_view_their_orders()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create an order for the user
        $order = Order::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->get(route('order.show', $order));

        $response->assertStatus(200);
        $response->assertViewHas('orders');
    }
}

