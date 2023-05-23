<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\Controller; 
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
// use App\Http\Livewire\Login;

// Route::get('/', function () {
//     return redirect()->route('login');
// });

// Route::get('/login', Login::class)->name('login');
// Route::post('/login', [Login::class, 'login'])->name('login.submit');

// // Route::get('/', function () {
// //     // return redirect()->route('login');
// //     return view('login');
// // });

// // Route::get('/login', Login::class)->name('login');
// // Route::post('/login', [Login::class, 'login'])->name('login.submit');


Route::get('/', function () {
    return view('login');
});

Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::post('/login', [RegisterController::class, 'login'])->name('login.submit');

// Route::get('/threads', function () {
//     return view('threads');
// })->name('threads');

Route::get('/threads', [ThreadController::class, 'index'])->name('threads');

// Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');

// web.php



Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');


Route::get('/logout', [Controller::class, 'destroy'])->name('logout');

    

Route::post('/comments/{comment}/markAsBestReply', [CommentController::class,'markAsBestReply'])->name('comments.markAsBestReply');
Route::post('/profile', [ThreadController::class, 'update'])->name('profile.update');


