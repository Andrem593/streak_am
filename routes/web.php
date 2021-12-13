<?php

use App\Http\Controllers\webController;
use App\Http\Livewire\Historial;
use Illuminate\Support\Facades\Route;
use App\Events\RealTimeMessage;

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

Route::get('/',[webController::class,'index']);
Route::get('/giras',[webController::class,'index'])->name('giras');
Route::get('/show/{id_gira}',[webController::class,'show'])->name('show');
Route::get('/giras-create',[webController::class,'create'])->name('giras.create');
Route::get('/historial',Historial::class)->name('fase.historial');
Route::post('/crear-gira',[webController::class,'createGira'])->name('new.gira');
Route::post('/crear-tarea',[webController::class,'crearTarea'])->name('crearTarea');
