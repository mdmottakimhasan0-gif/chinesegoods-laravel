@extends('layouts.store')

@section('title', 'অর্ডার সফল হয়েছে – Chinese Goods BD')

@section('content')
<div class="container order-success-page">
    <div class="success-card">
        <div class="success-icon-wrap">
            <span class="check-mark">✓</span>
        </div>
        <h1 class="success-title">ধন্যবাদ! আপনার অর্ডারটি সফলভাবে গ্রহণ করা হয়েছে।</h1>
        <p class="success-sub">অর্ডার নম্বর: <strong>#{{ $order->order_no }}</strong></p>
        <p class="success-callout">খুব শীঘ্রই আমাদের প্রতিনিধি আপনার দেওয়া নাম্বারে ({{ $order->phone }}) কল করে অর্ডারটি কনফার্ম করবেন।</p>

        <div class="order-details-grid">
            <div class="order-info-box">
                <h4>ডেলিভারি তথ্য</h4>
                <p><strong>নাম:</strong> {{ $order->name }}</p>
                <p><strong>ফোন:</strong> {{ $order->phone }}</p>
                @if($order->email)<p><strong>ইমেইল:</strong> {{ $order->email }}</p>@endif
                <p><strong>ঠিকানা:</strong> {{ $order->address }}</p>
                <p><strong>শহর:</strong> {{ $order->city }}</p>
                <p><strong>পেমেন্ট মেথড:</strong> {{ strtoupper($order->payment_method) }} (ক্যাশ অন ডেলিভারি)</p>
            </div>

            <div class="order-info-box">
                <h4>অর্ডার সামারি</h4>
                <div class="order-items-mini">
                    @foreach($order->items as $item)
                        <div class="mini-item-row">
                            <span>{{ $item->product_name }} × {{ $item->qty }}</span>
                            <strong>৳ {{ number_format($item->price * $item->qty, 0) }}</strong>
                        </div>
                    @endforeach
                </div>
                <hr style="margin:12px 0; border:0; border-top:1px solid #eee;">
                <div class="mini-item-row">
                    <span>সাবটোটাল:</span>
                    <span>৳ {{ number_format($order->subtotal, 0) }}</span>
                </div>
                <div class="mini-item-row">
                    <span>ডেলিভারি চার্জ:</span>
                    <span>৳ {{ number_format($order->shipping, 0) }}</span>
                </div>
                <div class="mini-item-row total-highlight">
                    <strong>সর্বমোট প্রদেয়:</strong>
                    <strong>৳ {{ number_format($order->total, 0) }}</strong>
                </div>
            </div>
        </div>

        <div class="success-actions-row">
            <a href="{{ route('home') }}" class="btn-confirm-order" style="display:inline-block;max-width:280px;text-decoration:none;">
                হোমে ফিরে যান (Back to Home)
            </a>
            <a href="https://wa.me/8801946225922?text=Order%20Confirmation%20for%20{{ $order->order_no }}" target="_blank" class="btn-wa-confirm">
                WhatsApp এ মেসেজ দিন
            </a>
        </div>
    </div>
</div>
@endsection
