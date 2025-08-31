<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        $modules = Module::with('quizzes')->orderBy('name')->get();

        if (Auth::check()) {
            $user = Auth::user();
            $results = QuizResult::where('user_id', $user->id_users)->get()->keyBy('module_id');
            $modules->each(function ($module) use ($results) {
                $module->quiz_taken = $results->has($module->id);
                $module->score = $module->quiz_taken ? $results->get($module->id)->score : null;
            });
        }

        return view('welcome', ['module' => $modules]);
    }
}
