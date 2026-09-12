@extends('layouts.store')

@section('title', 'Checkout – Chinese Goods BD')

@section('content')
<div class="container checkout-page-container">
    <div class="checkout-header-banner">
        <h1>অর্ডার কনফার্ম করুন</h1>
        <p>সরাসরি ক্যাশ অন ডেলিভারিতে অর্ডার করতে নিচের ফর্মটি সঠিক তথ্য দিয়ে পূরণ করুন</p>
    </div>

    @if($errors->any())
        <div class="alert alert-error" style="margin-bottom:20px;">
            <strong>অনুগ্রহ করে তথ্যগুলো সংশোধন করুন:</strong>
            <ul style="margin:6px 0 0 16px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="checkout-grid-layout">
        <!-- Left: Customer & Delivery Details Form -->
        <div class="checkout-form-column">
            <form method="post" action="{{ route('checkout.place') }}" id="checkoutOrderForm">
                @csrf

                <!-- Section 1: Customer Info -->
                <div class="checkout-card">
                    <div class="checkout-card-header">
                        <span class="step-num">১</span>
                        <h3>আপনার তথ্য (Customer Information)</h3>
                    </div>
                    <div class="checkout-card-body">
                        <div class="form-group">
                            <label class="input-label">আপনার পূর্ণ নাম (Full Name) <span class="req">*</span></label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" placeholder="যেমন: মোঃ রাকিব হাসান" required class="form-control">
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="input-label">মোবাইল নাম্বার (Active Phone Number) <span class="req">*</span></label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="যেমন: 01XXXXXXXXX" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="input-label">ইমেইল (ঐচ্ছিক / Email)</label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" placeholder="example@gmail.com" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">আপনার সম্পূর্ণ ঠিকানা (Full Delivery Address) <span class="req">*</span></label>
                            <textarea name="address" rows="3" placeholder="বাসা/হোল্ডিং নং, রোড, গ্রাম/মহল্লা, থানা এবং জেলার নাম লিখুন..." required class="form-control">{{ old('address') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="input-label">শহর / জেলা (City / District)</label>
                            <input type="text" name="city" value="{{ old('city', 'Dhaka') }}" placeholder="যেমন: ঢাকা / রংপুর" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Delivery Location (Shipping Zone) -->
                <div class="checkout-card" style="margin-top:20px;">
                    <div class="checkout-card-header">
                        <span class="step-num">২</span>
                        <h3>ডেলিভারি এরিয়া নির্বাচন করুন (Delivery Area)</h3>
                    </div>
                    <div class="checkout-card-body">
                        <div class="shipping-options-grid">
                            <label class="shipping-option-card {{ old('delivery_zone', 'inside_dhaka') === 'inside_dhaka' ? 'selected' : '' }}" onclick="updateShipping(70, this)">
                                <input type="radio" name="delivery_zone" value="inside_dhaka" {{ old('delivery_zone', 'inside_dhaka') === 'inside_dhaka' ? 'checked' : '' }}>
                                <div class="opt-content">
                                    <strong>ঢাকার ভিতরে (Inside Dhaka)</strong>
                                    <small>হোম ডেলিভারি (১-২ কার্যদিবস)</small>
                                </div>
                                <div class="opt-cost">৳ ৭০</div>
                            </label>

                            <label class="shipping-option-card {{ old('delivery_zone') === 'outside_dhaka' ? 'selected' : '' }}" onclick="updateShipping(130, this)">
                                <input type="radio" name="delivery_zone" value="outside_dhaka" {{ old('delivery_zone') === 'outside_dhaka' ? 'checked' : '' }}>
                                <div class="opt-content">
                                    <strong>ঢাকার বাইরে (Outside Dhaka)</strong>
                                    <small>সারা বাংলাদেশ হোম ডেলিভারি (২-৩ দিন)</small>
                                </div>
                                <div class="opt-cost">৳ ১৩০</div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Payment Method -->
                <div class="checkout-card" style="margin-top:20px;">
                    <div class="checkout-card-header">
                        <span class="step-num">৩</span>
                        <h3>পেমেন্ট পদ্ধতি নির্বাচন করুন (Payment Method)</h3>
                    </div>
                    <div class="checkout-card-body">
                        <div class="payment-options-grid">
                            <label class="payment-option-card selected" onclick="selectPayment(this)">
                                <input type="radio" name="payment_method" value="cod" checked>
                                <div class="pay-icon-box">💵</div>
                                <div class="pay-info">
                                    <strong>ক্যাশ অন ডেলিভারি (Cash on Delivery)</strong>
                                    <small>পণ্য হাতে পেয়ে দেখে ডেলিভারি ম্যানের কাছে টাকা পরিশোধ করুন</small>
                                </div>
                            </label>

                            <label class="payment-option-card" onclick="selectPayment(this)">
                                <input type="radio" name="payment_method" value="bkash">
                                <div class="pay-icon-box" style="background:#e2136e;color:#fff;">bK</div>
                                <div class="pay-info">
                                    <strong>bKash (বিকাশ)</strong>
                                    <small>বিকাশ সেন্ড মানি বা পেমেন্ট গেটওয়ে</small>
                                </div>
                            </label>

                            <label class="payment-option-card" onclick="selectPayment(this)">
                                <input type="radio" name="payment_method" value="nagad">
                                <div class="pay-icon-box" style="background:#f7921e;color:#fff;">নগদ</div>
                                <div class="pay-info">
                                    <strong>Nagad (নগদ)</strong>
                                    <small>নগদ অ্যাকাউন্টের মাধ্যমে পেমেন্ট</small>
                                </div>
                            </label>

                            <label class="payment-option-card" onclick="selectPayment(this)">
                                <input type="radio" name="payment_method" value="rocket">
                                <div class="pay-icon-box" style="background:#8c3494;color:#fff;">🚀</div>
                                <div class="pay-info">
                                    <strong>Rocket (রকেট)</strong>
                                    <small>ডাচ্-বাংলা রকেট পেমেন্ট</small>
                                </div>
                            </label>
                        </div>

                        <div class="form-group" style="margin-top:16px;">
                            <label class="input-label">অর্ডারের জন্য বিশেষ কোনো নির্দেশনা থাকলে লিখুন (Optional)</label>
                            <textarea name="notes" rows="2" placeholder="যেমন: ডেলিভারির আগে কল করবেন..." class="form-control">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="checkout-submit-wrap">
                    <button type="submit" class="btn-confirm-order">
                        ✓ অর্ডার কনফার্ম করুন (Place Order)
                    </button>
                    <p class="terms-note">
                        অর্ডার কনফার্ম করার মাধ্যমে আপনি আমাদের <a href="{{ route('terms') }}" target="_blank">শর্তাবলী</a> মেনে নিচ্ছেন।
                    </p>
                </div>
            </form>
        </div>

        <!-- Right: Order Summary Card -->
        <aside class="checkout-summary-column">
            <div class="checkout-card summary-card">
                <div class="checkout-card-header">
                    <h3>আপনার অর্ডারের বিবরণী</h3>
                </div>
                <div class="checkout-card-body">
                    <div class="checkout-item-list">
                        @foreach($items as $item)
                            <div class="summary-item-row">
                                <div class="item-pic">
                                    <img src="{{ $item['image'] ?? 'https://picsum.photos/80' }}" alt="{{ $item['name'] }}">
                                </div>
                                <div class="item-meta">
                                    <h4 class="item-title">{{ $item['name'] }}</h4>
                                    @if(!empty($item['color']))
                                        <small class="item-color">কালার: {{ $item['color'] }}</small>
                                    @endif
                                    <div class="item-calc">
                                        {{ $item['qty'] }} × ৳ {{ number_format($item['price'], 0) }}
                                    </div>
                                </div>
                                <div class="item-total-val">
                                    ৳ {{ number_format($item['price'] * $item['qty'], 0) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="summary-totals-block">
                        <div class="tot-row">
                            <span>পণ্যগুলোর মোট মূল্য (Subtotal):</span>
                            <strong>৳ {{ number_format($subtotal, 0) }}</strong>
                        </div>
                        <div class="tot-row">
                            <span>ডেলিভারি চার্জ (Delivery):</span>
                            <strong id="displayShippingCost">৳ ৭০</strong>
                        </div>
                        <hr class="tot-divider">
                        <div class="tot-row grand-total-row">
                            <span>সর্বমোট (Grand Total):</span>
                            <strong class="highlight-total" id="displayGrandTotal">
                                ৳ {{ number_format($subtotal + 70, 0) }}
                            </strong>
                        </div>
                    </div>

                    <div class="trust-badge-card">
                        <div class="badge-row">
                            <span class="ico">🛡️</span>
                            <span>১০০% নিরাপদ ও আসল পণ্য ডেলিভারি</span>
                        </div>
                        <div class="badge-row">
                            <span class="ico">🚚</span>
                            <span>ক্যাশ অন ডেলিভারিতে চেক করে মূল্য পরিশোধ</span>
                        </div>
                        <div class="badge-row">
                            <span class="ico">📞</span>
                            <span>সহায়তার জন্য কল করুন: 01946-225922</span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection

@section('scripts')
<script>
var subtotal = {{ (float) $subtotal }};

function updateShipping(cost, cardEl) {
    document.querySelectorAll('.shipping-option-card').forEach(function(el) {
        el.classList.remove('selected');
    });
    if (cardEl) {
        cardEl.classList.add('selected');
    }
    
    var shipEl = document.getElementById('displayShippingCost');
    var totalEl = document.getElementById('displayGrandTotal');
    if (shipEl) shipEl.innerText = '৳ ' + cost;
    if (totalEl) totalEl.innerText = '৳ ' + Number(subtotal + cost).toLocaleString();
}

function selectPayment(cardEl) {
    document.querySelectorAll('.payment-option-card').forEach(function(el) {
        el.classList.remove('selected');
    });
    if (cardEl) {
        cardEl.classList.add('selected');
    }
}
</script>
@endsection
