@extends('layouts.store')

@section('title', 'Payment Methods – Chinese Goods BD')

@section('content')
<div class="container breadcrumb-wrap">
    <nav class="breadcrumb-nav">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">/</span>
        <span class="current">Payment Methods</span>
    </nav>
</div>

<div class="container static-page-container">
    <div class="static-page-card">
        <div class="page-header-title">
            <h1>মূল্য পরিশোধের মাধ্যম (Payment Methods)</h1>
            <p>আপনার সুবিধার্থে সহজ ও নিরাপদ পেমেন্ট ব্যবস্থা</p>
        </div>

        <div class="static-content-body">
            <div class="about-highlights-grid">
                <div class="about-highlight-box">
                    <span class="ico">💵</span>
                    <h4>ক্যাশ অন ডেলিভারি (COD)</h4>
                    <p>পণ্য হাতে পেয়ে দেখে ডেলিভারি ম্যানের নিকট টাকা পরিশোধ করুন। কোনো অগ্রিম পেমেন্টের প্রয়োজন নেই।</p>
                </div>
                <div class="about-highlight-box">
                    <span class="ico">📱</span>
                    <h4>bKash (বিকাশ)</h4>
                    <p>বিকাশের মাধ্যমে নিরাপদে পেমেন্ট করার সুবিধা। আমাদের পার্সোনাল বা মার্চেন্ট নাম্বারে পে করতে পারেন।</p>
                </div>
                <div class="about-highlight-box">
                    <span class="ico">⚡</span>
                    <h4>Nagad & Rocket (নগদ ও রকেট)</h4>
                    <p>ডাক বিভাগের নগদ ও ডাচ্-বাংলা ব্যাংকের রকেট অ্যাকাউন্টের মাধ্যমেও পেমেন্ট গ্রহণ করা হয়।</p>
                </div>
            </div>

            <div class="company-official-info" style="margin-top:24px;">
                <h3>জরুরি পেমেন্ট নির্দেশিকা:</h3>
                <p>পেমেন্ট সংক্রান্ত কোনো তথ্য বা ভেরিফিকেশনের জন্য শুধুমাত্র আমাদের অফিশিয়াল নাম্বার <strong>+8801946225922</strong> এ যোগাযোগ করবেন। কোনো প্রতারক চক্রের কথায় অপরিচিত নাম্বারে টাকা পাঠাবেন না।</p>
            </div>
        </div>
    </div>
</div>
@endsection
