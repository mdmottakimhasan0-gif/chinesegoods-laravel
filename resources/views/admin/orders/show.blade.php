@extends('admin.layout')

@section('title', 'Order Details #' . $order->order_no)

@section('content')
<div class="admin-card" style="max-width:850px;margin:0 auto;">
    <div class="admin-card-header">
        <div>
            <h3>অর্ডার ইনভয়েস: #{{ $order->order_no }}</h3>
            <span style="font-size:12px;color:#6b7280;">অর্ডারের সময়: {{ $order->created_at->format('d F Y, h:i A') }}</span>
        </div>
        <div style="display:flex;gap:8px;">
            <button onclick="window.print()" class="btn-admin-outline">🖨️ প্রিন্ট করুন</button>
            <a href="{{ route('admin.orders.index') }}" class="btn-admin-outline">← তালিকায় ফিরুন</a>
        </div>
    </div>

    <div style="padding:24px;">
        <!-- Status & Update Bar -->
        <div style="display:flex;justify-content:space-between;align-items:center;background:#f9fafb;padding:16px;border-radius:8px;border:1px solid #e5e7eb;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
            <div>
                <span style="font-size:13px;color:#4b5563;">বর্তমান স্ট্যাটাস:</span>
                <span class="status-badge {{ $order->status }}" style="margin-left:6px;font-size:13px;">{{ ucfirst($order->status) }}</span>
            </div>

            <form method="post" action="{{ route('admin.orders.status', $order) }}" style="display:flex;gap:8px;align-items:center;">
                @csrf
                <label style="font-size:13px;font-weight:600;">স্ট্যাটাস পরিবর্তন:</label>
                <select name="status" class="admin-select" style="width:140px;padding:6px 10px;">
                    <option value="pending" @selected($order->status === 'pending')>⏳ Pending</option>
                    <option value="processing" @selected($order->status === 'processing')>⚙️ Processing</option>
                    <option value="shipped" @selected($order->status === 'shipped')>🚚 Shipped</option>
                    <option value="delivered" @selected($order->status === 'delivered')>✓ Delivered</option>
                    <option value="cancelled" @selected($order->status === 'cancelled')>✕ Cancelled</option>
                </select>
                <button type="submit" class="btn-admin-orange" style="padding:7px 14px;">আপডেট</button>
            </form>
        </div>

        <!-- Customer & Delivery Info Grid -->
        <div class="form-grid-2" style="margin-bottom:28px;">
            <div style="background:#fdf4fb;border:1px solid #fbcfe8;padding:18px;border-radius:8px;">
                <h4 style="color:#831843;margin-bottom:10px;font-size:15px;">গ্রাহকের বিবরণ (Customer Info)</h4>
                <p style="margin-bottom:4px;"><strong>নাম:</strong> {{ $order->name }}</p>
                <p style="margin-bottom:4px;"><strong>মোবাইল:</strong> <a href="tel:{{ $order->phone }}" style="color:var(--admin-pink-dark);font-weight:700;">{{ $order->phone }}</a></p>
                @if($order->email)<p style="margin-bottom:4px;"><strong>ইমেইল:</strong> {{ $order->email }}</p>@endif
                <p style="margin-bottom:4px;"><strong>পেমেন্ট মাধ্যম:</strong> {{ strtoupper($order->payment_method) }}</p>
            </div>

            <div style="background:#f0fdf4;border:1px solid #bbf7d0;padding:18px;border-radius:8px;">
                <h4 style="color:#166534;margin-bottom:10px;font-size:15px;">ডেলিভারি ঠিকানা (Shipping Info)</h4>
                <p style="margin-bottom:4px;"><strong>ঠিকানা:</strong> {{ $order->address }}</p>
                <p style="margin-bottom:4px;"><strong>শহর / জেলা:</strong> {{ $order->city }}</p>
                @if($order->notes)
                    <p style="margin-top:8px;font-size:13px;color:#047857;background:#dcfce7;padding:6px;border-radius:4px;">
                        <strong>বিশেষ নোট:</strong> {{ $order->notes }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Ordered Items Table -->
        <h4 style="margin-bottom:12px;font-size:15px;color:#111827;">অর্ডারকৃত পণ্যসমূহ:</h4>
        <table class="admin-table" style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;margin-bottom:20px;">
            <thead>
                <tr>
                    <th>পণ্য (Item Name)</th>
                    <th>ভ্যারিয়েন্ট / কালার</th>
                    <th style="text-align:center;">পরিমাণ (Qty)</th>
                    <th style="text-align:right;">একক মূল্য</th>
                    <th style="text-align:right;">মোট টাকা</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td><strong>{{ $item->product_name }}</strong></td>
                        <td>{{ $item->color ?: 'Default' }}</td>
                        <td style="text-align:center;">{{ $item->qty }}</td>
                        <td style="text-align:right;">৳ {{ number_format($item->price, 0) }}</td>
                        <td style="text-align:right;"><strong>৳ {{ number_format($item->price * $item->qty, 0) }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals Calculation -->
        <div style="max-width:320px;margin-left:auto;background:#f9fafb;padding:16px;border-radius:8px;border:1px solid #e5e7eb;">
            <div style="display:flex;justify-content:space-between;margin-bottom:6px;font-size:14px;">
                <span>মোট পণ্যের মূল্য:</span>
                <span>৳ {{ number_format($order->subtotal, 0) }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:14px;">
                <span>ডেলিভারি চার্জ:</span>
                <span>৳ {{ number_format($order->shipping, 0) }}</span>
            </div>
            <hr style="border:0;border-top:1px dashed #d1d5db;margin:8px 0;">
            <div style="display:flex;justify-content:space-between;font-size:18px;font-weight:800;color:var(--admin-orange);">
                <span>সর্বমোট (Total):</span>
                <span>৳ {{ number_format($order->total, 0) }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
