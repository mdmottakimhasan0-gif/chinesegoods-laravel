<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Chinese Goods BD – All items are in one place')</title>
    <link rel="icon" type="image/png" href="https://chinesegoodsbd.com/wp-content/uploads/2025/11/Logo-File-16.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Inter:wght@400;500;600;700;800&family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
    @yield('styles')
</head>
<body>

<!-- Top Announcement & Helpline Bar -->
<div class="top-bar">
    <div class="container top-bar-content">
        <div class="top-bar-left">
            <a href="tel:+8801946225922" class="top-item">
                <span class="top-icon">📞</span>
                <span>Helpline: <strong>+8801946-225922</strong></span>
            </a>
            <span class="top-sep">|</span>
            <a href="mailto:info.chinesegoods@gmail.com" class="top-item">
                <span class="top-icon">✉</span>
                <span>info.chinesegoods@gmail.com</span>
            </a>
            <span class="top-sep hide-sm">|</span>
            <span class="top-promo hide-sm">⚡ ১০০% আসল চায়না পণ্য সরাসরি আপনার দরজায়</span>
        </div>
        <div class="top-bar-right">
            <a href="{{ route('tracking') }}" class="top-item"><span>📦 Track Order</span></a>
            <span class="top-sep">|</span>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="top-item" style="color:#fde047;font-weight:700;"><span>⚙️ Admin Panel</span></a>
                    <span class="top-sep">|</span>
                @endif
                <a href="{{ route('account') }}" class="top-item"><span>👤 {{ Str::limit(auth()->user()->name, 12) }}</span></a>
            @else
                <a href="{{ route('login') }}" class="top-item" onclick="openAuthModal(event, 'login')"><span>🔑 Sign In / Register</span></a>
            @endauth
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="site-header">
    <div class="header-main">
        <div class="container header-container">
            <!-- Mobile Toggle -->
            <button class="mobile-menu-btn" type="button" onclick="openMobileMenu()" aria-label="Open Menu">
                <span></span><span></span><span></span>
            </button>

            <!-- Brand Logo -->
            <a class="brand-logo" href="{{ route('home') }}">
                <img src="https://chinesegoodsbd.com/wp-content/uploads/2025/11/Logo-File-16.png" 
                     onerror="this.onerror=null; this.src='https://chinesegoodsbd.com/wp-content/uploads/2025/11/Logo-File-14-e1762339185865.png';" 
                     alt="Chinese Goods BD" 
                     class="site-logo-img">
                <span class="logo-fallback-text">
                    <strong>CHINESE GOODS BD</strong>
                    <small>All items are in one place</small>
                </span>
            </a>

            <!-- Search Bar with Category Filter -->
            <form class="search-box" action="{{ route('shop') }}" method="get">
                <div class="search-category-select">
                    <select name="category">
                        <option value="">All Categories</option>
                        @foreach($navCategories as $cat)
                            <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search for products, categories, sku..." autocomplete="off">
                <button type="submit" aria-label="Search">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </button>
            </form>

            <!-- Quick Action Icons -->
            <div class="header-tools">
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="tool-item" title="Admin Panel" style="background:rgba(0,0,0,0.22);padding:4px 10px;border-radius:6px;border:1px solid rgba(255,255,255,0.25);">
                            <div class="tool-icon" style="font-size:18px;">⚙️</div>
                            <div class="tool-text hide-sm">
                                <small style="color:#fde047;">Manage</small>
                                <strong>Admin Panel</strong>
                            </div>
                        </a>
                    @endif
                    <a href="{{ route('account') }}" class="tool-item user-tool" title="Account">
                        <div class="tool-icon">👤</div>
                        <div class="tool-text hide-sm">
                            <small>Welcome</small>
                            <strong>My Account</strong>
                        </div>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="tool-item user-tool" title="Login" onclick="openAuthModal(event, 'login')">
                        <div class="tool-icon">👤</div>
                        <div class="tool-text hide-sm">
                            <small>Hello, Sign in</small>
                            <strong>My Account</strong>
                        </div>
                    </a>
                @endauth

                <a href="{{ route('wishlist.index') }}" class="tool-item" title="Wishlist">
                    <div class="tool-icon">
                        ♡
                        @if($wishlistCount > 0)
                            <span class="badge">{{ $wishlistCount }}</span>
                        @endif
                    </div>
                    <div class="tool-text hide-sm">
                        <small>Favorite</small>
                        <strong>Wishlist</strong>
                    </div>
                </a>

                <div class="cart-tool-wrap">
                    <a href="{{ route('cart.index') }}" class="tool-item cart-tool" title="Shopping Cart">
                        <div class="tool-icon">
                            👜
                            <span class="badge" id="cartCountBadge">{{ $cartCount }}</span>
                        </div>
                        <div class="tool-text hide-sm">
                            <small>My Cart</small>
                            <strong class="cart-total-text">৳ {{ number_format($cartTotal, 0) }}</strong>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="nav-bar">
        <div class="container nav-container">
            <!-- Department Dropdown Menu -->
            <div class="dept-dropdown" id="deptDropdown">
                <button class="dept-trigger" type="button" onclick="toggleDeptMenu()" aria-expanded="false">
                    <span class="hamburger">☰</span>
                    <span>SHOP BY DEPARTMENT</span>
                    <span class="arrow">▾</span>
                </button>
                <div class="dept-list" id="deptList">
                    @foreach($navCategories as $cat)
                        <a href="{{ route('category.show', $cat) }}" class="dept-item">
                            <span class="cat-ico">{{ $cat->icon }}</span>
                            <span class="cat-txt">{{ $cat->name }}</span>
                            @if($cat->name_bn)
                                <small class="cat-bn">{{ $cat->name_bn }}</small>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Main Navigation Links -->
            <nav class="main-menu">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">HOME</a>
                <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') && !request('filter') ? 'active' : '' }}">COLLECTION</a>
                <a href="{{ route('shop', ['filter' => 'new']) }}" class="{{ request('filter') === 'new' ? 'active' : '' }}">NEW ARRIVAL</a>
                <a href="{{ route('shop', ['filter' => 'best']) }}" class="{{ request('filter') === 'best' ? 'active' : '' }}">BEST SELLING</a>
                <a href="{{ route('category.show', 'coin-hobby') }}" class="{{ request()->is('category/coin-hobby') ? 'active' : '' }}">COIN & HOBBY</a>
                <a href="{{ route('tracking') }}" class="{{ request()->routeIs('tracking') ? 'active' : '' }}">TRACK ORDER</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">ABOUT US</a>
            </nav>

            <!-- Nav Right Hotline -->
            <div class="nav-hotline hide-sm">
                <span>Hotline:</span>
                <a href="tel:+8801946225922"><strong>01946-225922</strong></a>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Navigation Drawer -->
