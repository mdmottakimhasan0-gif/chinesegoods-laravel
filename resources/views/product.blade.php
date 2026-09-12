@extends('layouts.store')

@section('title', $product->name . ' – Chinese Goods BD')

@section('content')
<div class="container breadcrumb-wrap">
    <nav class="breadcrumb-nav">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">/</span>
        @if($product->categories->first())
            <a href="{{ route('category.show', $product->categories->first()) }}">{{ $product->categories->first()->name }}</a>
            <span class="sep">/</span>
        @endif
        <span class="current">{{ Str::limit($product->name, 40) }}</span>
    </nav>
</div>

<div class="container product-detail-container">
    <div class="product-detail-layout">
        <!-- Left: Product Media Gallery -->
        <div class="product-gallery-side">
            <div class="main-image-wrap">
                @if($product->discountPercent())
                    <span class="detail-sale-badge">-{{ $product->discountPercent() }}%</span>
                @endif
                <img src="{{ $product->image }}" alt="{{ $product->name }}" id="mainProductImg" class="main-detail-img">
            </div>
            <!-- Optional Thumbnails -->
            <div class="gallery-thumbs">
                <img src="{{ $product->image }}" alt="" class="thumb-active" onclick="document.getElementById('mainProductImg').src=this.src">
                <img src="https://picsum.photos/seed/{{ $product->slug }}1/600/600" alt="" onclick="document.getElementById('mainProductImg').src=this.src" onerror="this.style.display='none'">
                <img src="https://picsum.photos/seed/{{ $product->slug }}2/600/600" alt="" onclick="document.getElementById('mainProductImg').src=this.src" onerror="this.style.display='none'">
            </div>
        </div>

        <!-- Right: Product Information & Purchase Actions -->
        <div class="product-info-side">
            <div class="detail-cats">
                {{ $product->categories->pluck('name')->join(', ') }}
            </div>

            <h1 class="detail-title">{{ $product->name }}</h1>

            <div class="detail-rating-row">
                <span class="stars">★★★★★</span>
                <span class="rating-text">{{ $product->rating }} ({{ $product->reviews_count ?: 1 }} customer review)</span>
                <span class="stock-status in-stock">✓ ইন-স্টক (In Stock)</span>
            </div>

            <div class="detail-price-box">
                <span class="detail-curr-price">৳ {{ number_format($product->price, 0) }}</span>
                @if($product->compare_price && $product->compare_price > $product->price)
                    <del class="detail-old-price">৳ {{ number_format($product->compare_price, 0) }}</del>
                    <span class="detail-save-tag">সাশ্রয়: ৳ {{ number_format($product->compare_price - $product->price, 0) }}</span>
                @endif
            </div>

            <div class="detail-short-desc">
                <p>{{ $product->description }}</p>
            </div>

            <!-- Single Product Form -->
            <form method="post" action="{{ route('cart.buyNow', $product) }}" id="productPurchaseForm">
                @csrf
                
                @if($product->colors && count($product->colors) > 0)
                    <div class="detail-attribute-box">
                        <label class="attr-label">কালার / ভ্যারিয়েন্ট নির্বাচন করুন: <strong id="selectedColorName">{{ $product->colors[0] }}</strong></label>
                        <div class="color-options-wrap">
                            @foreach($product->colors as $index => $color)
                                <label class="color-radio-label">
                                    <input type="radio" name="color" value="{{ $color }}" {{ $index === 0 ? 'checked' : '' }} onchange="document.getElementById('selectedColorName').innerText = this.value">
                                    <span class="color-pill">{{ $color }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="detail-quantity-row">
                    <label class="attr-label">পরিমাণ (Quantity):</label>
                    <div class="qty-stepper">
                        <button type="button" class="qty-btn" onclick="stepQty(-1)">−</button>
                        <input type="number" name="qty" id="productQty" value="1" min="1" max="20">
                        <button type="button" class="qty-btn" onclick="stepQty(1)">+</button>
                    </div>
                </div>

                <!-- Dual Action Buttons -->
                <div class="detail-btn-row">
                    <!-- Buy Now / Order Now (Direct Checkout) -->
                    <button type="submit" class="btn-buy-now">
                        ⚡ অর্ডার করুন (Buy Now)
                    </button>

                    <!-- Add to Cart -->
                    <button type="submit" 
                            class="btn-add-cart" 
                            onclick="document.getElementById('productPurchaseForm').action='{{ route('cart.add', $product) }}'">
                        🛒 কার্টে যোগ করুন
                    </button>
                </div>
            </form>

            <!-- Helpline Box for Instant Phone Order -->
            <div class="quick-call-box">
                <div class="call-icon">📞</div>
                <div class="call-text">
                    <span>ফোনে সরাসরি অর্ডার করতে ডায়াল করুন:</span>
                    <a href="tel:+8801946225922"><strong>01946-225922</strong></a>
                    <small>সকাল ৯টা থেকে রাত ১১টা পর্যন্ত খোলা</small>
                </div>
                <a href="https://wa.me/8801946225922?text=I%20want%20to%20order%20{{ urlencode($product->name) }}" target="_blank" class="btn-wa-order">
                    WhatsApp অর্ডার
                </a>
            </div>

            <!-- Delivery & Assurance Highlights -->
            <div class="assurance-list">
                <div class="assure-item">
                    <span class="assure-icon">🚚</span>
                    <div>
                        <strong>ডেলিভারি চার্জ:</strong>
                        <span>ঢাকার ভিতরে ৳৭০ | ঢাকার বাইরে ৳১৩০</span>
                    </div>
                </div>
                <div class="assure-item">
                    <span class="assure-icon">💵</span>
                    <div>
                        <strong>ক্যাশ অন ডেলিভারি:</strong>
                        <span>পণ্য হাতে পেয়ে টাকা পরিশোধ করুন</span>
                    </div>
                </div>
                <div class="assure-item">
                    <span class="assure-icon">🛡️</span>
                    <div>
                        <strong>১০০% অরিজিনাল চায়না পণ্য:</strong>
                        <span>সরাসরি অথেনটিক কোয়ালিটি নিশ্চিত</span>
                    </div>
                </div>
                <div class="assure-item">
                    <span class="assure-icon">🔄</span>
                    <div>
                        <strong>৭ দিনের সহজ রিটার্ন:</strong>
                        <span>কোন সমস্যা থাকলে সহজ পরিবর্তন সুবিধা</span>
                    </div>
                </div>
            </div>

            <!-- Metadata Info -->
            <div class="detail-meta">
                <p><strong>SKU:</strong> {{ $product->sku ?: 'CG-'.str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p><strong>Categories:</strong> {{ $product->categories->pluck('name')->join(', ') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Related Products Section -->
@if(isset($related) && count($related) > 0)
<section class="home-section related-products-section">
    <div class="container">
        <div class="section-title-wrap">
            <div class="title-left">
                <h2 class="section-heading-text">সম্পর্কিত পণ্যসমূহ (Related Products)</h2>
                <span class="section-subtext">এই ক্যাটাগরির আরও অন্যান্য জনপ্রিয় পণ্য</span>
            </div>
        </div>
        <div class="products-carousel-grid">
            @foreach($related as $product)
                @include('partials.product-card')
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@section('scripts')
<script>
function stepQty(change) {
    var input = document.getElementById('productQty');
    var val = parseInt(input.value, 10) + change;
    if (val >= 1 && val <= 20) {
        input.value = val;
    }
}
</script>
@endsection
