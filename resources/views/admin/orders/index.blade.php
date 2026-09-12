@extends('admin.layout')

@section('title', 'Customer Orders')

@section('content')
<!-- Status Tabs -->
<div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap;">
    <a href="{{ route('admin.orders.index') }}" class="btn-admin-outline {{ !request('status') || request('status') === 'all' ? 'active' : '' }}" style="{{ !request('status') || request('status') === 'all' ? 'background:var(--admin-pink);color:#fff;border-color:var(--admin-pink);font-weight:700;' : '' }}">
        সব অর্ডার ({{ $statusCounts['all'] }})
    </a>
    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="btn-admin-outline" style="{{ request('status') === 'pending' ? 'background:#fef3c7;color:#b45309;border-color:#fcd34d;font-weight:700;' : '' }}">
        ⏳ পেন্ডিং ({{ $statusCounts['pending'] }})
    </a>
    <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="btn-admin-outline" style="{{ request('status') === 'processing' ? 'background:#e0f2fe;color:#0369a1;border-color:#7dd3fc;font-weight:700;' : '' }}">
        ⚙️ প্রসেসিং ({{ $statusCounts['processing'] }})
    </a>
    <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" class="btn-admin-outline" style="{{ request('status') === 'shipped' ? 'background:#ede9fe;color:#6d28d9;border-color:#c4b5fd;font-weight:700;' : '' }}">
        🚚 পাঠানো হয়েছে ({{ $statusCounts['shipped'] }})
    </a>
    <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="btn-admin-outline" style="{{ request('status') === 'delivered' ? 'background:#dcfce7;color:#15803d;border-color:#86efac;font-weight:700;' : '' }}">
        ✓ ডেলিভার্ড ({{ $statusCounts['delivered'] }})
    </a>
    <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" class="btn-admin-outline" style="{{ request('status') === 'cancelled' ? 'background:#fee2e2;color:#b91c1c;border-color:#fca5a5;font-weight:700;' : '' }}">
        ✕ বাতিল ({{ $statusCounts['cancelled'] }})
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <form method="get" action="{{ route('admin.orders.index') }}" style="display:flex;gap:8px;flex-wrap:wrap;flex:1;">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <input type="text" name="q" value="{{ request('q') }}" placeholder="অর্ডার নং, নাম বা ফোন দিয়ে খুঁজুন..." class="admin-input" style="max-width:320px;padding:7px 12px;">
            <button type="submit" class="btn-admin-outline">খুঁজুন</button>
            @if(request('q'))
                <a href="{{ route('admin.orders.index', request()->only('status')) }}" class="btn-admin-outline" style="color:#ef4444;">রিসেট</a>
            @endif
        </form>
    </div>

    <div class="admin-table-wrap" style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>অর্ডার নং</th>
                    <th>তারিখ</th>
                    <th>গ্রাহকের তথ্য</th>
                    <th>অর্ডারকৃত পণ্য</th>
                    <th>মোট মূল্য</th>
                    <th>পেমেন্ট</th>
                    <th>স্ট্যাটাস পরিবর্তন</th>
                    <th style="text-align:right;">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>
                            <strong><a href="{{ route('admin.orders.show', $order) }}" style="color:var(--admin-pink);font-weight:700;">#{{ $order->order_no }}</a></strong>
                        </td>
                        <td>
                            <div style="font-size:13px;">{{ $order->created_at->format('d M Y') }}</div>
                            <div style="font-size:11px;color:#9ca3af;">{{ $order->created_at->format('h:i A') }}</div>
                        </td>
                        <td>
                            <strong>{{ $order->name }}</strong>
                            <div style="color:var(--admin-orange);font-weight:600;font-size:13px;">📞 {{ $order->phone }}</div>
                            <div style="font-size:12px;color:#6b7280;max-width:220px;">📍 {{ Str::limit($order->address, 50) }}</div>
                        </td>
                        <td>
                            <div style="font-size:13px;">
                                @foreach($order->items as $item)
                                    <div>• {{ $item->product_name }} (×{{ $item->qty }})</div>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <strong style="font-size:15px;color:#111827;">৳ {{ number_format($order->total, 0) }}</strong>
                            <div style="font-size:11px;color:#6b7280;">ডেলিভারি: ৳{{ number_format($order->shipping, 0) }}</div>
                        </td>
                        <td>
                            <span style="font-weight:700;font-size:12px;text-transform:uppercase;">{{ $order->payment_method }}</span>
                        </td>
                        <td>
                            <!-- Quick Status Update Form -->
                            <form method="post" action="{{ route('admin.orders.status', $order) }}" style="display:inline;">
                                @csrf
                                <select name="status" class="admin-select" style="padding:4px 8px;font-size:12px;width:120px;font-weight:600;" onchange="this.form.submit()">
                                    <option value="pending" @selected($order->status === 'pending')>⏳ Pending</option>
                                    <option value="processing" @selected($order->status === 'processing')>⚙️ Processing</option>
                                    <option value="shipped" @selected($order->status === 'shipped')>🚚 Shipped</option>
                                    <option value="delivered" @selected($order->status === 'delivered')>✓ Delivered</option>
                                    <option value="cancelled" @selected($order->status === 'cancelled')>✕ Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td style="text-align:right;">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn-admin-outline" style="font-weight:600;">
                                📄 ইনভয়েস
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:40px;color:#9ca3af;">
                            কোনো অর্ডার পাওয়া যায়নি।
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
        <div style="padding:16px 20px;border-top:1px solid var(--admin-border);display:flex;justify-content:center;">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
