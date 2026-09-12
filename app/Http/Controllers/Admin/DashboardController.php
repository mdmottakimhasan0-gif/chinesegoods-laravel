<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalSales = (float) Order::where('status', '!=', 'cancelled')->sum('total');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalCustomers = User::where('is_admin', false)->count();

        $recentOrders = Order::with('items')->latest()->take(8)->get();
        $recentProducts = Product::with('categories')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'pendingOrders',
            'totalProducts',
            'totalCategories',
            'totalCustomers',
            'recentOrders',
            'recentProducts',
        ));
    }
}
