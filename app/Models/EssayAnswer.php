<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_result_id',
        'quiz_id',
        'user_id',
        'module_id',
        'question',
        'user_answer',
        'score',
        'graded_by',
        'graded_at',
    ];

    public function quizResult()
    {
        return $this->belongsTo(QuizResult::class);
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_users');
    }
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}

