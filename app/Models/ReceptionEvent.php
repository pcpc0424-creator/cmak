<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceptionEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'description',
        'event_start', 'event_end', 'reg_start', 'reg_end',
        'fee_info', 'status', 'capacity', 'is_active', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'event_start' => 'datetime',
            'event_end' => 'datetime',
            'reg_start' => 'datetime',
            'reg_end' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public const STATUSES = [
        'open' => '접수중',
        'closed' => '접수마감',
        'done' => '완료',
    ];

    public function questions()
    {
        return $this->hasMany(ReceptionQuestion::class)->orderBy('sort_order')->orderBy('id');
    }

    public function submissions()
    {
        return $this->hasMany(ReceptionSubmission::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    /** 현재 접수 가능 여부(상태 open + 접수기간 내 + 정원 미달) */
    public function isAcceptingNow(): bool
    {
        if ($this->status !== 'open') {
            return false;
        }
        $now = now();
        if ($this->reg_start && $now->lt($this->reg_start)) {
            return false;
        }
        if ($this->reg_end && $now->gt($this->reg_end)) {
            return false;
        }
        if ($this->capacity !== null && $this->submissions()->count() >= $this->capacity) {
            return false;
        }
        return true;
    }
}
