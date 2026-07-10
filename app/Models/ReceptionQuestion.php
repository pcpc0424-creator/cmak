<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptionQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'reception_event_id', 'label', 'type', 'options', 'is_required', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'is_required' => 'boolean',
        ];
    }

    public const TYPES = [
        'text' => '한 줄 텍스트',
        'textarea' => '여러 줄 텍스트',
        'radio' => '라디오(단일 선택)',
        'checkbox' => '체크박스(복수 선택)',
        'select' => '드롭다운',
        'date' => '날짜 선택',
        'agreement' => '동의(개인정보 등)',
    ];

    /** 선택지가 필요한 유형 */
    public function hasOptions(): bool
    {
        return in_array($this->type, ['radio', 'checkbox', 'select'], true);
    }

    public function event()
    {
        return $this->belongsTo(ReceptionEvent::class, 'reception_event_id');
    }
}
