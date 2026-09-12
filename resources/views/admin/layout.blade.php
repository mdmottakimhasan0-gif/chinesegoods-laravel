<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') – Chinese Goods BD</title>
    <link rel="icon" type="image/png" href="https://chinesegoodsbd.com/wp-content/uploads/2025/11/Logo-File-16.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Noto+Sans+Bengali:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-pink: #ce75c4;
            --admin-pink-dark: #b85eae;
            --admin-orange: #d64e00;
            --admin-sidebar: #1e1e2d;
            --admin-sidebar-hover: #27273a;
            --admin-bg: #f4f6f9;
            --admin-card: #ffffff;
            --admin-text: #2c323f;
            --admin-muted: #6c757d;
            --admin-border: #e3e6ec;
            --font-main: "Inter", "Noto Sans Bengali", sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-main); background-color: var(--admin-bg); color: var(--admin-text); line-height: 1.5; }
        a { color: inherit; text-decoration: none; }

        /* Admin App Shell Layout */
        .admin-wrapper { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .admin-sidebar {
            width: 260px;
            background-color: var(--admin-sidebar);
            color: #d1d5db;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: width 0.2s ease;
        }
        .admin-brand {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            background-color: #171722;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .admin-brand-logo {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background-color: var(--admin-pink);
            color: #fff;
            display: grid;
            place-items: center;
            font-weight: 800;
            font-size: 18px;
        }
        .admin-brand-text strong {
            display: block;
            color: #ffffff;
            font-size: 15px;
            letter-spacing: 0.3px;
        }
        .admin-brand-text small {
            color: var(--admin-pink);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .sidebar-menu {
            padding: 16px 10px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }
        .menu-heading {
            font-size: 11px;
            text-transform: uppercase;
            color: #6b7280;
            font-weight: 700;
            padding: 12px 14px 6px;
            letter-spacing: 0.5px;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            color: #9ca3af;
            transition: all 0.15s ease;
        }
        .nav-link:hover, .nav-link.active {
            background-color: var(--admin-sidebar-hover);
            color: #ffffff;
        }
        .nav-link.active {
            background-color: var(--admin-pink);
            color: #ffffff;
            font-weight: 600;
        }
        .nav-icon { font-size: 18px; width: 22px; text-align: center; }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.06);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .btn-visit-store {
            display: block;
            text-align: center;
            background-color: rgba(255,255,255,0.08);
            color: #fff;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            transition: background-color 0.15s ease;
        }
        .btn-visit-store:hover { background-color: var(--admin-orange); }

        /* Main Content Container */
        .admin-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            overflow-x: hidden;
        }

        /* Top Navbar */
        .admin-navbar {
            height: 64px;
            background-color: #ffffff;
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
        }
        .navbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .page-title {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
        }
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .admin-user-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
        }
        .admin-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background-color: var(--admin-pink);
            color: #fff;
            display: grid;
            place-items: center;
            font-weight: 700;
        }

        /* Body Container */
        .admin-body {
            padding: 24px;
            flex: 1;
        }

        /* Flash Messages */
        .admin-alert {
            padding: 12px 18px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .admin-alert-success { background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .admin-alert-error { background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* Cards & Metrics */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }
        .stat-card {
            background-color: #ffffff;
            border: 1px solid var(--admin-border);
            border-radius: 10px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 24px;
        }
        .stat-icon.sales { background-color: #fdf2f8; color: var(--admin-pink-dark); }
        .stat-icon.orders { background-color: #eff6ff; color: #2563eb; }
        .stat-icon.pending { background-color: #fffbeb; color: #d97706; }
        .stat-icon.products { background-color: #ecfdf5; color: #059669; }
        .stat-info span { font-size: 13px; color: var(--admin-muted); display: block; }
        .stat-info strong { font-size: 24px; font-weight: 800; color: #111827; }

        /* Table & Panels */
        .admin-card {
            background-color: #ffffff;
            border: 1px solid var(--admin-border);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            margin-bottom: 24px;
        }
        .admin-card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .admin-card-header h3 { font-size: 16px; font-weight: 700; color: #111827; }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
        }
        .admin-table th {
            background-color: #f9fafb;
            padding: 12px 16px;
            font-weight: 600;
            color: #4b5563;
            border-bottom: 1px solid var(--admin-border);
        }
        .admin-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }
        .admin-table tbody tr:hover { background-color: #fafbfc; }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
        }
        .status-badge.pending { background-color: #fef3c7; color: #b45309; }
        .status-badge.processing { background-color: #e0f2fe; color: #0369a1; }
        .status-badge.shipped { background-color: #ede9fe; color: #6d28d9; }
        .status-badge.delivered { background-color: #dcfce7; color: #15803d; }
        .status-badge.cancelled { background-color: #fee2e2; color: #b91c1c; }

        /* Buttons */
        .btn-admin-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: var(--admin-pink);
            color: #ffffff;
            padding: 9px 18px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.15s ease;
        }
        .btn-admin-primary:hover { background-color: var(--admin-pink-dark); }

        .btn-admin-orange {
            background-color: var(--admin-orange);
            color: #fff;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-admin-orange:hover { background-color: #b84300; }

        .btn-admin-outline {
            background: none;
            border: 1px solid var(--admin-border);
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            color: #374151;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-admin-outline:hover { background-color: #f3f4f6; }

        .btn-admin-danger {
            background: none;
            border: 1px solid #fca5a5;
            color: #dc2626;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
        }
        .btn-admin-danger:hover { background-color: #fee2e2; }

        /* Forms */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }
        .admin-form-group {
            margin-bottom: 18px;
        }
        .admin-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }
        .admin-input, .admin-select, .admin-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--admin-border);
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            font-family: inherit;
            background-color: #ffffff;
        }
        .admin-input:focus, .admin-select:focus, .admin-textarea:focus {
            border-color: var(--admin-pink);
            box-shadow: 0 0 0 3px rgba(206, 117, 196, 0.15);
        }

        /* Responsive Breakpoints */
        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .form-grid-2 { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .admin-wrapper { flex-direction: column; }
            .admin-sidebar { width: 100%; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
    @yield('styles')
</head>
<body>

<div class="admin-wrapper">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <div class="admin-brand-logo">CG</div>
            <div class="admin-brand-text">
                <strong>Chinese Goods BD</strong>
                <small>Admin Panel</small>
            </div>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-heading">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">📊</span>
                <span>Dashboard</span>
            </a>

            <div class="menu-heading">Store Management</div>
            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') && !request()->routeIs('admin.products.create') ? 'active' : '' }}">
                <span class="nav-icon">📦</span>
                <span>All Products</span>
            </a>
            <a href="{{ route('admin.products.create') }}" class="nav-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                <span class="nav-icon">➕</span>
                <span>Add Product</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <span class="nav-icon">🛍️</span>
                <span>Orders</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="nav-icon">📑</span>
                <span>Categories</span>
            </a>

            <div class="menu-heading">External</div>
            <a href="{{ route('home') }}" target="_blank" class="nav-link">
                <span class="nav-icon">🌐</span>
                <span>Visit Store</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('home') }}" target="_blank" class="btn-visit-store">
                ওয়েবসাইটে যান ➔
            </a>
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-admin-outline" style="width:100%;color:#ef4444;border-color:rgba(239,68,68,0.3);">
                    🚪 Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="admin-content">
        <!-- Top Navbar -->
        <header class="admin-navbar">
            <div class="navbar-left">
                <h2 class="page-title">@yield('title', 'Dashboard')</h2>
            </div>
            <div class="navbar-right">
                <a href="{{ route('admin.products.create') }}" class="btn-admin-primary">
                    <span>+ Add Product</span>
                </a>
                <div class="admin-user-pill">
                    <div class="admin-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                </div>
            </div>
        </header>

        <!-- Body -->
        <main class="admin-body">
            @if(session('success'))
                <div class="admin-alert admin-alert-success">
                    <span>✓</span> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="admin-alert admin-alert-error">
                    <span>✕</span> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

@yield('scripts')
</body>
</html>
