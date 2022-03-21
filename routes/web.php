<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
//use App\Resources\Views\rof;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

//Index Route
Route::get('/index', [App\Http\Controllers\ROFController::class,'index'])->middleware(['auth'])->name('indexROF');

//Show Route
Route::get('show/{form_ref_no}', [App\Http\Controllers\ROFController::class,'show'])->middleware(['auth'])->name('showROF');

//Store Route
Route::post('/index', [App\Http\Controllers\ROFController::class,'store'])->middleware(['auth'])->name('saveROF');

//Update Route
Route::put('/index/{form_ref_no}', [App\Http\Controllers\ROFController::class,'update'])->middleware(['auth'])->name('updateROF');
//Route::resource('/rof', [App\Http\Controllers\ROFController::class,'index'])->middleware(['auth']);//->name('indexROF');

Route::get('/add_new_user', function () {
    return view('auth/register');
})->name('add_new_user');

require __DIR__.'/auth.php';
 