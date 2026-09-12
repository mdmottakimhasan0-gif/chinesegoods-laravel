@extends('admin.layout')

@section('title', 'Categories Management')

@section('content')
<div class="form-grid-2" style="align-items:flex-start;">
    <!-- Add Category Form -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>নতুন ক্যাটাগরি তৈরি করুন</h3>
        </div>
        <form method="post" action="{{ route('admin.categories.store') }}" style="padding:20px;">
            @csrf

            <div class="admin-form-group">
                <label class="admin-label">ক্যাটাগরির নাম (English Name) <span style="color:#ef4444;">*</span></label>
                <input type="text" name="name" required placeholder="যেমন: Smart Watch" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-label">বাংলা নাম (Bengali Name)</label>
                <input type="text" name="name_bn" placeholder="যেমন: স্মার্ট ওয়াচ" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-label">আইকন / ইমোজি (Icon)</label>
                <input type="text" name="icon" value="🛍️" placeholder="যেমন: ⌚, 📱, 🎁" class="admin-input">
            </div>

            <div class="admin-form-group">
                <label class="admin-label">ছবির লিঙ্ক (Image URL - Optional)</label>
                <input type="url" name="image" placeholder="https://..." class="admin-input">
            </div>

            <div class="admin-form-group">
                <label style="display:flex;align-items:center;gap:8px;font-size:13px;font-weight:600;cursor:pointer;">
                    <input type="checkbox" name="is_top" value="1" checked>
                    <span>⭐ টপ ক্যাটাগরি হিসেবে দেখান (Show as Top Category)</span>
                </label>
            </div>

            <button type="submit" class="btn-admin-primary" style="width:100%;margin-top:10px;">
                + ক্যাটাগরি সংরক্ষণ করুন
            </button>
        </form>
    </div>

    <!-- Category List Table -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>সকল ক্যাটাগরি (Total: {{ $categories->count() }})</h3>
        </div>
        <div class="admin-table-wrap" style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>আইকন</th>
                        <th>ক্যাটাগরির নাম</th>
                        <th>বাংলা নাম</th>
                        <th>পণ্য সংখ্যা</th>
                        <th style="text-align:right;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                        <tr>
                            <td style="font-size:22px;text-align:center;">{{ $cat->icon }}</td>
                            <td>
                                <strong>{{ $cat->name }}</strong>
                                <div style="font-size:11px;color:#9ca3af;">slug: {{ $cat->slug }}</div>
                            </td>
                            <td>{{ $cat->name_bn ?: '—' }}</td>
                            <td>
                                <span style="background:#f3f4f6;padding:2px 8px;border-radius:999px;font-size:12px;font-weight:700;">
                                    {{ $cat->products_count }} টি
                                </span>
                            </td>
                            <td style="text-align:right;">
                                <form method="post" action="{{ route('admin.categories.destroy', $cat) }}" style="display:inline;" onsubmit="return confirm('এই ক্যাটাগরিটি মুছে ফেলতে চান?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-admin-danger">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
