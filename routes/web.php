<?php

use App\Models\Questionnaire;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CaptchaController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardQuizController;
use App\Http\Controllers\QuestionnaireController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/posts', [PostController::class, 'index']);

//penulisan harus sama
Route::get('/posts/{questionnaire:link}', [PostController::class, 'preview']);


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});


Route::get('/dashboard', [DashboardController::class, 'index']);
// ->middleware('auth');



Route::resource('/dashboard/questionnaires', DashboardQuizController::class)->middleware('auth');

Route::get('/dashboard/create-judul', function () {
    $title = "Buat Detail Kuesioner";

    $questionnaire = new Questionnaire();
    $cat = Questionnaire::distinct()->orderBy('kategori')->pluck('kategori');

    return view('dashboard.questionnaires.create-judul', compact('title', 'cat'));
});


Route::get('/dashboard/redirect', [Controller::class, 'redirectToCreate'])->name('dashboard.redirect');

Route::get('/reload-captcha', [CaptchaController::class, 'reload_captcha']);
Route::post('/check-captcha/{questionnaire:link}', [CaptchaController::class, 'check_captcha']);

Route::get('/start/{questionnaire:link}', [PostController::class, 'startQuest']);

Route::post('/start/store/{questionnaire:link}', [PostController::class, 'store']);

Route::get('/dashboard/print/{questionnaire:link}', [Controller::class, 'showPrintPreview']);
// Route::get('/start/{questionnaire:link}',[Controller::class,'show']);

// Route::resource('/start', QuestionnaireController::class);

// Route::get('/dashboard/questionnaires/create-question',function () {
//     return view('dashboard.questionnaires.create');
// });
