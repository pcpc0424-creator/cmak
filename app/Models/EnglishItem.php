<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnglishItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'english_content_id',
        'type',
        'sort_order',
        'title',
        'subtitle',
        'description',
        'image_path',
        'tag',
        'date_text',
        'link',
        'meta',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'meta' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(EnglishContent::class, 'english_content_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
