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

    // Convert link_quiz and link_video from JSON strings to arrays
    protected function getLinkQuizAttribute($value)
    {
        $links = json_decode($value, true);
        return array_values(array_filter($links ?? []));
    }

    protected function getLinkVideoAttribute($value)
    {
        $links = json_decode($value, true);
        return array_values(array_filter($links ?? []));
    }

    // Set as JSON when saving
    protected function setLinkQuizAttribute($value)
    {
        $this->attributes['link_quiz'] = is_array($value) ? json_encode($value) : $value;
    }

    protected function setLinkVideoAttribute($value)
    {
        $this->attributes['link_video'] = is_array($value) ? json_encode($value) : $value;
    }
}
