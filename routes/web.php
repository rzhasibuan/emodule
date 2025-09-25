<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\GradingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\WelcomeController::class, "index"])->name('welcome');
Route::get('/old', [\App\Http\Controllers\WelcomeController::class, "old"])->name('old');

Route::get("/list-module", [\App\Http\Controllers\WelcomeController::class, "listModule"])->name("listModule");
Route::get("/detail-module/{id}", [\App\Http\Controllers\WelcomeController::class, "detailModule"])->name("detail.module");
Route::get("/module/{module}/flipbook", [\App\Http\Controllers\WelcomeController::class, "viewFlipbook"])->name("module.flipbook");

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('register');

Route::post('/login',[LoginController::class, 'login_process'])->name('login_process');
Route::post('/register', [LoginController::class, 'register_process'])->name('register_process');

Route::post('/logout',[LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->middleware(['auth', 'level:1'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/delete/{id_users}', [AdminController::class, 'delete'])->name('delete');
    Route::get('/show/{id_users}', [AdminController::class, 'show_user'])->name('show_user');
    Route::post('/update/{id_users}', [AdminController::class, 'change_user'])->name('change_user');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');

    Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
    Route::get('/modules/create', [ModuleController::class, 'create'])->name('modules.create');
    Route::post('/modules', [ModuleController::class, 'store'])->name('modules.store');
    Route::get('/modules/{module}', [ModuleController::class, 'show'])->name('modules.show');
    Route::get('/modules/{module}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
    Route::put('/modules/{module}', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');

    Route::get('/quizzes/create-essay', [QuizController::class, 'createEssay'])->name('quizzes.createEssay');
    Route::post('/quizzes/store-essay', [QuizController::class, 'storeEssay'])->name('quizzes.storeEssay');
    Route::resource('quizzes', QuizController::class);

    Route::get('/grading', [GradingController::class, 'index'])->name('grading.index');
    Route::get('/grading/{result}', [GradingController::class, 'show'])->name('grading.show');
    Route::post('/grading/{result}', [GradingController::class, 'store'])->name('grading.store');

    Route::get('/essay-results', [QuizController::class, 'essayResults'])->name('admin.essay-results');
    Route::get('/essay-results/{quizResult}/grade', [QuizController::class, 'gradeEssay'])->name('admin.essay-results.grade');
    Route::post('/essay-results/{quizResult}/grade', [QuizController::class, 'storeEssayGrade'])->name('admin.essay-results.grade.store');
    Route::get('/essay-grading', [\App\Http\Controllers\ModuleQuizController::class, 'adminEssayGrading'])->name('admin.essay-grading');
    Route::get('/essay-grading/{quizResult}/grade', [\App\Http\Controllers\ModuleQuizController::class, 'adminEssayGradeForm'])->name('admin.essay-grading.grade');
    Route::post('/essay-grading/{quizResult}/grade', [\App\Http\Controllers\ModuleQuizController::class, 'adminEssayGradeStore'])->name('admin.essay-grading.grade.store');
});

Route::middleware(['auth', 'level:2'])->group(function () {
    Route::get('/module/{module}/quiz', [\App\Http\Controllers\ModuleQuizController::class, 'start'])->name('module.quiz.start');
    Route::post('/module/{module}/quiz', [\App\Http\Controllers\ModuleQuizController::class, 'submit'])->name('module.quiz.submit');
    Route::get('/quiz/results/{quizResult}', [\App\Http\Controllers\ModuleQuizController::class, 'results'])->name('module.quiz.results');
    Route::get('/my-scores', [\App\Http\Controllers\ScoreController::class, 'index'])->name('scores.index');
});


Route::get('/quiz/{quiz}', [QuizController::class, 'start'])->name('quiz.start');
Route::post('/quiz/{quiz}', [QuizController::class, 'submit'])->name('quiz.submit');

Route::view('/how-to-use', 'how-to-use')->name('how-to-use');
Route::view('/about', 'about')->name('about');
