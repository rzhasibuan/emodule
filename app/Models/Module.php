<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'file', 'link_video', 'category', 'description', 'author', 'image',
    ];

    protected $casts = [
        'link_video' => 'array',
    ];


    protected function getLinkVideoAttribute($value)
    {
        $links = json_decode($value, true);
        return array_values(array_filter($links ?? []));
    }

    public function setLinkVideoAttribute($value)
    {
        $this->attributes['link_video'] = is_array($value) ? json_encode($value) : $value;
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
