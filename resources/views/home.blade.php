@extends('layouts.store')

@section('title', 'Chinese Goods BD – All items are in one place')

@section('content')
<!-- Hero Section with Slider & Side Banners -->
<section class="hero-section">
    <div class="container hero-grid">
        <!-- Main Interactive Carousel Slider -->
        <div class="hero-slider-wrapper">
            <div class="hero-slider" id="heroSlider">
                <div class="slide active">
                    <img src="https://chinesegoodsbd.com/wp-content/uploads/2025/12/3-1.jpg" 
                         onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1200&q=80';" 
                         alt="Chinese Goods BD Special Promotion">
                    <div class="slide-overlay">
                        <span class="slide-tag">স্পেশাল অফার</span>
                        <h2>প্রিমিয়াম কোয়ালিটি চায়না পণ্য</h2>
                        <p>সরাসরি চায়না থেকে আমদানিকৃত সেরা গ্যাজেট ও লাইফস্টাইল কালেকশন</p>
                        <a href="{{ route('shop') }}" class="btn-hero">শপ করুন এখনই ➔</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="https://chinesegoodsbd.com/wp-content/uploads/2025/12/4-1.png" 
                         onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=1200&q=80';" 
                         alt="Top Trending Gadgets">
                    <div class="slide-overlay">
                        <span class="slide-tag">নতুন কালেকশন</span>
                        <h2>স্মার্ট গ্যাজেটস & ইলেকট্রনিক্স</h2>
                        <p>আপনার দৈনন্দিন জীবনের সকল আকর্ষণীয় চায়না গ্যাজেট এক ছাদের নিচে</p>
                        <a href="{{ route('shop', ['filter' => 'new']) }}" class="btn-hero">নতুন আইটেম দেখুন ➔</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="https://chinesegoodsbd.com/wp-content/uploads/2025/12/1-1.jpg" 
                         onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1511556532299-8f662fc26c06?w=1200&q=80';" 
                         alt="Best Selling Items">
                    <div class="slide-overlay">
                        <span class="slide-tag">হট ডিলস</span>
                        <h2>বেস্ট সেলিং কালেকশন</h2>
                        <p>অবিশ্বাস্য মূল্যে আকর্ষণীয় গিফট, শো-পিস এবং ইউনিক কালেকশন</p>
                        <a href="{{ route('shop', ['filter' => 'best']) }}" class="btn-hero">অফার দেখুন ➔</a>
                    </div>
                </div>
            </div>
            <!-- Slider Controls -->
            <button class="slider-btn prev" onclick="changeSlide(-1)" aria-label="Previous Slide">❮</button>
            <button class="slider-btn next" onclick="changeSlide(1)" aria-label="Next Slide">❯</button>
            <div class="slider-dots" id="sliderDots">
                <span class="dot active" onclick="goToSlide(0)"></span>
                <span class="dot" onclick="goToSlide(1)"></span>
                <span class="dot" onclick="goToSlide(2)"></span>
            </div>
        </div>

        <!-- Side Banners -->
        <div class="hero-side-banners">
            <a href="{{ route('shop', ['filter' => 'new']) }}" class="side-banner-card side-top">
                <div class="side-banner-content">
                    <span class="mini-tag">নতুন কালেকশন</span>
                    <h3>স্মার্ট ক্যালকুলেটর</h3>
                    <p>এক ক্লিকে হিসাব করুন</p>
                    <span class="btn-side-action">অর্ডার করুন ➔</span>
                </div>
            </a>
            <a href="{{ route('category.show', 'coin-hobby') }}" class="side-banner-card side-bottom">
                <div class="side-banner-content">
                    <span class="mini-tag">হবি & কালেকশন</span>
                    <h3>এন্টিক কয়েন সেট</h3>
                    <p>রেয়ার ঐতিহাসিক কয়েন</p>
                    <span class="btn-side-action">কালেকশন দেখুন ➔</span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Trust / Feature Badges Bar -->
<section class="trust-bar-section">
    <div class="container trust-grid">
        <div class="trust-box">
            <div class="trust-icon">🚚</div>
            <div class="trust-info">
                <h4>সারা দেশে হোম ডেলিভারি</h4>
                <p>ক্যাশ অন ডেলিভারি সুবিধা সহ</p>
            </div>
        </div>
        <div class="trust-box">
            <div class="trust-icon">🛡️</div>
            <div class="trust-info">
                <h4>১০০% অরিজিনাল পণ্য</h4>
                <p>সরাসরি চায়না থেকে আমদানিকৃত</p>
            </div>
        </div>
        <div class="trust-box">
            <div class="trust-icon">📞</div>
            <div class="trust-info">
                <h4>কাস্টমার সাপোর্ট</h4>
                <p>কল করুন: 01946-225922</p>
            </div>
        </div>
        <div class="trust-box">
            <div class="trust-icon">🔄</div>
            <div class="trust-info">
                <h4>৭ দিনের রিপ্লেসমেন্ট</h4>
                <p>পণ্য চেক করে নেওয়ার সুবিধা</p>
            </div>
        </div>
    </div>
