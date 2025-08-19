<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'file', 'link_quiz', 'link_video',
    ];

    protected $casts = [
        'link_quiz'  => 'array',
        'link_video' => 'array',
    ];


}
