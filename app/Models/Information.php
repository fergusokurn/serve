<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'title',
        'description',
        'image',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
