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

Route::get('/rof', function () {

    if(auth()->check()){
        return redirect()->route('indexROF');
    }
    else{
        return view('auth/login');
    }

})->name('rof');

Route::get('/', function () {
    return redirect()->route('rof');
});

//Index Route
Route::get('rof/index', [App\Http\Controllers\ROFController::class,'index'])->middleware(['auth'])->name('indexROF');

//Create Route
Route::get('rof/create', [App\Http\Controllers\ROFController::class,'create'])->middleware(['auth'])->name('createROF');

Route::get('rof/datatable', [App\Http\Controllers\ROFController::class,'datatableBuilder'])->middleware(['auth'])->name('datatableROF');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Show Route
Route::get('rof/{rof_id}', [App\Http\Controllers\ROFController::class,'show'])->middleware(['auth'])->name('showROF');

//Store Route
Route::post('rof/create', [App\Http\Controllers\ROFController::class,'store'])->middleware(['auth'])->name('saveROF');

//Update Route
Route::post('rof/update/{rof_id}', [App\Http\Controllers\ROFController::class,'update'])->middleware(['auth'])->name('updateROF');

Route::get('rof/edit/{rof_id}', [App\Http\Controllers\ROFController::class,'edit'])->middleware(['auth'])->name('editROF');

Route::get('rof/approve/{rof_id}', [App\Http\Controllers\ROFController::class,'approve_rof'])->middleware(['auth'])->name('approveROF');
Route::get('rof/reject/{rof_id}', [App\Http\Controllers\ROFController::class,'reject_rof'])->middleware(['auth'])->name('rejectROF');
Route::get('rof/receive/{rof_id}', [App\Http\Controllers\ROFController::class,'receive_rof'])->middleware(['auth'])->name('receiveROF');

Route::get('/register', function () {
    return view('auth/register');
})->name('register');

Route::get('rof/pdf/{rof_id}', [App\Http\Controllers\ROFController::class,'downloadPDF'])->middleware(['auth'])->name('downloadPDF');

Route::get('test-email', [App\Http\Controllers\ROFController::class,'sendEmail'])->name('test-email');

require __DIR__.'/auth.php';

