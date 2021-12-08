<?php

use App\Http\Controllers\BoardController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('board', [BoardController::class, 'index'])->name('board.index');

Route::get('board/{board}', [BoardController::class, 'show'])->name('board.show');

Route::get('board/create', [BoardController::class, 'create'])->name('board.create');

Route::post('board/store', [BoardController::class, 'store'])->name('board.store');