<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-overlay" onclick="closeMobileMenu()"></div>
    <div class="drawer-content">
        <div class="drawer-header">
            <h3>Menu</h3>
            <button type="button" class="drawer-close" onclick="closeMobileMenu()">&times;</button>
        </div>
        <div class="drawer-search">
            <form action="{{ route('shop') }}" method="get">
                <input type="text" name="q" placeholder="Search products...">
                <button type="submit">🔍</button>
            </form>
        </div>
        <div class="drawer-links">
            <div class="drawer-title">Navigation</div>
            <a href="{{ route('home') }}">🏠 Home</a>
            <a href="{{ route('shop') }}">🛍️ Collection (Shop)</a>
            <a href="{{ route('shop', ['filter' => 'new']) }}">✨ New Arrival</a>
            <a href="{{ route('shop', ['filter' => 'best']) }}">🔥 Best Selling</a>
            <a href="{{ route('category.show', 'coin-hobby') }}">🪙 Coin & Hobby</a>
            <a href="{{ route('tracking') }}">📦 Track Order</a>
            <a href="{{ route('about') }}">ℹ️ About Us</a>
            <a href="{{ route('terms') }}">📜 Terms & Conditions</a>
            <a href="{{ route('payment') }}">💳 Payment Info</a>

            <div class="drawer-title" style="margin-top:20px;">Categories</div>
            @foreach($navCategories as $cat)
                <a href="{{ route('category.show', $cat) }}">{{ $cat->icon }} {{ $cat->name }}</a>
            @endforeach
        </div>
        <div class="drawer-footer">
            <p><strong>Hotline:</strong> 01946-225922</p>
            <p><strong>Email:</strong> info.chinesegoods@gmail.com</p>
        </div>
    </div>
