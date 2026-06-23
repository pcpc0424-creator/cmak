<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'subtitle',
        'link_url',
        'icon',
        'image_path',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public const ICONS = [
        'doc' => '문서/서식',
        'book' => '책',
        'search' => '돋보기',
        'monitor' => '모니터',
        'folder' => '폴더',
        'building' => '빌딩',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
