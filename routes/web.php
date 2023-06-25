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

// Guest routes
// Home
Route::get('/', function () {
    return view('home');
});

// Posts
Route::get('/posts', [PostController::class, 'index']);

// Preview
Route::get('/posts/{questionnaire:link}', [PostController::class, 'preview']);

// Captcha Check
Route::get('/reload-captcha', [CaptchaController::class, 'reload_captcha']);
Route::post('/check-captcha/{questionnaire:link}', [CaptchaController::class, 'check_captcha']);

// Start Questionnaire
Route::get('/start/{questionnaire:link}', [PostController::class, 'startQuest']);

// Login
Route::get('/login', [LoginController::class, 'index'])->name('loginpage');
Route::post('/login', [LoginController::class, 'authenticate']);

// Logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});


// Admin routes
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Questionnaires CRUD
    Route::resource('/dashboard/questionnaires', DashboardQuizController::class);

    // Create Judul
    Route::get('/dashboard/create-judul', function () {
        $title = "Buat Detail Kuesioner";
        $questionnaire = new Questionnaire();
        $cat = Questionnaire::distinct()->orderBy('kategori')->pluck('kategori');
        return view('dashboard.questionnaires.create-judul', compact('title', 'cat'));
    });

    // Redirect From Index to Create-Judul
    Route::get('/dashboard/redirect', [Controller::class, 'redirectToCreate'])->name('dashboard.redirect');

    // Storing Detail Kuesioner to Database
    Route::post('/start/store/{questionnaire:link}', [PostController::class, 'store']);

    // Print Preview
    Route::get('/dashboard/print/{questionnaire:link}', [Controller::class, 'showPrintPreview']);
});


// Route::get('/start/{questionnaire:link}',[Controller::class,'show']);

// Route::resource('/start', QuestionnaireController::class);

// Route::get('/dashboard/questionnaires/create-question',function () {
//     return view('dashboard.questionnaires.create');
// });