</div>

<!-- Main App Content -->
<main class="site-main">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <span>✕</span> {{ session('error') }}
            </div>
        @endif
    </div>
    @yield('content')
</main>

<!-- Floating Fast Action Contact Buttons -->
<div class="floating-actions">
    <a href="https://wa.me/8801946225922?text=Hello%20Chinese%20Goods%20BD,%20I%20want%20to%20order" 
       target="_blank" 
       rel="noreferrer" 
       class="float-btn float-whatsapp" 
       title="Chat on WhatsApp">
        <svg viewBox="0 0 32 32" width="28" height="28" fill="#fff">
            <path d="M16 2a13.9 13.9 0 0 0-12 21L2 30l7.2-1.9A14 14 0 1 0 16 2zm0 25.6c-2.2 0-4.3-.6-6.1-1.7l-.4-.3-4.3 1.1 1.2-4.2-.3-.5A11.6 11.6 0 1 1 16 27.6zm6.4-8.7c-.3-.2-2-1-2.3-1.1-.3-.1-.6-.2-.8.2s-.9 1.1-1.1 1.3c-.2.2-.4.3-.8.1a9.8 9.8 0 0 1-5.1-4.5c-.2-.4 0-.6.2-.8.2-.2.4-.4.5-.7.2-.2.2-.4.3-.6.1-.2 0-.4 0-.6s-.8-2-1.1-2.7c-.3-.7-.6-.6-.8-.6h-.7c-.2 0-.7.1-1.1.5-.4.4-1.5 1.5-1.5 3.6s1.5 4.2 1.7 4.5c.2.3 3 4.6 7.3 6.4 1 .4 1.8.7 2.4.9 1 .3 2 .3 2.7.2.8-.1 2.5-1 2.8-2 .4-.9.4-1.8.3-2-.1-.1-.4-.2-.7-.3z"/>
        </svg>
        <span class="float-tooltip">WhatsApp অর্ডার</span>
    </a>
    <a href="tel:+8801946225922" class="float-btn float-call" title="Call Now">
        <span style="font-size:22px;">📞</span>
        <span class="float-tooltip">সরাসরি কল করুন</span>
    </a>
</div>

