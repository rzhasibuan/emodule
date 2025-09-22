<?php

namespace App\Http\Controllers;

use App\Models\QuizResult;
use Illuminate\Http\Request;

class GradingController extends Controller
{
    public function index()
    {
        $results = QuizResult::where('answers', 'like', '%"type":"essay"%')->get();
        return view('admin.grading.index', compact('results'));
    }

    public function show(QuizResult $result)
    {
        $answers = json_decode($result->answers, true);
        return view('admin.grading.show', compact('result', 'answers'));
    }

    public function store(Request $request, QuizResult $result)
    {
        $scores = $request->input('scores');
        $answers = json_decode($result->answers, true);
        $totalScore = 0;

        foreach ($answers as $index => &$answer) {
            if ($answer['type'] === 'essay' && isset($scores[$index])) {
                $answer['correct'] = (bool)$scores[$index];
            }

            if ($answer['correct']) {
                $totalScore++;
            }
        }

        // Recalculate score based on all questions
        $newScore = 0;
        foreach ($answers as $answer) {
            if ($answer['correct']) {
                $newScore++;
            }
        }

        $result->update([
            'answers' => json_encode($answers),
            'score' => $newScore,
        ]);

        return redirect()->route('grading.index')->with('success', 'Quiz graded successfully.');
    }
}
