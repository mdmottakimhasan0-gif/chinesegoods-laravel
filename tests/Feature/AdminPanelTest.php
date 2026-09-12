<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_access_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));

        $regularUser = User::create([
            'name' => 'Regular Customer',
            'email' => 'customer@test.com',
            'password' => 'password',
            'is_admin' => false,
        ]);

        $response = $this->actingAs($regularUser)->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => 'password',
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Admin Dashboard');
        $response->assertSee('মোট বিক্রি');
    }

    public function test_admin_can_add_product(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => 'password',
            'is_admin' => true,
        ]);

        $category = Category::create([
            'name' => 'Smart Gadgets',
            'slug' => 'smart-gadgets',
            'icon' => '⚡',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.products.store'), [
            'name' => 'New Smart Watch Pro 2026',
            'price' => 1299,
            'compare_price' => 1999,
            'stock' => 25,
            'sku' => 'SW-2026',
            'image' => 'https://picsum.photos/400',
            'description' => 'A high quality smart watch.',
            'categories' => [$category->id],
            'is_featured' => true,
            'is_bestseller' => true,
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'name' => 'New Smart Watch Pro 2026',
            'price' => 1299,
            'compare_price' => 1999,
            'stock' => 25,
        ]);

        // Verify product shows on public home
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('New Smart Watch Pro 2026');
    }

    public function test_admin_can_update_order_status(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => 'password',
            'is_admin' => true,
        ]);

        $order = Order::create([
            'order_no' => 'CGTEST123',
            'name' => 'Rahim Chowdhury',
            'phone' => '01812345678',
            'address' => 'Chittagong GEC Circle',
            'city' => 'Chittagong',
            'payment_method' => 'cod',
            'status' => 'pending',
            'subtotal' => 1200,
            'shipping' => 130,
            'total' => 1330,
        ]);

        $response = $this->actingAs($admin)->post(route('admin.orders.status', $order), [
            'status' => 'shipped',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'shipped',
        ]);
    }

    public function test_admin_can_create_category(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => 'password',
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->post(route('admin.categories.store'), [
            'name' => 'Wireless Audio',
            'name_bn' => 'ওয়্যারলেস অডিও',
            'icon' => '🎧',
            'is_top' => true,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('categories', [
            'name' => 'Wireless Audio',
            'slug' => 'wireless-audio',
            'name_bn' => 'ওয়্যারলেস অডিও',
        ]);
    }
}
