<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name', 'slug', 'sku', 'short_description', 'description',
    'price', 'compare_price', 'image', 'gallery', 'colors', 'stock',
    'is_featured', 'is_bestseller', 'is_new', 'rating', 'reviews_count',
])]
class Product extends Model
{
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'compare_price' => 'decimal:2',
            'gallery' => 'array',
            'colors' => 'array',
            'is_featured' => 'boolean',
            'is_bestseller' => 'boolean',
            'is_new' => 'boolean',
        ];
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function discountPercent(): ?int
    {
        if (! $this->compare_price || $this->compare_price <= $this->price) {
            return null;
        }

        return (int) round((($this->compare_price - $this->price) / $this->compare_price) * 100);
    }

    public function isOnSale(): bool
    {
        return $this->discountPercent() !== null;
    }

    public function formattedPrice(): string
    {
        return '৳ '.number_format((float) $this->price, 2);
    }

    public function formattedComparePrice(): ?string
    {
        if (! $this->compare_price) {
            return null;
        }

        return '৳ '.number_format((float) $this->compare_price, 2);
    }

    public function hasOptions(): bool
    {
        return ! empty($this->colors);
    }
}
