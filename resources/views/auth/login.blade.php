@extends('layouts.store')

@section('title', 'Login – Chinese Goods BD')

@section('content')
<div class="auth-page-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-header-emblem">👤</div>
            <h1>লগইন করুন</h1>
            <p>আপনার অর্ডার, উইশলিস্ট ও অ্যাকাউন্টের তথ্যের জন্য সাইন ইন করুন</p>
        </div>

        <div class="auth-body">
            @if(session('success'))
                <div class="auth-alert-success">
                    <span>✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="auth-alert-error">
                    <span>⚠️</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="post" action="{{ route('login') }}" id="pageLoginForm">
                @csrf
                <div class="auth-field">
                    <label for="loginEmail">ইমেইল ঠিকানা (Email Address)</label>
                    <div class="auth-input-group">
                        <span class="auth-icon">✉️</span>
                        <input type="email" id="loginEmail" name="email" value="{{ old('email') }}" placeholder="example@email.com" required autocomplete="email" autofocus>
                    </div>
                </div>

                <div class="auth-field">
                    <label for="loginPassword">পাসওয়ার্ড (Password)</label>
                    <div class="auth-input-group">
                        <span class="auth-icon">🔒</span>
                        <input type="password" id="loginPassword" name="password" placeholder="••••••••" required autocomplete="current-password">
                        <button type="button" class="auth-toggle-pwd" onclick="togglePasswordVisibility('loginPassword', this)" aria-label="Toggle password">👁️</button>
                    </div>
                </div>

                <div class="auth-options">
                    <label class="auth-remember-label">
                        <input type="checkbox" name="remember" value="1">
                        <span>আমাকে মনে রাখুন</span>
                    </label>
                    <a href="{{ route('tracking') }}" class="auth-help-link">অর্ডার ট্র্যাক করুন</a>
                </div>

                <button type="submit" class="btn-auth-submit">
                    <span>লগইন করুন (Sign In)</span>
                    <span>➔</span>
                </button>
            </form>

            <div class="auth-demo-badge">
                <div>
                    <span style="font-weight:700;display:block;">⚡ অ্যাডমিন ডেমো একাউন্ট:</span>
                    <code>admin@chinesegoodsbd.test</code>
                </div>
                <button type="button" class="btn-quick-fill" onclick="fillAdminCredentials('loginEmail', 'loginPassword')">Auto Fill</button>
            </div>

            <div class="auth-footer">
                নতুন ব্যবহারকারী? <a href="{{ route('register') }}">নতুন অ্যাকাউন্ট তৈরি করুন</a>
            </div>
        </div>
    </div>
</div>
@endsection
