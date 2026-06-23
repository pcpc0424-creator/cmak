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

    /**
     * 이 페이지의 공개(프론트) URL. 메뉴별로 라우트가 다르다.
     */
    public function publicUrl(): string
    {
        return match ($this->menu) {
            '약관/정책' => url('/register'),
            '협회소개' => url('/intro/organization' . match ($this->slug) {
                'org-executives' => '/executives',
                'org-branches'   => '/branches',
                'org-committees' => '/committees',
                default          => '',
            }),
            default => url('/business/' . $this->slug),
        };
    }
}
