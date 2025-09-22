<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleQuizController extends Controller
{
    public function start(Module $module)
    {
        $quizzes = $module->quizzes()->get();
        return view('quiz.module_quiz', compact('module', 'quizzes'));
    }

    public function submit(Request $request, Module $module)
    {
        $quizzes = $module->quizzes;
        $answers = $request->input('answers');
        $score = 0;
        $results = [];

        foreach ($quizzes as $index => $quiz) {
            $isCorrect = null;
            if ($quiz->type === 'multiple_choice') {
                $isCorrect = isset($answers[$index]) && $answers[$index] == $quiz->correct_answer;
                if ($isCorrect) {
                    $score++;
                }
            }

            $results[] = [
                'question' => $quiz->question,
                'user_answer' => $answers[$index] ?? null,
                'correct_answer' => $quiz->type === 'multiple_choice' ? $quiz->correct_answer : $quiz->answer_key,
                'correct' => $isCorrect,
                'type' => $quiz->type,
            ];
        }

        $quizResult = QuizResult::create([
            'user_id' => Auth::id(),
            'module_id' => $module->id,
            'score' => $score,
            'answers' => json_encode($results),
        ]);

        return redirect()->route('module.quiz.results', $quizResult);
    }

    public function results(QuizResult $quizResult)
    {
        return view('quiz.results', compact('quizResult'));
    }
}
