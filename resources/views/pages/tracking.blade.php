@extends('layouts.store')

@section('title', 'Track Your Order – Chinese Goods BD')

@section('content')
<div class="container breadcrumb-wrap">
    <nav class="breadcrumb-nav">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">/</span>
        <span class="current">Track Order</span>
    </nav>
</div>

<div class="container static-page-container">
    <div class="static-page-card">
        <div class="page-header-title" style="text-align:center;">
            <h1>অর্ডার ট্র্যাকিং (Track Your Order)</h1>
            <p>আপনার অর্ডার নম্বর এবং মোবাইল নম্বর দিয়ে বর্তমান অবস্থা জানুন</p>
        </div>

        <div class="tracking-form-wrap" style="max-width:560px;margin:24px auto;">
            <form onsubmit="event.preventDefault(); document.getElementById('trackResult').style.display='block';" class="form-card">
                <div class="form-group">
                    <label class="input-label">অর্ডার নম্বর (Order ID) <span class="req">*</span></label>
                    <input type="text" placeholder="যেমন: CG260912..." required class="form-control" id="trackOrderNo">
                    <small style="color:#777;font-size:12px;">আপনার অর্ডার করার পর প্রাপ্ত কনফার্মেশন এসএমএস বা ইনভয়েসের অর্ডার নং দিন।</small>
                </div>

                <div class="form-group" style="margin-top:14px;">
                    <label class="input-label">মোবাইল নম্বর (Billing Phone) <span class="req">*</span></label>
                    <input type="tel" placeholder="যেমন: 01XXXXXXXXX" required class="form-control" id="trackPhone">
                </div>

                <button type="submit" class="btn-confirm-order" style="width:100%;margin-top:16px;">
                    🔍 ট্র্যাক করুন (Track Now)
                </button>
            </form>

            <div id="trackResult" style="display:none;margin-top:20px;padding:16px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;">
                <h4 style="color:#166534;margin-bottom:6px;">✓ অর্ডার তথ্য পাওয়া গেছে</h4>
                <p style="font-size:14px;color:#333;margin:0;">স্ট্যাটাস: <span class="stock-status in-stock" style="margin-left:6px;">Processing / প্রস্তুত হচ্ছে</span></p>
                <p style="font-size:13px;color:#555;margin-top:8px;">আমাদের রাইডার পার্সেল সংগ্রহ করেছে। বিস্তারিত জানতে কল করুন: <strong>01946-225922</strong></p>
            </div>
        </div>
    </div>
</div>
@endsection
