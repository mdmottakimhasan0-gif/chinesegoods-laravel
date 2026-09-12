<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('categories');

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', fn ($q) => $q->where('slug', $request->input('category')));
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug'],
            'price' => ['required', 'numeric', 'min:0'],
            'compare_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'sku' => ['nullable', 'string', 'max:100'],
            'image' => ['required', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'colors' => ['nullable', 'string'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
            'is_featured' => ['nullable', 'boolean'],
            'is_bestseller' => ['nullable', 'boolean'],
            'is_new' => ['nullable', 'boolean'],
        ]);

        $slug = ! empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['name']);
        // Ensure slug uniqueness
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$counter++;
        }

        $colorsArray = null;
        if (! empty($data['colors'])) {
            $colorsArray = array_values(array_filter(array_map('trim', explode(',', $data['colors']))));
        }

        $product = Product::create([
            'name' => $data['name'],
            'slug' => $slug,
            'price' => $data['price'],
            'compare_price' => $data['compare_price'] ?? null,
            'stock' => $data['stock'],
            'sku' => $data['sku'] ?? 'CG-'.strtoupper(Str::random(6)),
            'image' => $data['image'],
            'description' => $data['description'] ?? null,
            'colors' => $colorsArray,
            'is_featured' => $request->boolean('is_featured'),
            'is_bestseller' => $request->boolean('is_bestseller'),
            'is_new' => $request->boolean('is_new'),
            'rating' => 5.0,
            'reviews_count' => 1,
        ]);

        if (! empty($data['categories'])) {
            $product->categories()->sync($data['categories']);
        }

        return redirect()->route('admin.products.index')->with('success', 'নতুন প্রোডাক্ট সফলভাবে যুক্ত করা হয়েছে!');
    }

    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug,'.$product->id],
            'price' => ['required', 'numeric', 'min:0'],
            'compare_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'sku' => ['nullable', 'string', 'max:100'],
            'image' => ['required', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'colors' => ['nullable', 'string'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
            'is_featured' => ['nullable', 'boolean'],
            'is_bestseller' => ['nullable', 'boolean'],
            'is_new' => ['nullable', 'boolean'],
        ]);

        $slug = ! empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['name']);
        if ($slug !== $product->slug) {
            $originalSlug = $slug;
            $counter = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug.'-'.$counter++;
            }
        }

        $colorsArray = null;
        if (! empty($data['colors'])) {
            $colorsArray = array_values(array_filter(array_map('trim', explode(',', $data['colors']))));
        }

        $product->update([
            'name' => $data['name'],
            'slug' => $slug,
            'price' => $data['price'],
            'compare_price' => $data['compare_price'] ?? null,
            'stock' => $data['stock'],
            'sku' => $data['sku'] ?? $product->sku,
            'image' => $data['image'],
            'description' => $data['description'] ?? null,
            'colors' => $colorsArray,
            'is_featured' => $request->boolean('is_featured'),
            'is_bestseller' => $request->boolean('is_bestseller'),
            'is_new' => $request->boolean('is_new'),
        ]);

        if (isset($data['categories'])) {
            $product->categories()->sync($data['categories']);
        } else {
            $product->categories()->detach();
        }

        return redirect()->route('admin.products.index')->with('success', 'প্রোডাক্টের তথ্য সফলভাবে আপডেট হয়েছে!');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'প্রোডাক্ট ডিলিট করা হয়েছে!');
    }
}
