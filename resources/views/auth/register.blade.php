@extends('layouts.store')

@section('title', 'Signup – Chinese Goods BD')

@section('content')
<div class="auth-page-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-header-emblem">✨</div>
            <h1>নতুন অ্যাকাউন্ট তৈরি করুন</h1>
            <p>আপনার ব্যক্তিগত তথ্য Chinese Goods BD-এ নিরাপদে সংরক্ষিত থাকে</p>
        </div>

        <div class="auth-body">
            @if($errors->any())
                <div class="auth-alert-error">
                    <span>⚠️</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="post" action="{{ route('register') }}">
                @csrf
                <div class="auth-field">
                    <label for="regName">আপনার পুরো নাম (Full Name)</label>
                    <div class="auth-input-group">
                        <span class="auth-icon">👤</span>
                        <input type="text" id="regName" name="name" value="{{ old('name') }}" placeholder="আপনার পুরো নাম লিখুন" required autocomplete="name" autofocus>
                    </div>
                </div>

                <div class="auth-field">
                    <label for="regEmail">ইমেইল ঠিকানা (Email Address)</label>
                    <div class="auth-input-group">
                        <span class="auth-icon">✉️</span>
                        <input type="email" id="regEmail" name="email" value="{{ old('email') }}" placeholder="example@email.com" required autocomplete="email">
                    </div>
                </div>

                <div class="auth-field">
                    <label for="regPassword">পাসওয়ার্ড (Password)</label>
                    <div class="auth-input-group">
                        <span class="auth-icon">🔒</span>
                        <input type="password" id="regPassword" name="password" placeholder="কমপক্ষে ৬ ডিজিটের পাসওয়ার্ড" required autocomplete="new-password">
                        <button type="button" class="auth-toggle-pwd" onclick="togglePasswordVisibility('regPassword', this)" aria-label="Toggle password">👁️</button>
                    </div>
                </div>

                <div class="auth-field">
                    <label for="regConfirmPassword">পাসওয়ার্ড নিশ্চিত করুন (Confirm Password)</label>
                    <div class="auth-input-group">
                        <span class="auth-icon">🔒</span>
                        <input type="password" id="regConfirmPassword" name="password_confirmation" placeholder="পাসওয়ার্ডটি আবার লিখুন" required autocomplete="new-password">
                        <button type="button" class="auth-toggle-pwd" onclick="togglePasswordVisibility('regConfirmPassword', this)" aria-label="Toggle password">👁️</button>
                    </div>
                </div>

                <button type="submit" class="btn-auth-submit" style="margin-top:10px;">
                    <span>রেজিস্ট্রেশন সম্পন্ন করুন</span>
                    <span>➔</span>
                </button>
            </form>

            <div class="auth-footer">
                ইতিমধ্যে অ্যাকাউন্ট আছে? <a href="{{ route('login') }}">লগইন করুন</a>
            </div>
        </div>
    </div>
</div>
@endsection
