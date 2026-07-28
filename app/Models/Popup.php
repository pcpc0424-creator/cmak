<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Popup extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * 좌표/크기 기본값 (DB 스키마 기본값과 동일 - 단일 출처)
     * 빈값(null/""/공백) 입력 시 이 값이 자동 적용됩니다.
     */
    public const DEFAULT_POSITION_X = 100;
    public const DEFAULT_POSITION_Y = 100;
    public const DEFAULT_WIDTH = 400;
    public const DEFAULT_HEIGHT = 300;

    protected $fillable = [
        'title',
        'content',
        'image_path',
        'link_url',
        'popup_type',
        'width',
        'height',
        'position_x',
        'position_y',
        'is_active',
        'sort_order',
        'started_at',
        'ended_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('started_at')->orWhere('started_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('ended_at')->orWhere('ended_at', '>=', now());
            });
    }
}
