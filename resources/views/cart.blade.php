@extends('layouts.store')

@section('title', 'Shopping Cart – Chinese Goods BD')

@section('content')
<div class="container cart-page-container">
    <div class="page-header-title">
        <h1>শপিং কার্ট (My Cart)</h1>
        <p>আপনার নির্বাচিত পণ্যসমূহ</p>
    </div>

    @if(count($items) === 0)
        <div class="empty-cart-box">
            <div class="empty-icon">🛒</div>
            <h2>আপনার শপিং কার্ট খালি!</h2>
            <p>আপনার কার্টে বর্তমানে কোনো পণ্য যোগ করা হয়নি। আমাদের সেরা পণ্যগুলো দেখতে কালেকশনে যান।</p>
            <a href="{{ route('shop') }}" class="btn-continue-shop">পণ্য খুঁজুন (Continue Shopping) ➔</a>
        </div>
    @else
        <div class="cart-layout-grid">
            <div class="cart-items-table-wrap">
                <table class="modern-cart-table">
                    <thead>
                        <tr>
                            <th>পণ্য (Product)</th>
                            <th>মূল্য (Price)</th>
                            <th>পরিমাণ (Quantity)</th>
                            <th>মোট (Total)</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key => $item)
                        <tr>
                            <td class="product-col">
                                <div class="cart-product-cell">
                                    <img src="{{ $item['image'] ?? 'https://picsum.photos/80' }}" alt="{{ $item['name'] }}" class="cart-thumb">
                                    <div class="cart-prod-meta">
                                        <a href="{{ route('product.show', $item['slug'] ?? $item['product_id']) }}" class="cart-prod-name">
                                            {{ $item['name'] }}
                                        </a>
                                        @if(!empty($item['color']))
                                            <span class="cart-prod-color">কালার: {{ $item['color'] }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="price-col">
                                ৳ {{ number_format($item['price'], 0) }}
                            </td>
                            <td class="qty-col">
                                <form method="post" action="{{ route('cart.update') }}" class="cart-qty-form">
                                    @csrf
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <div class="table-qty-box">
                                        <button type="button" class="q-btn" onclick="var inp=this.nextElementSibling; if(inp.value>1){inp.value--; this.form.submit();}">−</button>
                                        <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" max="20" onchange="this.form.submit()">
                                        <button type="button" class="q-btn" onclick="var inp=this.previousElementSibling; if(inp.value<20){inp.value++; this.form.submit();}">+</button>
                                    </div>
                                </form>
                            </td>
                            <td class="total-col">
                                <strong>৳ {{ number_format($item['price'] * $item['qty'], 0) }}</strong>
                            </td>
                            <td class="action-col">
                                <form method="post" action="{{ route('cart.remove') }}">
                                    @csrf
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <button type="submit" class="btn-remove-item" title="Remove item">&times;</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <aside class="cart-summary-sidebar">
                <div class="checkout-card">
                    <div class="checkout-card-header">
                        <h3>অর্ডার সারাংশ (Cart Totals)</h3>
                    </div>
                    <div class="checkout-card-body">
                        <div class="tot-row">
                            <span>মোট পণ্যের মূল্য:</span>
                            <strong>৳ {{ number_format($subtotal, 0) }}</strong>
                        </div>
                        <div class="tot-row">
                            <span>ডেলিভারি চার্জ:</span>
                            <span>চেকআউটে নির্ধারিত হবে</span>
                        </div>
                        <hr class="tot-divider">
                        <div class="tot-row grand-total-row">
                            <span>মোট (Subtotal):</span>
                            <strong class="highlight-total">৳ {{ number_format($subtotal, 0) }}</strong>
                        </div>

                        <div style="margin-top:20px;">
                            <a href="{{ route('checkout.index') }}" class="btn-confirm-order" style="display:block;text-align:center;text-decoration:none;">
                                ➔ চেকআউটে এগিয়ে যান (Proceed to Checkout)
                            </a>
                            <a href="{{ route('shop') }}" class="btn-back-shop" style="display:block;text-align:center;margin-top:12px;color:#555;font-size:13px;">
                                ← আরও পণ্য ক্রয় করুন (Continue Shopping)
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    @endif
</div>
@endsection
