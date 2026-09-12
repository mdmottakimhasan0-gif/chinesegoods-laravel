<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::orderBy('sort_order')->get();
        $saleProducts = Product::with('categories')->whereNotNull('compare_price')->latest()->take(10)->get();
        $bestSellers = Product::with('categories')->where('is_bestseller', true)->take(10)->get();
        $featured = Product::with('categories')->where('is_featured', true)->take(8)->get();
        $coins = Product::with('categories')
            ->whereHas('categories', fn ($q) => $q->where('slug', 'coin-hobby'))
            ->take(10)
            ->get();
        $topCategories = Category::where('is_top', true)->orderBy('sort_order')->get();
        $spotlight = Product::with('categories')->where('is_featured', true)->first();

        $recent = Product::latest()->take(3)->get();
        $onSale = Product::whereNotNull('compare_price')->take(3)->get();
        $topRated = Product::orderByDesc('rating')->take(3)->get();

        return view('home', compact(
            'categories',
            'saleProducts',
            'bestSellers',
            'featured',
            'coins',
            'topCategories',
            'spotlight',
            'recent',
            'onSale',
            'topRated',
        ));
    }
}