<!-- Footer -->
<footer class="site-footer">
    <div class="footer-top">
        <div class="container footer-grid">
            <div class="footer-col col-brand">
                <div class="footer-logo">
                    <img src="https://chinesegoodsbd.com/wp-content/uploads/2025/11/Logo-File-16.png" 
                         onerror="this.onerror=null; this.src='https://chinesegoodsbd.com/wp-content/uploads/2025/11/Logo-File-14-e1762339185865.png';" 
                         alt="Chinese Goods BD" 
                         style="max-width:180px;height:auto;margin-bottom:12px;">
                </div>
                <p class="footer-license"><strong>Trade License No:</strong> 20258514963000011</p>
                <p class="footer-addr">📍 Khamar mor-2021, Nesco (PDB) Opposite, College Rd, Lalbagh Rangpur -5402</p>
                <p class="footer-phone">📞 <strong>+8801946225922</strong></p>
                <p class="footer-mail">✉ info.chinesegoods@gmail.com</p>
            </div>

            <div class="footer-col">
                <h4 class="footer-heading">Company</h4>
                <ul class="footer-menu">
                    <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('payment') }}">Payment</a></li>
                    <li><a href="{{ route('tracking') }}">Order Tracking</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 class="footer-heading">My Account</h4>
                <ul class="footer-menu">
                    <li><a href="{{ route('account') }}">My Account</a></li>
                    <li><a href="{{ route('shop') }}">My Shop</a></li>
                    <li><a href="{{ route('cart.index') }}">My Cart</a></li>
                    <li><a href="{{ route('checkout.index') }}">Checkout</a></li>
                    <li><a href="{{ route('wishlist.index') }}">My Wishlist</a></li>
                    <li><a href="{{ route('tracking') }}">Tracking Order</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 class="footer-heading">Stay with Us</h4>
                <p style="font-size:13px;color:#777;margin-bottom:12px;">Follow our official pages & chat directly:</p>
                <div class="footer-socials">
                    <a href="https://facebook.com" target="_blank" rel="noreferrer" class="soc-icon soc-fb" title="Facebook">f</a>
                    <a href="https://wa.me/8801946225922" target="_blank" rel="noreferrer" class="soc-icon soc-wa" title="WhatsApp">W</a>
                    <a href="https://tiktok.com" target="_blank" rel="noreferrer" class="soc-icon soc-tt" title="TikTok">♪</a>
                    <a href="https://instagram.com" target="_blank" rel="noreferrer" class="soc-icon soc-ig" title="Instagram">ig</a>
                    <a href="https://youtube.com" target="_blank" rel="noreferrer" class="soc-icon soc-yt" title="YouTube">▶</a>
                </div>

                <h4 class="footer-heading" style="margin-top:20px;">Payment Methods</h4>
                <div class="payment-badges">
                    <span class="pay-tag pay-cod">Cash on Delivery</span>
                    <span class="pay-tag pay-bkash">bKash</span>
                    <span class="pay-tag pay-nagad">Nagad</span>
                    <span class="pay-tag pay-rocket">Rocket</span>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container footer-bottom-inner">
            <p>Chinese Goods &copy; {{ date('Y') }} by All Rights Reserved. (Clone built for practice)</p>
            <div class="footer-secure-text">🔒 100% Safe & Secure Cash on Delivery In Bangladesh</div>
        </div>
    </div>
</footer>

<!-- Mobile Bottom Sticky Navigation Bar -->
<nav class="mobile-bottom-bar">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
        <span class="icon">🏠</span>
        <span class="label">Home</span>
    </a>
    <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">
        <span class="icon">🛍️</span>
        <span class="label">Shop</span>
    </a>
    <a href="{{ route('wishlist.index') }}" class="{{ request()->routeIs('wishlist.*') ? 'active' : '' }}">
        <span class="icon">♡</span>
        @if($wishlistCount > 0)<span class="badge">{{ $wishlistCount }}</span>@endif
        <span class="label">Wishlist</span>
    </a>
    <a href="{{ route('cart.index') }}" class="{{ request()->routeIs('cart.*') ? 'active' : '' }}">
        <span class="icon">👜</span>
        <span class="badge">{{ $cartCount }}</span>
        <span class="label">Cart</span>
    </a>
    <a href="{{ auth()->check() ? route('account') : route('login') }}" class="{{ request()->routeIs('account') || request()->routeIs('login') ? 'active' : '' }}" @guest onclick="openAuthModal(event, 'login')" @endguest>
        <span class="icon">👤</span>
        <span class="label">Account</span>
    </a>
</nav>

