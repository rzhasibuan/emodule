<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('module')->get();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $modules = Module::all();
        return view('admin.quizzes.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required|in:a,b,c,d',
            'module_id' => 'required|exists:modules,id',
        ]);

        Quiz::create($request->all());

        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully.');
    }

    public function createEssay()
    {
        $modules = Module::all();
        return view('admin.quizzes.create-essay', compact('modules'));
    }

    public function storeEssay(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer_key' => 'required',
            'module_id' => 'required|exists:modules,id',
        ]);

        Quiz::create([
            'question' => $request->question,
            'answer_key' => $request->answer_key,
            'module_id' => $request->module_id,
            'type' => 'essay',
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Essay quiz created successfully.');
    }

    public function edit(Quiz $quiz)
    {
        if ($quiz->type == 'essay') {
            $modules = Module::all();
            return view('admin.quizzes.edit-essay', compact('quiz', 'modules'));
        }
        $modules = Module::all();
        return view('admin.quizzes.edit', compact('quiz', 'modules'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        if ($quiz->type == 'essay') {
            $request->validate([
                'question' => 'required',
                'answer_key' => 'required',
                'module_id' => 'required|exists:modules,id',
            ]);
    
            $quiz->update([
                'question' => $request->question,
                'answer_key' => $request->answer_key,
                'module_id' => $request->module_id,
            ]);
    
            return redirect()->route('quizzes.index')->with('success', 'Essay quiz updated successfully.');
        }

        $request->validate([
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required|in:a,b,c,d',
            'module_id' => 'required|exists:modules,id',
        ]);

        $quiz->update($request->all());

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
    }

    public function start(Quiz $quiz)
    {
        return view('quiz.start', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $request->validate([
            'answer' => 'required|in:a,b,c,d',
        ]);

        $isCorrect = $request->answer == $quiz->correct_answer;

        return response()->json([
            'correct' => $isCorrect,
            'correct_answer' => $quiz->correct_answer,
        ]);
    }
}
