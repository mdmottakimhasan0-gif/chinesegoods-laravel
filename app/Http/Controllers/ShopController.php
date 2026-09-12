<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('categories');

        if ($request->filled('q')) {
            $q = $request->string('q')->toString();
            $query->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                    ->orWhere('short_description', 'like', "%{$q}%");
            });
        }

        if ($request->string('filter') === 'new') {
            $query->where('is_new', true);
        } elseif ($request->string('filter') === 'best') {
            $query->where('is_bestseller', true);
        } elseif ($request->string('filter') === 'sale') {
            $query->whereNotNull('compare_price');
        }

        $sort = $request->string('sort')->toString();
        match ($sort) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            default => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();
        $title = 'Collection';

        if ($request->string('filter') === 'new') {
            $title = 'New Arrival';
        } elseif ($request->string('filter') === 'best') {
            $title = 'Best Selling';
        }

        return view('shop', [
            'products' => $products,
            'title' => $title,
            'category' => null,
        ]);
    }

    public function category(Category $category): View
    {
        $products = $category->products()->with('categories')->latest()->paginate(12);

        return view('shop', [
            'products' => $products,
            'title' => $category->name,
            'category' => $category,
        ]);
    }

    public function show(Product $product): View
    {
        $product->load('categories');
        $related = Product::with('categories')
            ->where('id', '!=', $product->id)
            ->whereHas('categories', function ($q) use ($product) {
                $q->whereIn('categories.id', $product->categories->pluck('id'));
            })
            ->take(4)
            ->get();

        return view('product', compact('product', 'related'));
    }
}
