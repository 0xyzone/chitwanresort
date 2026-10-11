<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Activity extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'price_per_person' => 'decimal:2',
            'gallery' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Activity $activity): void {
            if (blank($activity->slug)) {
                $activity->slug = Str::slug($activity->title);
            }
        });
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->featured_image && (str_starts_with($this->featured_image, 'http://') || str_starts_with($this->featured_image, 'https://'))) {
            return $this->featured_image;
        }

        if ($this->featured_image) {
            return asset('storage/'.$this->featured_image);
        }

        return 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_active', true)->where('is_featured', true)->orderBy('sort_order');
    }
}
