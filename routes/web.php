<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/rof', [App\Http\Controllers\ROFController::class,'index'])->middleware(['auth'])->name('rof');
Route::get('/show.{ref_no}', [App\Http\Controllers\ROFController::class,'show'])->middleware(['auth'])->name('showROF');

Route::post('/rof', [App\Http\Controllers\ROFController::class,'store'])->middleware(['auth'])->name('saveROF');
Route::put('/rof', [App\Http\Controllers\ROFController::class,'update'])->middleware(['auth'])->name('updateROF');
//Route::resource('/rof', [App\Http\Controllers\ROFController::class,'index'])->middleware(['auth']);//->name('indexROF');

Route::get('/add_new_user', function () {
    return view('auth/register');
})->name('add_new_user');

require __DIR__.'/auth.php';
 