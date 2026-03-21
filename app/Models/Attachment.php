<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'attachable_id',
        'attachable_type',
        'file_name',
        'file_path',
        'file_size',
        'mime_type',
        'sort_order',
    ];

    public function attachable()
    {
        return $this->morphTo('attachable');
    }
}
