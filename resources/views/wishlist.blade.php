@extends('layouts.store')

@section('title', 'My Wishlist – Chinese Goods BD')

@section('content')
<div class="container breadcrumb-wrap">
    <nav class="breadcrumb-nav">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">/</span>
        <span class="current">My Wishlist</span>
    </nav>
</div>

<div class="container wishlist-page-container">
    <div class="page-header-title">
        <h1>পছন্দের তালিকা (My Wishlist)</h1>
        <p>আপনার পছন্দের সকল সংরক্ষিত পণ্য</p>
    </div>

    @if(count($products) > 0)
        <div class="products-carousel-grid">
            @foreach($products as $product)
                @include('partials.product-card')
            @endforeach
        </div>
    @else
        <div class="empty-cart-box">
            <div class="empty-icon">♡</div>
            <h2>আপনার পছন্দের তালিকা খালি!</h2>
            <p>পণ্য পছন্দ করতে পণ্যের উপর থাকা হার্ট (♡) আইকনে ক্লিক করুন।</p>
            <a href="{{ route('shop') }}" class="btn-continue-shop" style="margin-top:16px;">পণ্য খুঁজুন ➔</a>
        </div>
    @endif
</div>
@endsection
