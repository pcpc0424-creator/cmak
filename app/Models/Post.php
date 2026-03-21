<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'board_type',
        'title',
        'content',
        'excerpt',
        'category',
        'is_notice',
        'is_published',
        'view_count',
        'created_by',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_notice' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeOfType($query, $boardType)
    {
        return $query->where('board_type', $boardType);
    }
}
