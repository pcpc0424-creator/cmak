<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsmaEdition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'year',
        'thumb_path',
        'full_path',
        'main_text',
        'sub_text',
        'detail_url',
        'detail_content',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
