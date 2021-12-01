<?php

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
Auth::routes();
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'paciente', 'middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\PacienteController::class, 'index']);
    Route::post('store', [App\Http\Controllers\PacienteController::class, 'store']);
    Route::get('show', [App\Http\Controllers\PacienteController::class, 'show']);
    Route::get('edit/{id}', [App\Http\Controllers\PacienteController::class, 'edit']);
    Route::post('update', [App\Http\Controllers\PacienteController::class, 'update']);
    Route::get('delete/{id}', [App\Http\Controllers\PacienteController::class, 'delete']);
    Route::get('vacina/{id}', [\App\Http\Controllers\PacienteController::class, 'vacina']);
    Route::post('vacina/registrar', [\App\Http\Controllers\PacienteController::class, 'registrarVacina']);
    Route::get('vacinado/{id}', [\App\Http\Controllers\PacienteController::class, 'pacientesVacinados']);
});
Route::group(['prefix' => 'vue-bootstrap', 'middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\PacienteController::class, 'bootstrap']);
});

Route::group(['prefix' => 'vue-data-grid', 'middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'dataGrid']);
});

Route::group(['prefix' => 'vacina', 'middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\VacinaController::class, 'index']);
    Route::post('store', [App\Http\Controllers\VacinaController::class, 'store']);
    Route::get('showVacinas', [App\Http\Controllers\VacinaController::class, 'showVacinas']);
    Route::get('deletar/{id}', [App\Http\Controllers\VacinaController::class, 'deletar']);
});

Route::group(['prefix' => 'relatorio', 'middleware' => 'auth' ], function(){
    Route::get('/', [App\Http\Controllers\RelatorioController::class, 'index']);
    Route::get('vacinados', [App\Http\Controllers\RelatorioController::class, 'vacinados']);
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
