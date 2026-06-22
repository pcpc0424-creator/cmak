<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageContent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'menu',
        'page_title',
        'browser_title',
        'category',
        'category_link',
        'content',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public static function bySlug(string $slug): ?self
    {
        return static::where('slug', $slug)->where('is_published', true)->first();
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOfMenu($query, string $menu)
    {
        return $query->where('menu', $menu);
    }
}
