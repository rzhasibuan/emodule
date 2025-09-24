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
        $score_mc = 0;
        $mc_answers = [];
        $mcIndex = 0;
        $essayIndex = 0;
        // Simpan QuizResult lebih awal untuk dapatkan ID
        $quizResult = QuizResult::create([
            'user_id' => Auth::id(),
            'module_id' => $module->id,
            'score' => 0,
            'score_essay' => null,
            'answers' => json_encode([]), // default empty array agar tidak null
        ]);
        foreach ($quizzes as $quiz) {
            if ($quiz->type === 'multiple_choice') {
                $userAnswer = $answers['mc_' . $mcIndex] ?? null;
                $isCorrect = $userAnswer == $quiz->correct_answer;
                if ($isCorrect) {
                    $score_mc++;
                }
                $mc_answers[] = [
                    'quiz_id' => $quiz->id,
                    'question' => $quiz->question,
                    'user_answer' => $userAnswer,
                    'correct_answer' => $quiz->correct_answer,
                    'correct' => $isCorrect,
                ];
                $mcIndex++;
            } elseif ($quiz->type === 'essay') {
                $userAnswer = $answers['essay_' . $essayIndex] ?? null;
                \App\Models\EssayAnswer::create([
                    'quiz_result_id' => $quizResult->id,
                    'quiz_id' => $quiz->id,
                    'user_id' => Auth::id(),
                    'module_id' => $module->id,
                    'question' => $quiz->question,
                    'user_answer' => $userAnswer,
                ]);
                $essayIndex++;
            }
        }
        $quizResult->update([
            'score' => $score_mc,
            'answers' => json_encode($mc_answers),
        ]);
        return redirect()->route('module.quiz.results', $quizResult);
    }

    public function results(QuizResult $quizResult)
    {
        return view('quiz.results', compact('quizResult'));
    }

    public function adminEssayGrading()
    {
        $results = \App\Models\QuizResult::with('user', 'module')
            ->whereHas('essayAnswers')
            ->latest()->get();
        return view('admin.essay_grading.index', compact('results'));
    }

    public function adminEssayGradeForm($quizResultId)
    {
        $quizResult = \App\Models\QuizResult::with('user', 'module')->findOrFail($quizResultId);
        $essayAnswers = \App\Models\EssayAnswer::where('quiz_result_id', $quizResultId)->get();
        return view('admin.essay_grading.grade', compact('quizResult', 'essayAnswers'));
    }

    public function adminEssayGradeStore(Request $request, $quizResultId)
    {
        $quizResult = \App\Models\QuizResult::findOrFail($quizResultId);
        $essayAnswers = \App\Models\EssayAnswer::where('quiz_result_id', $quizResultId)->get();
        $total = 0;
        $count = 0;
        foreach ($essayAnswers as $answer) {
            $score = $request->input('scores.' . $answer->id);
            $answer->score = $score;
            $answer->graded_by = auth()->id();
            $answer->graded_at = now();
            $answer->save();
            $total += (int)$score;
            $count++;
        }
        $quizResult->score_essay = $count > 0 ? $total : null;
        $quizResult->save();
        return redirect()->route('admin.essay-grading')->with('success', 'Nilai essay berhasil disimpan.');
    }
}
