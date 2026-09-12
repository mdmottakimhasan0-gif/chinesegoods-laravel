@extends('layouts.store')

@section('title', $title . ' – Chinese Goods BD')

@section('content')
<div class="container breadcrumb-wrap">
    <nav class="breadcrumb-nav">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">/</span>
        <span class="current">{{ $title }}</span>
    </nav>
</div>

<div class="container shop-page-container">
    <div class="shop-header-row">
        <div>
            <h1 class="shop-title-text">{{ $title }}</h1>
            <p class="shop-count-text">দেখাচ্ছে {{ $products->total() }} টি পণ্যের ফলাফল</p>
        </div>

        <!-- Sort Filter Form -->
        <form method="get" class="shop-sort-form">
            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            @if(request('q'))
                <input type="hidden" name="q" value="{{ request('q') }}">
            @endif
            <label for="sortSelect">বাছাই করুন:</label>
            <select name="sort" id="sortSelect" onchange="this.form.submit()" class="sort-select">
                <option value="">নতুন পণ্য (Latest)</option>
                <option value="price_asc" @selected(request('sort') === 'price_asc')>মূল্য: কম থেকে বেশি</option>
                <option value="price_desc" @selected(request('sort') === 'price_desc')>মূল্য: বেশি থেকে কম</option>
            </select>
        </form>
    </div>

    <div class="shop-layout-grid">
        <!-- Sidebar Filter -->
        <aside class="shop-sidebar">
            <div class="sidebar-box">
                <h3 class="sidebar-heading">সকল ক্যাটাগরি</h3>
                <ul class="sidebar-cat-menu">
                    @foreach($navCategories as $cat)
                        <li>
                            <a href="{{ route('category.show', $cat) }}" class="{{ request()->is('category/'.$cat->slug) ? 'active' : '' }}">
                                <span>{{ $cat->icon }} {{ $cat->name }}</span>
                                <span class="arrow">➔</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="sidebar-box" style="margin-top:20px;">
                <h3 class="sidebar-heading">ফিল্টার সমূহ</h3>
                <div class="filter-chips">
                    <a href="{{ route('shop') }}" class="chip {{ !request('filter') ? 'active' : '' }}">সকল পণ্য</a>
                    <a href="{{ route('shop', ['filter' => 'new']) }}" class="chip {{ request('filter') === 'new' ? 'active' : '' }}">✨ New Arrival</a>
                    <a href="{{ route('shop', ['filter' => 'best']) }}" class="chip {{ request('filter') === 'best' ? 'active' : '' }}">🔥 Best Selling</a>
                    <a href="{{ route('shop', ['filter' => 'sale']) }}" class="chip {{ request('filter') === 'sale' ? 'active' : '' }}">🏷️ On Sale</a>
                </div>
            </div>

            <!-- Help Callout -->
            <div class="sidebar-support-card">
                <div class="support-ico">📞</div>
                <h4>সহায়তা প্রয়োজন?</h4>
                <p>যেকোনো প্রশ্ন বা তথ্যের জন্য কল করুন</p>
                <strong>01946-225922</strong>
            </div>
        </aside>

        <!-- Product Grid Area -->
        <div class="shop-products-main">
            @if($products->count() > 0)
                <div class="products-carousel-grid">
                    @foreach($products as $product)
                        @include('partials.product-card')
                    @endforeach
                </div>
                <div class="shop-pagination-wrap">
                    {{ $products->links() }}
                </div>
            @else
                <div class="empty-results-box">
                    <div class="empty-icon">🔍</div>
                    <h3>কোনো পণ্য পাওয়া যায়নি!</h3>
                    <p>অনুগ্রহ করে অন্য কোনো শব্দ দিয়ে সার্চ করুন অথবা সকল পণ্য ব্রাউজ করুন।</p>
                    <a href="{{ route('shop') }}" class="btn-continue-shop" style="margin-top:16px;">সকল পণ্য দেখুন ➔</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