<!-- Interactive Auth Modal Popup (Sign In / Register) -->
@guest
<div class="auth-modal-overlay" id="authModal" onclick="handleAuthModalClick(event)">
    <div class="auth-modal-box" onclick="event.stopPropagation()">
        <button type="button" class="auth-modal-close" onclick="closeAuthModal()" aria-label="Close modal">&times;</button>
        <div class="auth-header" style="padding: 22px 20px 18px;">
            <div class="auth-header-emblem" style="width:46px;height:46px;font-size:22px;margin-bottom:8px;">👤</div>
            <h2 id="authModalTitle" style="font-size:20px;font-weight:800;margin-bottom:4px;">লগইন করুন</h2>
            <p id="authModalDesc" style="font-size:12px;opacity:0.9;">Chinese Goods BD-এ স্বাগতম</p>
        </div>

        <div class="auth-modal-tabs">
            <button type="button" class="auth-modal-tab active" id="tabLoginBtn" onclick="switchAuthTab('login')">লগইন (Sign In)</button>
            <button type="button" class="auth-modal-tab" id="tabRegisterBtn" onclick="switchAuthTab('register')">রেজিস্ট্রেশন (Register)</button>
        </div>

        <div class="auth-body" style="padding: 22px 24px 24px;">
            <!-- Modal Login Form -->
            <form method="post" action="{{ route('login') }}" id="modalLoginForm">
                @csrf
                <div class="auth-field">
                    <label for="modalLoginEmail">ইমেইল ঠিকানা</label>
                    <div class="auth-input-group">
                        <span class="auth-icon">✉️</span>
                        <input type="email" id="modalLoginEmail" name="email" placeholder="example@email.com" required autocomplete="email">
                    </div>
                </div>

                <div class="auth-field">
                    <label for="modalLoginPassword">পাসওয়ার্ড</label>
                    <div class="auth-input-group">
                        <span class="auth-icon">🔒</span>
                        <input type="password" id="modalLoginPassword" name="password" placeholder="••••••••" required autocomplete="current-password">
                        <button type="button" class="auth-toggle-pwd" onclick="togglePasswordVisibility('modalLoginPassword', this)" aria-label="Toggle password">👁️</button>
                    </div>
                </div>

                <div class="auth-options">
                    <label class="auth-remember-label">
                        <input type="checkbox" name="remember" value="1">
                        <span>আমাকে মনে রাখুন</span>
                    </label>
                    <a href="{{ route('tracking') }}" class="auth-help-link">অর্ডার ট্র্যাকিং</a>
                </div>

                <button type="submit" class="btn-auth-submit">
                    <span>লগইন করুন (Sign In)</span>
                    <span>➔</span>
                </button>

                <div class="auth-demo-badge" style="margin-top:14px;">
                    <div>
                        <span style="font-weight:700;display:block;">⚡ অ্যাডমিন ডেমো একাউন্ট:</span>
                        <code>admin@chinesegoodsbd.test</code>
                    </div>
                    <button type="button" class="btn-quick-fill" onclick="fillAdminCredentials('modalLoginEmail', 'modalLoginPassword')">Auto Fill</button>
                </div>
            </form>

            <!-- Modal Register Form -->
            <form method="post" action="{{ route('register') }}" id="modalRegisterForm" style="display:none;">
                @csrf
                <div class="auth-field">
                    <label for="modalRegName">আপনার পুরো নাম</label>
                    <div class="auth-input-group">
                        <span class="auth-icon">👤</span>
                        <input type="text" id="modalRegName" name="name" placeholder="আপনার নাম লিখুন" required autocomplete="name">
                    </div>
                </div>

                <div class="auth-field">
                    <label for="modalRegEmail">ইমেইল ঠিকানা</label>
                    <div class="auth-input-group">
                        <span class="auth-icon">✉️</span>
                        <input type="email" id="modalRegEmail" name="email" placeholder="example@email.com" required autocomplete="email">
                    </div>
                </div>

                <div class="auth-field">
                    <label for="modalRegPassword">পাসওয়ার্ড</label>
                    <div class="auth-input-group">
                        <span class="auth-icon">🔒</span>
                        <input type="password" id="modalRegPassword" name="password" placeholder="কমপক্ষে ৬ ডিজিটের পাসওয়ার্ড" required autocomplete="new-password">
                        <button type="button" class="auth-toggle-pwd" onclick="togglePasswordVisibility('modalRegPassword', this)" aria-label="Toggle password">👁️</button>
                    </div>
                </div>

                <div class="auth-field">
                    <label for="modalRegConfirmPassword">পাসওয়ার্ড নিশ্চিত করুন</label>
                    <div class="auth-input-group">
                        <span class="auth-icon">🔒</span>
                        <input type="password" id="modalRegConfirmPassword" name="password_confirmation" placeholder="পাসওয়ার্ডটি আবার লিখুন" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="btn-auth-submit" style="margin-top:10px;">
                    <span>রেজিস্ট্রেশন সম্পন্ন করুন</span>
                    <span>➔</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endguest

