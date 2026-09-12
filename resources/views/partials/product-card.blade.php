@php
    $inWish = in_array($product->id, session('wishlist', []), true);
@endphp
<article class="product-card">
    <div class="product-badge-wrap">
        @if($product->discountPercent())
            <span class="badge-sale">-{{ $product->discountPercent() }}%</span>
        @elseif($product->is_bestseller)
            <span class="badge-hot">HOT</span>
        @elseif($product->is_featured)
            <span class="badge-feat">BEST</span>
        @endif

        <form method="post" action="{{ route('wishlist.toggle', $product) }}" class="wish-form">
            @csrf
            <button class="wish-btn {{ $inWish ? 'active' : '' }}" type="submit" title="{{ $inWish ? 'Remove from wishlist' : 'Add to wishlist' }}">
                {{ $inWish ? '❤' : '♡' }}
            </button>
        </form>
    </div>

    <div class="product-thumb">
        <a href="{{ route('product.show', $product) }}" class="thumb-link">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy">
        </a>
    </div>

    <div class="product-info">
        <div class="product-cat-tag">
            {{ $product->categories->first()?->name ?? 'General' }}
        </div>
        
        <h3 class="product-title">
            <a href="{{ route('product.show', $product) }}" title="{{ $product->name }}">
                {{ $product->name }}
            </a>
        </h3>

        <div class="product-rating">
            <span class="stars">★★★★★</span>
            <small class="rating-num">({{ $product->reviews_count ?: 1 }})</small>
        </div>

        <div class="product-price-row">
            <span class="current-price">৳ {{ number_format($product->price, 0) }}</span>
            @if($product->compare_price && $product->compare_price > $product->price)
                <del class="old-price">৳ {{ number_format($product->compare_price, 0) }}</del>
            @endif
        </div>

        @if($product->colors && count($product->colors) > 0)
            <div class="product-color-dots">
                @foreach($product->colors as $color)
                    <span class="color-dot" title="{{ $color }}" style="background: {{ str_contains(strtolower($color), 'pink') ? '#f472b6' : (str_contains(strtolower($color), 'black') ? '#18181b' : (str_contains(strtolower($color), 'blue') ? '#3b82f6' : (str_contains(strtolower($color), 'green') ? '#10b981' : (str_contains(strtolower($color), 'red') ? '#ef4444' : (str_contains(strtolower($color), 'white') ? '#ffffff; border:1px solid #ccc' : '#ce75c4'))))) }}"></span>
                @endforeach
            </div>
        @endif

        <div class="product-card-btns">
            @if($product->hasOptions())
                <a href="{{ route('product.show', $product) }}" class="btn-order-now">অর্ডার করুন</a>
                <a href="{{ route('product.show', $product) }}" class="btn-cart-icon" title="View Options">🛒</a>
            @else
                <form method="post" action="{{ route('cart.buyNow', $product) }}" style="flex:1;">
                    @csrf
                    <button type="submit" class="btn-order-now">অর্ডার করুন</button>
                </form>
                <form method="post" action="{{ route('cart.add', $product) }}">
                    @csrf
                    <button type="submit" class="btn-cart-icon" title="Add to Cart">🛒</button>
                </form>
            @endif
        </div>
    </div>
</article>
