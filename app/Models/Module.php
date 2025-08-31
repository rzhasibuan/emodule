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


    // Convert link_quiz and link_video from JSON strings to arrays
    protected function getLinkQuizAttribute($value)
    {
        $links = json_decode($value, true) ?? [];
        $internalQuizzes = $this->quizzes->map(function ($quiz) {
            return ['title' => $quiz->question, 'url' => route('quiz.start', $quiz)];
        })->toArray();

        return array_merge(array_values(array_filter($links)), $internalQuizzes);
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

    public function setLinkVideoAttribute($value)
    {
        $this->attributes['link_video'] = is_array($value) ? json_encode($value) : $value;
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
