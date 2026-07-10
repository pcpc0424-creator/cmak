<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptionSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'reception_event_id', 'user_id', 'answers',
        'applicant_name', 'applicant_phone', 'applicant_email',
        'ip', 'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'answers' => 'array',
            'submitted_at' => 'datetime',
        ];
    }

    public function event()
    {
        return $this->belongsTo(ReceptionEvent::class, 'reception_event_id');
    }
}
