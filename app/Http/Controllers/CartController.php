<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        return view('cart', [
            'items' => Cart::items(),
            'subtotal' => Cart::subtotal(),
        ]);
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'qty' => ['nullable', 'integer', 'min:1', 'max:20'],
            'color' => ['nullable', 'string', 'max:50'],
        ]);

        Cart::add($product, (int) ($data['qty'] ?? 1), $data['color'] ?? null);

        return back()->with('success', 'Product added to cart.');
    }

    public function buyNow(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'qty' => ['nullable', 'integer', 'min:1', 'max:20'],
            'color' => ['nullable', 'string', 'max:50'],
        ]);

        Cart::add($product, (int) ($data['qty'] ?? 1), $data['color'] ?? null);

        return redirect()->route('checkout.index');
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'key' => ['required', 'string'],
            'qty' => ['required', 'integer', 'min:0', 'max:20'],
        ]);

        Cart::update($data['key'], (int) $data['qty']);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'key' => ['required', 'string'],
        ]);

        Cart::remove($data['key']);

        return back()->with('success', 'Item removed.');
    }
}