</section>

<!-- 12 Categories Circular Grid (ক্যটাগরি সমুহ) -->
<section class="home-section category-showcase-section">
    <div class="container">
        <div class="section-title-wrap">
            <div class="title-left">
                <h2 class="section-heading-text">ক্যটাগরি সমুহ</h2>
                <span class="section-subtext">আপনার পছন্দের ক্যাটাগরি বেছে নিন</span>
            </div>
            <a href="{{ route('shop') }}" class="section-view-all">সবগুলো দেখুন ➔</a>
        </div>

        <div class="category-circle-grid">
            @foreach($categories->take(12) as $cat)
                <a href="{{ route('category.show', $cat) }}" class="cat-circle-card">
                    <div class="cat-img-wrapper">
                        <span class="cat-emoji">{{ $cat->icon }}</span>
                    </div>
                    <h4 class="cat-name-en">{{ $cat->name }}</h4>
                    @if($cat->name_bn)
                        <span class="cat-name-bn">{{ $cat->name_bn }}</span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Flash Deals / On Sale Products (ছাড়ের পন্য সমুহ) -->
<section class="home-section sale-deals-section">
    <div class="container">
        <div class="section-title-wrap flash-title-wrap">
            <div class="title-left">
                <span class="flash-icon">🔥</span>
                <h2 class="section-heading-text">ছাড়ের পন্য সমুহ</h2>
                <!-- Countdown Timer -->
                <div class="deal-countdown" id="dealCountdown">
                    <span class="cd-box"><strong id="cdDays">02</strong><small>দিন</small></span>
                    <span class="cd-sep">:</span>
                    <span class="cd-box"><strong id="cdHours">14</strong><small>ঘণ্টা</small></span>
                    <span class="cd-sep">:</span>
                    <span class="cd-box"><strong id="cdMins">36</strong><small>মিনিট</small></span>
                    <span class="cd-sep">:</span>
                    <span class="cd-box"><strong id="cdSecs">48</strong><small>সেকেন্ড</small></span>
                </div>
            </div>
            <a href="{{ route('shop', ['filter' => 'sale']) }}" class="section-view-all">সবগুলো ছাড় দেখুন ➔</a>
        </div>

        <div class="products-carousel-grid">
            @foreach($saleProducts as $product)
                @include('partials.product-card')
            @endforeach
        </div>
    </div>
</section>

<!-- Best Selling Products (সেরা পন্যের তালিকা) -->
<section class="home-section bestseller-section">
    <div class="container">
        <div class="section-title-wrap">
            <div class="title-left">
                <span class="section-icon">⭐</span>
                <h2 class="section-heading-text">সেরা পন্যের তালিকা</h2>
                <span class="section-subtext">গ্রাহকদের সবচেয়ে পছন্দের সেরা পণ্যসমূহ</span>
            </div>
            <a href="{{ route('shop', ['filter' => 'best']) }}" class="section-view-all">সবগুলো দেখুন ➔</a>
        </div>

        <div class="products-carousel-grid">
            @foreach($bestSellers as $product)
                @include('partials.product-card')
            @endforeach
        </div>
    </div>
</section>

<!-- Top Categories & Spotlight Section -->
<section class="home-section spotlight-section">
    <div class="container spotlight-layout">
        <!-- Left Sidebar: Top Categories -->
        <aside class="spotlight-sidebar">
            <div class="sidebar-header">
                <h3>টপ ক্যটাগরি</h3>
            </div>
            <div class="sidebar-cat-list">
                @foreach($topCategories as $cat)
                    <a href="{{ route('category.show', $cat) }}" class="side-cat-item">
                        <span class="cat-ico">{{ $cat->icon }}</span>
                        <div class="cat-desc">
                            <strong>{{ $cat->name }}</strong>
                            @if($cat->name_bn)<small>{{ $cat->name_bn }}</small>@endif
                        </div>
                        <span class="cat-arrow">➔</span>
                    </a>
                @endforeach
            </div>
        </aside>

        <!-- Right Spotlight Featured Showcase -->
        <div class="spotlight-main">
            @if($spotlight)
                <div class="spotlight-featured-card">
                    <div class="spotlight-img">
                        @if($spotlight->discountPercent())
                            <span class="spotlight-badge">{{ $spotlight->discountPercent() }}% Off</span>
                        @endif
                        <img src="{{ $spotlight->image }}" alt="{{ $spotlight->name }}">
                    </div>
                    <div class="spotlight-details">
                        <div class="spotlight-tag">স্পটলাইট আইটেম</div>
                        <h3 class="spotlight-title"><a href="{{ route('product.show', $spotlight) }}">{{ $spotlight->name }}</a></h3>
                        <div class="spotlight-price">
                            <span class="curr-price">৳ {{ number_format($spotlight->price, 0) }}</span>
                            @if($spotlight->compare_price)
                                <del class="prev-price">৳ {{ number_format($spotlight->compare_price, 0) }}</del>
                            @endif
                        </div>
                        <p class="spotlight-desc">{{ Str::limit($spotlight->description, 140) }}</p>
                        <div class="spotlight-actions">
                            <form method="post" action="{{ route('cart.buyNow', $spotlight) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-spotlight-order">অর্ডার করুন এখনই ➔</button>
                            </form>
                            <a href="{{ route('product.show', $spotlight) }}" class="btn-spotlight-view">বিস্তারিত দেখুন</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Mini Grid -->
            <div class="spotlight-mini-grid">
                @foreach($featured->skip(1)->take(4) as $product)
                    @include('partials.product-card')
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Coin & Hobby Collection (কয়েন & হবি কালেকশন) -->
<section class="home-section coin-collection-section">
    <div class="container">
        <div class="section-title-wrap">
            <div class="title-left">
                <span class="section-icon">🪙</span>
                <h2 class="section-heading-text">কয়েন & হবি কালেকশন</h2>
                <span class="section-subtext">রেয়ার ঐতিহাসিক কয়েন এবং রেপ্লিকা কালেকশন</span>
            </div>
            <a href="{{ route('category.show', 'coin-hobby') }}" class="section-view-all">সব কয়েন দেখুন ➔</a>
        </div>

        <div class="products-carousel-grid">
            @foreach($coins as $product)
                @include('partials.product-card')
            @endforeach
        </div>
    </div>
