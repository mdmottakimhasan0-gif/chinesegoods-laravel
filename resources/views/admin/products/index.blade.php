@extends('admin.layout')

@section('title', 'All Products – Chinese Goods BD')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;flex:1;">
            <h3>প্রোডাক্ট তালিকা (Total: {{ $products->total() }})</h3>
            
            <!-- Search & Filter Form -->
            <form method="get" action="{{ route('admin.products.index') }}" style="display:flex;gap:8px;flex-wrap:wrap;">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name or SKU..." class="admin-input" style="width:200px;padding:7px 12px;">
                <select name="category" class="admin-select" style="width:160px;padding:7px 10px;" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-admin-outline">খুঁজুন</button>
                @if(request('q') || request('category'))
                    <a href="{{ route('admin.products.index') }}" class="btn-admin-outline" style="color:#ef4444;">রিসেট</a>
                @endif
            </form>
        </div>

        <a href="{{ route('admin.products.create') }}" class="btn-admin-primary">
            <span>+ নতুন প্রোডাক্ট যোগ করুন</span>
        </a>
    </div>

    <div class="admin-table-wrap" style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:60px;">ছবি</th>
                    <th>পণ্যের নাম ও SKU</th>
                    <th>ক্যাটাগরি</th>
                    <th>মূল্য (Price)</th>
                    <th>স্টক</th>
                    <th>ব্যাজ</th>
                    <th style="text-align:right;">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            <img src="{{ $product->image }}" alt="" style="width:50px;height:50px;border-radius:6px;object-fit:cover;border:1px solid #e5e7eb;">
                        </td>
                        <td>
                            <strong><a href="{{ route('product.show', $product) }}" target="_blank" style="color:#111827;">{{ $product->name }}</a></strong>
                            <div style="font-size:12px;color:#6b7280;">SKU: <code style="background:#f3f4f6;padding:1px 5px;border-radius:3px;">{{ $product->sku }}</code></div>
                        </td>
                        <td>
                            @foreach($product->categories as $c)
                                <span style="display:inline-block;background:#f3f4f6;padding:2px 7px;border-radius:4px;font-size:11px;margin:2px 0;">{{ $c->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <strong style="color:var(--admin-orange);">৳ {{ number_format($product->price, 0) }}</strong>
                            @if($product->compare_price)
                                <del style="color:#9ca3af;font-size:12px;margin-left:4px;">৳ {{ number_format($product->compare_price, 0) }}</del>
                            @endif
                        </td>
                        <td>
                            <span style="font-weight:700;color:{{ $product->stock > 5 ? '#059669' : '#dc2626' }};">
                                {{ $product->stock }} টি
                            </span>
                        </td>
                        <td>
                            @if($product->discountPercent())
                                <span style="background:#fef2f2;color:#dc2626;padding:2px 6px;border-radius:4px;font-size:11px;font-weight:700;">-{{ $product->discountPercent() }}%</span>
                            @endif
                            @if($product->is_bestseller)
                                <span style="background:#fef3c7;color:#b45309;padding:2px 6px;border-radius:4px;font-size:11px;font-weight:700;">BEST</span>
                            @endif
                            @if($product->is_featured)
                                <span style="background:#fdf2f8;color:var(--admin-pink-dark);padding:2px 6px;border-radius:4px;font-size:11px;font-weight:700;">HOT</span>
                            @endif
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn-admin-outline" style="margin-right:4px;">✏️ Edit</a>
                            <form method="post" action="{{ route('admin.products.destroy', $product) }}" style="display:inline;" onsubmit="return confirm('আপনি কি নিশ্চিতভাবে এই প্রোডাক্টটি ডিলিট করতে চান?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-admin-danger">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:40px;color:#9ca3af;">
                            কোনো প্রোডাক্ট পাওয়া যায়নি। <a href="{{ route('admin.products.create') }}" style="color:var(--admin-pink);font-weight:600;">নতুন প্রোডাক্ট যোগ করুন</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div style="padding:16px 20px;border-top:1px solid var(--admin-border);display:flex;justify-content:center;">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
