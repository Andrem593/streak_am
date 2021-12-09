<?php

use App\Http\Controllers\webController;
use App\Http\Livewire\Historial;
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
    return view('giras.index');
});
Route::get('/giras',[webController::class,'index'])->name('giras');
Route::get('/show',[webController::class,'show'])->name('show');
Route::get('/giras-create',[webController::class,'create'])->name('giras.create');
Route::get('/historial',Historial::class)->name('fase.historial');
