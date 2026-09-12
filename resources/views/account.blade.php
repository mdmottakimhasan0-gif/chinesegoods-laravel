@extends('layouts.store')

@section('title', 'My Account')

@section('content')
<div class="page-title">
    <h1>My Account</h1>
    <form method="post" action="{{ route('logout') }}">@csrf<button class="btn outline" type="submit">Logout</button></form>
</div>
<h3>Orders</h3>
@forelse($orders as $order)
    <div class="cart-summary" style="margin-bottom:12px;">
        <strong>{{ $order->order_no }}</strong> — {{ $order->status }} — ৳ {{ number_format($order->total, 2) }}
        <div>{{ $order->created_at->format('d M Y') }}</div>
    </div>
@empty
    <p>No orders yet.</p>
@endforelse
@endsection
