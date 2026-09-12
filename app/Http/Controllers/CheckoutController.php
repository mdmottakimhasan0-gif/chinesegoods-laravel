<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Support\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (Cart::count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout', [
            'items' => Cart::items(),
            'subtotal' => Cart::subtotal(),
            'shipping' => 80,
            'total' => Cart::subtotal() + 80,
        ]);
    }

    public function place(Request $request): RedirectResponse
    {
        if (Cart::count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:80'],
            'delivery_zone' => ['nullable', 'in:inside_dhaka,outside_dhaka'],
            'notes' => ['nullable', 'string', 'max:500'],
            'payment_method' => ['required', 'in:cod,bkash,nagad,rocket'],
        ]);

        $order = DB::transaction(function () use ($data, $request) {
            $subtotal = Cart::subtotal();
            $shipping = ($data['delivery_zone'] ?? 'inside_dhaka') === 'outside_dhaka' ? 130 : 70;
            $order = Order::create([
                'order_no' => 'CG'.now()->format('ymdHis').random_int(10, 99),
                'user_id' => $request->user()?->id,
                'name' => $data['name'],
                'email' => $data['email'] ?? $request->user()?->email,
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'] ?? 'Rangpur',
                'payment_method' => $data['payment_method'],
                'status' => 'pending',
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $subtotal + $shipping,
                'notes' => $data['notes'] ?? null,
            ]);

            foreach (Cart::items() as $row) {
                $order->items()->create([
                    'product_id' => $row['product_id'],
                    'product_name' => $row['name'],
                    'price' => $row['price'],
                    'qty' => $row['qty'],
                    'color' => $row['color'] ?? null,
                ]);

                Product::where('id', $row['product_id'])->decrement('stock', $row['qty']);
            }

            return $order;
        });

        Cart::clear();

        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order): View
    {
        $order->load('items');

        return view('order-success', compact('order'));
    }
}
