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
        'summary',
        'excerpt',
        'category',
        'author',
        'issue_number',
        'metadata',
        'is_notice',
        'is_featured',
        'is_published',
        'view_count',
        'sort_order',
        'created_by',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_notice' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'metadata' => 'array',
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
