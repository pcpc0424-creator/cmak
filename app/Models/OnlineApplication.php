<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_name',
        'description',
        'registration_date',
        'education_start',
        'education_end',
        'education_hours',
        'fee',
        'status',
        'max_participants',
    ];

    protected function casts(): array
    {
        return [
            'registration_date' => 'date',
            'education_start' => 'date',
            'education_end' => 'date',
        ];
    }

    public function entries()
    {
        return $this->hasMany(ApplicationEntry::class);
    }
}
