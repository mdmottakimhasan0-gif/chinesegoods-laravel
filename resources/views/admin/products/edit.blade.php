@extends('admin.layout')

@section('title', 'Edit Product: ' . $product->name)

@section('content')
<div class="admin-card" style="max-width:900px;margin:0 auto;">
    <div class="admin-card-header">
        <h3>প্রোডাক্ট এডিট করুন: {{ $product->name }}</h3>
        <a href="{{ route('admin.products.index') }}" class="btn-admin-outline">← তালিকায় ফিরে যান</a>
    </div>

    @if($errors->any())
        <div class="admin-alert admin-alert-error" style="margin:20px 20px 0;">
            <ul style="margin-left:16px;">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('admin.products.update', $product) }}" style="padding:24px;">
        @csrf
        @method('PUT')

        <div class="admin-form-group">
            <label class="admin-label">পণ্যের পুরো নাম (Product Name) <span style="color:#ef4444;">*</span></label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="admin-input">
        </div>

        <div class="form-grid-2">
            <div class="admin-form-group">
                <label class="admin-label">বিক্রয় মূল্য (Selling Price - ৳) <span style="color:#ef4444;">*</span></label>
                <input type="number" name="price" value="{{ old('price', (int)$product->price) }}" required min="0" step="1" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-label">আগের মূল্য / ডিসকাউন্টের পূর্বে মূল্য (Compare Price - ৳)</label>
                <input type="number" name="compare_price" value="{{ old('compare_price', (int)$product->compare_price) }}" min="0" step="1" class="admin-input">
            </div>
        </div>

        <div class="form-grid-2">
            <div class="admin-form-group">
                <label class="admin-label">স্টক পরিমাণ (Stock Quantity) <span style="color:#ef4444;">*</span></label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-label">SKU কোড</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="admin-input">
            </div>
        </div>

        <div class="admin-form-group">
            <label class="admin-label">পণ্যের ছবি লিংক (Image URL) <span style="color:#ef4444;">*</span></label>
            <input type="url" name="image" value="{{ old('image', $product->image) }}" required class="admin-input" oninput="document.getElementById('imgPreview').src=this.value">
            <div style="margin-top:8px;display:flex;align-items:center;gap:12px;">
                <img id="imgPreview" src="{{ old('image', $product->image) }}" alt="Preview" style="width:70px;height:70px;border-radius:6px;object-fit:cover;border:1px solid #e5e7eb;">
                <small style="color:#6b7280;font-size:12px;">ছবির সরাসরি লিঙ্ক দিন।</small>
            </div>
        </div>

        <div class="admin-form-group">
            <label class="admin-label">ক্যাটাগরি নির্বাচন করুন (Categories)</label>
            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(200px, 1fr));gap:8px;background:#f9fafb;padding:14px;border-radius:6px;border:1px solid #e5e7eb;">
                @php
                    $selectedCats = old('categories', $product->categories->pluck('id')->toArray());
                @endphp
                @foreach($categories as $category)
                    <label style="display:flex;align-items:center;gap:8px;font-size:13px;cursor:pointer;">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, $selectedCats) ? 'checked' : '' }}>
                        <span>{{ $category->icon }} {{ $category->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="admin-form-group">
            <label class="admin-label">কালার / ভ্যারিয়েন্ট (Colors / Options - কমা দিয়ে লিখুন)</label>
            <input type="text" name="colors" value="{{ old('colors', is_array($product->colors) ? implode(', ', $product->colors) : '') }}" placeholder="যেমন: Black, Blue, Green, Red" class="admin-input">
        </div>

        <div class="admin-form-group">
            <label class="admin-label">পণ্যের বিস্তারিত বিবরণ (Description & Specifications)</label>
            <textarea name="description" rows="5" class="admin-textarea">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="admin-form-group" style="background:#fdf2f8;padding:14px;border-radius:6px;border:1px solid #fbcfe8;">
            <label class="admin-label" style="color:#831843;">স্পেশাল ব্যাজ ও ফিচার সেটিংস:</label>
            <div style="display:flex;gap:20px;flex-wrap:wrap;margin-top:6px;">
                <label style="display:flex;align-items:center;gap:6px;font-size:13px;font-weight:600;cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                    <span>⭐ Featured Product</span>
                </label>
                <label style="display:flex;align-items:center;gap:6px;font-size:13px;font-weight:600;cursor:pointer;">
                    <input type="checkbox" name="is_bestseller" value="1" {{ old('is_bestseller', $product->is_bestseller) ? 'checked' : '' }}>
                    <span>🔥 Best Selling</span>
                </label>
                <label style="display:flex;align-items:center;gap:6px;font-size:13px;font-weight:600;cursor:pointer;">
                    <input type="checkbox" name="is_new" value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }}>
                    <span>✨ New Arrival</span>
                </label>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:24px;">
            <button type="submit" class="btn-admin-primary" style="padding:12px 28px;font-size:15px;">
                ✓ পরিবর্তন সংরক্ষণ করুন (Update Product)
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-admin-outline" style="padding:12px 20px;">
                বাতিল
            </a>
        </div>
    </form>
</div>
@endsection
