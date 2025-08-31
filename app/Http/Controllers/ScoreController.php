<?php

namespace App\Http\Controllers;

use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $results = QuizResult::where('user_id', $user->id_users)->with('module')->latest()->get();
        return view('scores.index', compact('results'));
    }
}
