<?php

use App\Http\Controllers\webController;
use App\Http\Livewire\Historial;
use Illuminate\Support\Facades\Route;
use App\Events\RealTimeMessage;
use App\Http\Livewire\Cartera;
use App\Http\Livewire\Reporte;
use App\Http\Livewire\ShowGira;

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
Route::get('/giras-edit/{id_gira}',[webController::class,'edit'])->name('giras.edit');
Route::get('/historial/{id_cliente}/{id_etapa}/{id_gira}',Historial::class)->name('fase.historial');
Route::get('/show-gira/{id_gira}',ShowGira::class)->name('fase.gira');
Route::get('/reporte',Reporte::class)->name('fase.reporte');
Route::get('/cartera',[webController::class, 'cartera'])->name('fase.cartera');
Route::post('/cargar-excel',[webController::class,'saveExcel'])->name('fase.cargarExcel');
Route::post('/reporteTable',[Reporte::class,'reporte'])->name('fase.dataTable');
Route::post('/crear-gira',[webController::class,'createGira'])->name('new.gira');
Route::post('/editar-gira',[webController::class,'editarGira'])->name('edit.gira');
Route::get('/autocompletar', [webController::class,'autocompletar'])->name('web.autocompletar');
Route::get('/autocompletar-cartera', [webController::class,'autocompletar_cartera'])->name('web.autocompletar-cartera');
Route::post('/update-presupuesto', [webController::class,'update_presupuesto'])->name('web.update-presupuesto');
Route::post('/crear-tarea',[webController::class,'crearTarea'])->name('crearTarea');
Route::get('notifications/get',[webController::class,'buscarNotificaciones'])->name('buscarNotificaciones');
Route::get('notificationsAll',[webController::class,'notificaciones'])->name('allNotifications');
Route::post('eliminar-recordatorio',[webController::class,'eliminarTarea'])->name('eliminarTarea');
Route::get('leerNotificacion/{id_notificacion}',[webController::class,'marcarLeida'])->name('leerNotificacion');
Route::post('/validacionClientes', [webController::class,'validacionClientesEtapa'])->name('etapa.validacionClientes');