</section>

<!-- Bottom Widgets: Recent, Featured, Top Rated -->
<section class="home-section widget-tri-section">
    <div class="container widget-tri-grid">
        <!-- Recent Products -->
        <div class="tri-widget">
            <h4 class="tri-widget-title"><span>RECENT PRODUCTS</span></h4>
            <div class="tri-list">
                @foreach($recent as $item)
                    <a href="{{ route('product.show', $item) }}" class="tri-item">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="tri-thumb">
                        <div class="tri-info">
                            <span class="tri-name">{{ Str::limit($item->name, 45) }}</span>
                            <div class="tri-stars">★★★★★</div>
                            <strong class="tri-price">৳ {{ number_format($item->price, 0) }}</strong>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Featured Products -->
        <div class="tri-widget">
            <h4 class="tri-widget-title"><span>FEATURED PRODUCTS</span></h4>
            <div class="tri-list">
                @foreach($featured->take(3) as $item)
                    <a href="{{ route('product.show', $item) }}" class="tri-item">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="tri-thumb">
                        <div class="tri-info">
                            <span class="tri-name">{{ Str::limit($item->name, 45) }}</span>
                            <div class="tri-stars">★★★★★</div>
                            <strong class="tri-price">৳ {{ number_format($item->price, 0) }}</strong>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Top Rated / On Sale -->
        <div class="tri-widget">
            <h4 class="tri-widget-title"><span>TOP RATED PRODUCTS</span></h4>
            <div class="tri-list">
                @foreach($topRated as $item)
                    <a href="{{ route('product.show', $item) }}" class="tri-item">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="tri-thumb">
                        <div class="tri-info">
                            <span class="tri-name">{{ Str::limit($item->name, 45) }}</span>
                            <div class="tri-stars">★★★★★</div>
                            <strong class="tri-price">৳ {{ number_format($item->price, 0) }}</strong>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
// Hero Carousel Slider logic
var currentSlide = 0;
var slides = document.querySelectorAll('#heroSlider .slide');
var dots = document.querySelectorAll('#sliderDots .dot');
var slideInterval;

function showSlide(index) {
    if (!slides.length) return;
    if (index >= slides.length) currentSlide = 0;
    else if (index < 0) currentSlide = slides.length - 1;
    else currentSlide = index;

    slides.forEach(function(s, i) {
        s.classList.toggle('active', i === currentSlide);
    });
    dots.forEach(function(d, i) {
        d.classList.toggle('active', i === currentSlide);
    });
}

function changeSlide(direction) {
    clearInterval(slideInterval);
    showSlide(currentSlide + direction);
    startAutoSlide();
}

function goToSlide(index) {
    clearInterval(slideInterval);
    showSlide(index);
    startAutoSlide();
}

function startAutoSlide() {
    slideInterval = setInterval(function() {
        showSlide(currentSlide + 1);
    }, 5000);
}
startAutoSlide();

// Deal Countdown Clock Simulation
function updateCountdown() {
    var secsEl = document.getElementById('cdSecs');
    var minsEl = document.getElementById('cdMins');
    var hoursEl = document.getElementById('cdHours');
    if (!secsEl) return;

    var s = parseInt(secsEl.innerText, 10) - 1;
    if (s < 0) {
        s = 59;
        var m = parseInt(minsEl.innerText, 10) - 1;
        if (m < 0) {
            m = 59;
            var h = parseInt(hoursEl.innerText, 10) - 1;
            if (h < 0) h = 23;
            hoursEl.innerText = h < 10 ? '0' + h : h;
        }
        minsEl.innerText = m < 10 ? '0' + m : m;
    }
    secsEl.innerText = s < 10 ? '0' + s : s;
}
setInterval(updateCountdown, 1000);
</script>
@endsection
