<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'activity_id',
        'start_at',
        'end_at',
        'target_minutes',
        'progress_minutes',
        'date_added',
    ];

    protected $hidden = [
        'deleted_at',
    ];
}
