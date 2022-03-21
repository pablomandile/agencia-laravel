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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/prueba', function () {
    return view('prueba');
});
Route::get('/formulario', function () {
    return view('formulario');
});
Route::post('/proceso', function(){
    //capturamos dato del form
    $frase = $_POST['frase'];
    //pasamos dato a la vista como array asoc
    return view('proceso', ['frase'=> $frase]);
});
// implementando el motor de planillas de blade
Route::view('/inicio2', 'inicio');

// trayenmdo datos desde base de datos
Route::get('/regiones', function(){
    // pasamos datos a la vista
    $regiones = \Illuminate\Support\Facades\DB::table('regiones')->get();
    return view('regiones', ['regiones'=>$regiones]);
});

Route::get('/destinos', function(){
    $destinos = \Illuminate\Support\Facades\DB::table('destinos')->get();
    return view('destinos', ['destinos'=>$destinos]);
});