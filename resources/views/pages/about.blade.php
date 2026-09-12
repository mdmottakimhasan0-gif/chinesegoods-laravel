@extends('layouts.store')

@section('title', 'About Us – Chinese Goods BD')

@section('content')
<div class="container breadcrumb-wrap">
    <nav class="breadcrumb-nav">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">/</span>
        <span class="current">About Us</span>
    </nav>
</div>

<div class="container static-page-container">
    <div class="static-page-card">
        <div class="page-header-title">
            <h1>About Chinese Goods BD</h1>
            <p>All items are in one place – আপনার নির্ভরযোগ্য চায়না পণ্যের ঠিকানা</p>
        </div>

        <div class="static-content-body">
            <p><strong>Chinese Goods BD</strong> বাংলাদেশের একটি স্বনামধন্য ও নির্ভরযোগ্য ই-কমার্স প্ল্যাটফর্ম। আমরা সরাসরি চীন থেকে বিশ্বমানের এবং নিত্যপ্রয়োজনীয় ইউনিক গ্যাজেট, লাইফস্টাইল পণ্য, ইলেকট্রনিক্স, কিচেন আইটেম, এন্টিক ও রেয়ার কয়েন কালেকশন এবং গিফট সামগ্রী আমদানি করে সারা বাংলাদেশে সুলভ মূল্যে ক্যাশ অন ডেলিভারিতে পৌঁছে দিচ্ছি।</p>

            <div class="about-highlights-grid">
                <div class="about-highlight-box">
                    <span class="ico">🏆</span>
                    <h4>১০০% কোয়ালিটি নিশ্চয়তা</h4>
                    <p>প্রতিটি পণ্য আমদানির পর কঠোরভাবে পরীক্ষা করে ক্রেতাদের নিকট পাঠানো হয়।</p>
                </div>
                <div class="about-highlight-box">
                    <span class="ico">🚚</span>
                    <h4>সারা দেশে হোম ডেলিভারি</h4>
                    <p>ক্যাশ অন ডেলিভারিতে পণ্য হাতে পেয়ে মূল্য পরিশোধের সুবিধা।</p>
                </div>
                <div class="about-highlight-box">
                    <span class="ico">📞</span>
                    <h4>সার্বক্ষণিক গ্রাহক সেবা</h4>
                    <p>অর্ডার সংক্রান্ত যে কোনো তথ্যের জন্য আমাদের হেল্পলাইন ২৪/৭ প্রস্তুত।</p>
                </div>
            </div>

            <div class="company-official-info">
                <h3>প্রতিষ্ঠানের তথ্য ও ঠিকানা:</h3>
                <ul>
                    <li><strong>প্রতিষ্ঠানের নাম:</strong> Chinese Goods BD</li>
                    <li><strong>ট্রেড লাইসেন্স নম্বর (Trade License No):</strong> 20258514963000011</li>
                    <li><strong>ঠিকানা:</strong> Khamar mor-2021, Nesco (PDB) Opposite, College Rd, Lalbagh Rangpur -5402</li>
                    <li><strong>মোবাইল / হেল্পলাইন:</strong> +8801946225922</li>
                    <li><strong>অফিসিয়াল ইমেইল:</strong> info.chinesegoods@gmail.com</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
