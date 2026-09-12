<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function index(): View
    {
        $ids = session('wishlist', []);
        $products = Product::with('categories')->whereIn('id', $ids)->get();

        return view('wishlist', compact('products'));
    }

    public function toggle(Product $product): RedirectResponse
    {
        $ids = session('wishlist', []);
        if (in_array($product->id, $ids, true)) {
            $ids = array_values(array_filter($ids, fn ($id) => (int) $id !== (int) $product->id));
            $message = 'Removed from wishlist.';
        } else {
            $ids[] = $product->id;
            $message = 'Added to wishlist.';
        }

        session(['wishlist' => $ids]);

        return back()->with('success', $message);
    }
}
