<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $module = Module::orderBy('name')->get();
        return view('welcome', compact('module'));
    }
}
