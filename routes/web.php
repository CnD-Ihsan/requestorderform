<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\ROFController;
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

Route::get('/register', function () {
    return view('auth/register');
})->name('register');

Route::group(([
    'middleware' => 'auth',
    'prefix' => 'rof',
    'controller' => ROFController::class,
]), function(){
    //Index Page Route
    Route::get('/index','index')->name('indexROF');

    //Create Page Route
    Route::get('/create', 'create')->name('createROF');

    //Datatable Builder Function Route
    Route::get('/datatable', 'datatableBuilder')->name('datatableROF');

    //Show Page Route
    Route::get('/{rof_id}', 'show')->name('showROF');

    //Store Function Route
    Route::post('/create','store')->name('saveROF');

    //Update Function Route
    Route::post('/update/{rof_id}','update')->name('updateROF');

    //Edit Page Route
    Route::get('/edit/{rof_id}', 'edit')->name('editROF');

    //ROF Status Mutator Route
    Route::get('/approve/{rof_id}','approve_rof')->name('approveROF');
    Route::get('/reject/{rof_id}', 'reject_rof')->name('rejectROF');
    Route::get('/receive/{rof_id}', 'receive_rof')->name('receiveROF');

    //Download PDF Function Route
    Route::get('/pdf/{rof_id}', 'downloadPDF')->name('downloadPDF');
});

require __DIR__.'/auth.php';