<script>
function toggleDeptMenu() {
    var list = document.getElementById('deptList');
    var trigger = document.querySelector('.dept-trigger');
    if (list) {
        var isOpen = list.classList.toggle('active-show');
        if (trigger) {
            trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        }
    }
}
document.addEventListener('click', function(e) {
    var dropdown = document.getElementById('deptDropdown');
    var list = document.getElementById('deptList');
    var trigger = document.querySelector('.dept-trigger');
    if (dropdown && list && !dropdown.contains(e.target)) {
        list.classList.remove('active-show');
        if (trigger) {
            trigger.setAttribute('aria-expanded', 'false');
        }
    }
});
function openMobileMenu() {
    var drawer = document.getElementById('mobileDrawer');
    if (drawer) drawer.classList.add('open');
}
function closeMobileMenu() {
    var drawer = document.getElementById('mobileDrawer');
    if (drawer) drawer.classList.remove('open');
}

/* Auth Modal Functions */
function openAuthModal(e, tab) {
    if (e && !e.ctrlKey && !e.metaKey && !e.shiftKey) {
        e.preventDefault();
    }
    var modal = document.getElementById('authModal');
    if (modal) {
        modal.classList.add('open');
        switchAuthTab(tab || 'login');
    } else {
        window.location.href = "{{ route('login') }}";
    }
}
function closeAuthModal() {
    var modal = document.getElementById('authModal');
    if (modal) modal.classList.remove('open');
}
function handleAuthModalClick(e) {
    if (e.target.id === 'authModal') {
        closeAuthModal();
    }
}
function switchAuthTab(tab) {
    var loginForm = document.getElementById('modalLoginForm');
    var regForm = document.getElementById('modalRegisterForm');
    var tabLoginBtn = document.getElementById('tabLoginBtn');
    var tabRegBtn = document.getElementById('tabRegisterBtn');
    var title = document.getElementById('authModalTitle');
    var desc = document.getElementById('authModalDesc');

    if (tab === 'register') {
        if (loginForm) loginForm.style.display = 'none';
        if (regForm) regForm.style.display = 'block';
        if (tabLoginBtn) tabLoginBtn.classList.remove('active');
        if (tabRegBtn) tabRegBtn.classList.add('active');
        if (title) title.textContent = 'নতুন অ্যাকাউন্ট তৈরি করুন';
        if (desc) desc.textContent = 'নিরাপদ শপিং এর জন্য রেজিস্টার করুন';
        var firstInput = document.getElementById('modalRegName');
        if (firstInput) setTimeout(function(){ firstInput.focus(); }, 80);
    } else {
        if (regForm) regForm.style.display = 'none';
        if (loginForm) loginForm.style.display = 'block';
        if (tabRegBtn) tabRegBtn.classList.remove('active');
        if (tabLoginBtn) tabLoginBtn.classList.add('active');
        if (title) title.textContent = 'লগইন করুন';
        if (desc) desc.textContent = 'Chinese Goods BD-এ স্বাগতম';
        var firstInput = document.getElementById('modalLoginEmail');
        if (firstInput) setTimeout(function(){ firstInput.focus(); }, 80);
    }
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeAuthModal();
    }
});
function togglePasswordVisibility(inputId, btn) {
    var input = document.getElementById(inputId);
    if (!input) return;
    if (input.type === 'password') {
        input.type = 'text';
        if (btn) btn.textContent = '🙈';
    } else {
        input.type = 'password';
        if (btn) btn.textContent = '👁️';
    }
}
function fillAdminCredentials(emailId, passId) {
    var emailInput = document.getElementById(emailId);
    var passInput = document.getElementById(passId);
    if (emailInput && passInput) {
        emailInput.value = 'admin@chinesegoodsbd.test';
        passInput.value = 'password';
        emailInput.focus();
    }
}
</script>
@yield('scripts')
</body>
</html>
