<?php

use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ApplyProjectController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ProjectCommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('mypages', MypageController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('profiles', ProfController::class);
    Route::post('/projects/{project}/comments', [ProjectCommentController::class, 'store'])->name('comments.store');
    Route::post('/projects/{project}', [ApplyProjectController::class, 'store'])->name('applyProjects.store');
    Route::get('/projects', function () {
        return view('mypages.index'); 
    })->name('projects.index');
    Route::get('/mypage/projects', function () {
        return view('projects.list');
    })->name('mypage.projects');
    Route::get('/apply_projects', function () {
        return view('applyProjects.list');
    })->name('applyProjects');
});

require __DIR__ . '/auth.php';
