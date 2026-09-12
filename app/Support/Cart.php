<?php

namespace App\Support;

use App\Models\Product;

class Cart
{
    public static function items(): array
    {
        return session('cart', []);
    }

    public static function count(): int
    {
        return (int) collect(self::items())->sum('qty');
    }

    public static function subtotal(): float
    {
        return (float) collect(self::items())->sum(fn ($row) => $row['price'] * $row['qty']);
    }

    public static function add(Product $product, int $qty = 1, ?string $color = null): void
    {
        $cart = self::items();
        $key = $product->id.'|'.($color ?? '');

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $qty;
        } else {
            $cart[$key] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'image' => $product->image,
                'price' => (float) $product->price,
                'qty' => $qty,
                'color' => $color,
            ];
        }

        session(['cart' => $cart]);
    }

    public static function update(string $key, int $qty): void
    {
        $cart = self::items();
        if (! isset($cart[$key])) {
            return;
        }

        if ($qty < 1) {
            unset($cart[$key]);
        } else {
            $cart[$key]['qty'] = $qty;
        }

        session(['cart' => $cart]);
    }

    public static function remove(string $key): void
    {
        $cart = self::items();
        unset($cart[$key]);
        session(['cart' => $cart]);
    }

    public static function clear(): void
    {
        session()->forget('cart');
    }
}
