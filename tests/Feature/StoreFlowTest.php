<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_brand_and_products(): void
    {
        $category = Category::create([
            'name' => 'Tools & Hardware',
            'name_bn' => 'টুলস ও হার্ডওয়্যার',
            'slug' => 'tools-hardware',
            'icon' => '🧰',
            'is_top' => true,
            'sort_order' => 1,
        ]);

        $product = Product::create([
            'name' => 'Multifunctional Full 420 SS 21 in one Wire Puller',
            'slug' => 'multifunctional-full-420-ss-wire-puller',
            'image' => 'https://picsum.photos/400',
            'price' => 669,
            'compare_price' => 1200,
            'stock' => 50,
            'is_featured' => true,
            'is_bestseller' => true,
            'description' => 'Electrician tool with 21 functions.',
        ]);

        $product->categories()->attach($category);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('CHINESE GOODS BD');
        $response->assertSee('Multifunctional Full 420 SS');
        $response->assertSee('669');
        $response->assertSee('টুলস ও হার্ডওয়্যার');
        $response->assertSee('01946-225922');
    }

    public function test_single_product_view_renders(): void
    {
        $product = Product::create([
            'name' => 'AI Smart Pen Translation Edition',
            'slug' => 'ai-smart-pen',
            'image' => 'https://picsum.photos/400',
            'price' => 6999,
            'compare_price' => 12000,
            'stock' => 10,
            'colors' => ['Black', 'Blue', 'White'],
            'description' => 'Scanning dictionary pen with global translation.',
        ]);

        $response = $this->get(route('product.show', $product));
        $response->assertStatus(200);
        $response->assertSee('AI Smart Pen Translation Edition');
        $response->assertSee('6,999');
        $response->assertSee('Black');
        $response->assertSee('অর্ডার করুন (Buy Now)');
    }

    public function test_checkout_placement_with_delivery_zones(): void
    {
        $product = Product::create([
            'name' => 'Transparent Wireless Mouse',
            'slug' => 'transparent-wireless-mouse',
            'image' => 'https://picsum.photos/400',
            'price' => 999,
            'stock' => 20,
        ]);

        // Add to cart via buy-now
        $response = $this->post(route('cart.buyNow', $product), ['qty' => 1]);
        $response->assertRedirect(route('checkout.index'));

        // Place order with outside dhaka delivery zone
        $orderResponse = $this->post(route('checkout.place'), [
            'name' => 'Mottakim Ahmed',
            'phone' => '01712345678',
            'address' => 'House 12, Road 4, Sector 7, Uttara, Dhaka',
            'city' => 'Dhaka',
            'delivery_zone' => 'inside_dhaka',
            'payment_method' => 'cod',
        ]);

        $orderResponse->assertRedirect();
        $this->assertDatabaseHas('orders', [
            'name' => 'Mottakim Ahmed',
            'phone' => '01712345678',
            'payment_method' => 'cod',
            'shipping' => 70,
            'total' => 1069,
        ]);
    }
}
