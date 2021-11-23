<?php

use App\Http\Controllers\CourseController;
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

Auth::routes(['register' => false]);

Route::middleware(['auth','checkActive'])->group(function () {
    Route::resource('/courses','CourseController')->except('create','show');
    
    Route::resource('/estudiantes', 'EstudianteController')->except('create');
    
    Route::resource('/notas', 'NotaController');
    Route::get('/datatable/notas','DatatableController@notas')->name('datatable.notas');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/users', UserController::class);

    Route::get('/certificado/{id}','DatatableController@certificado')->name('datatable.certificado');
});
