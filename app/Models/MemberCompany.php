<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberCompany extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name',
        'representative',
        'business_number',
        'address',
        'phone',
        'fax',
        'email',
        'website',
        'logo_path',
        'description',
        'membership_type',
        'joined_at',
        'is_active',
        'is_verified',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_verified' => 'boolean',
            'joined_at' => 'datetime',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }
}
