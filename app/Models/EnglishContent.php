<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EnglishContent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'section',
        'title',
        'description',
        'eyebrow',
        'hero_image',
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

    public function items(): HasMany
    {
        return $this->hasMany(EnglishItem::class)->orderBy('sort_order')->orderBy('id');
    }

    public function activeItems(): HasMany
    {
        return $this->items()->where('is_active', true);
    }

    public static function bySlug(string $slug): ?self
    {
        return static::with('activeItems')->where('slug', $slug)->where('is_published', true)->first();
    }

    public static function sectionLabels(): array
    {
        return [
            'home'       => 'Home',
            'about'      => 'About CMAK',
            'cmday'      => 'International CM Day',
            'ipma'       => 'IPMA Korea',
            'news'       => 'CMAK News',
            'membership' => 'Membership',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOfSection($query, $section)
    {
        return $query->where('section', $section);
    }
}
