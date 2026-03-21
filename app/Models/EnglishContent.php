<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnglishContent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'section',
        'title',
        'content',
        'slug',
        'is_published',
        'sort_order',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
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
