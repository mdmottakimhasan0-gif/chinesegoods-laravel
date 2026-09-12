<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')->orderBy('sort_order')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'name_bn' => ['nullable', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:120', 'unique:categories,slug'],
            'icon' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer'],
            'is_top' => ['nullable', 'boolean'],
        ]);

        $slug = ! empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['name']);

        Category::create([
            'name' => $data['name'],
            'name_bn' => $data['name_bn'] ?? null,
            'slug' => $slug,
            'icon' => $data['icon'] ?? '🛍️',
            'image' => $data['image'] ?? 'https://picsum.photos/seed/'.$slug.'/240/240',
            'sort_order' => $data['sort_order'] ?? (Category::max('sort_order') + 1),
            'is_top' => $request->boolean('is_top'),
        ]);

        return back()->with('success', 'নতুন ক্যাটাগরি সফলভাবে যুক্ত করা হয়েছে!');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->products()->detach();
        $category->delete();

        return back()->with('success', 'ক্যাটাগরি মুছে ফেলা হয়েছে!');
    }
}
