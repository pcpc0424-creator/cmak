<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'online_application_id',
        'applicant_name',
        'email',
        'phone',
        'company',
        'position',
        'data',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    public function onlineApplication()
    {
        return $this->belongsTo(OnlineApplication::class);
    }
}
