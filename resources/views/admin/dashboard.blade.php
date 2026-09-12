@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon sales">৳</div>
        <div class="stat-info">
            <span>মোট বিক্রি (Total Sales)</span>
            <strong>৳ {{ number_format($totalSales, 0) }}</strong>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orders">🛍️</div>
        <div class="stat-info">
            <span>মোট অর্ডার (Total Orders)</span>
            <strong>{{ $totalOrders }}</strong>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon pending">⏳</div>
        <div class="stat-info">
            <span>পেন্ডিং অর্ডার (Pending)</span>
            <strong style="color:#d97706;">{{ $pendingOrders }}</strong>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon products">📦</div>
        <div class="stat-info">
            <span>মোট প্রোডাক্ট (Products)</span>
            <strong>{{ $totalProducts }}</strong>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3>সাম্প্রতিক অর্ডারসমূহ (Recent Orders)</h3>
        <a href="{{ route('admin.orders.index') }}" class="btn-admin-outline">সব অর্ডার দেখুন ➔</a>
    </div>
    <div class="admin-table-wrap" style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>অর্ডার নং</th>
                    <th>গ্রাহক (Customer)</th>
                    <th>ফোন নম্বর</th>
                    <th>পদ্ধতি</th>
                    <th>মোট টাকা</th>
                    <th>স্ট্যাটাস</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td>
                            <strong><a href="{{ route('admin.orders.show', $order) }}" style="color:var(--admin-pink);font-weight:700;">#{{ $order->order_no }}</a></strong>
                            <div style="font-size:11px;color:#9ca3af;">{{ $order->created_at->diffForHumans() }}</div>
                        </td>
                        <td>
                            <strong>{{ $order->name }}</strong>
                            <div style="font-size:12px;color:#6b7280;">{{ Str::limit($order->address, 30) }}</div>
                        </td>
                        <td>{{ $order->phone }}</td>
                        <td>
                            <span style="font-size:12px;font-weight:700;text-transform:uppercase;">{{ $order->payment_method }}</span>
                        </td>
                        <td>
                            <strong>৳ {{ number_format($order->total, 0) }}</strong>
                        </td>
                        <td>
                            <span class="status-badge {{ $order->status }}">{{ $order->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn-admin-outline">বিস্তারিত</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:32px;color:#9ca3af;">
                            এখনও কোনো অর্ডার আসেনি।
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Products Overview -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3>সর্বশেষ যুক্ত পণ্য (Recent Products)</h3>
        <a href="{{ route('admin.products.create') }}" class="btn-admin-primary">+ নতুন পণ্য যোগ করুন</a>
    </div>
    <div class="admin-table-wrap" style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ছবি</th>
                    <th>পণ্যের নাম</th>
                    <th>ক্যাটাগরি</th>
                    <th>মূল্য</th>
                    <th>স্টক</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentProducts as $prod)
                    <tr>
                        <td>
                            <img src="{{ $prod->image }}" alt="" style="width:44px;height:44px;border-radius:6px;object-fit:cover;border:1px solid #e5e7eb;">
                        </td>
                        <td>
                            <strong><a href="{{ route('product.show', $prod) }}" target="_blank">{{ $prod->name }}</a></strong>
                            <div style="font-size:12px;color:#9ca3af;">SKU: {{ $prod->sku }}</div>
                        </td>
                        <td>{{ $prod->categories->pluck('name')->join(', ') ?: 'General' }}</td>
                        <td>
                            <strong>৳ {{ number_format($prod->price, 0) }}</strong>
                            @if($prod->compare_price)
                                <del style="color:#9ca3af;font-size:12px;margin-left:4px;">৳ {{ number_format($prod->compare_price, 0) }}</del>
                            @endif
                        </td>
                        <td>
                            <span style="font-weight:700;color:{{ $prod->stock > 5 ? '#059669' : '#dc2626' }};">{{ $prod->stock }} pcs</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $prod) }}" class="btn-admin-outline" style="margin-right:6px;">Edit</a>
                            <a href="{{ route('product.show', $prod) }}" target="_blank" class="btn-admin-outline">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
