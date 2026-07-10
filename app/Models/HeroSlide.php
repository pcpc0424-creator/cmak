<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeroSlide extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'eyebrow',
        'show_eyebrow',
        'title',
        'highlight',
        'title_bold',
        'highlight_bold',
        'image_path',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'show_eyebrow' => 'boolean',
            'title_bold' => 'boolean',
            'highlight_bold' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
