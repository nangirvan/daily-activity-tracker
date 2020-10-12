<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'category_id',
        'name',
        'target',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];
}
