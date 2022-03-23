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

######## CRUD regiones

/* Métodos Raw SQL
* 
* DB::select();
* DB::insert();
* DB::update();
* DB::delete();
*
* Métodos Fluent Query Builder
*
* DB::table('nTable')->get();
* DB::table('nTable')->select('campo')->get();
* DB::tablo('nTable')->where(condicion)->get();
*/

Route::get('/adminRegiones', function(){
    // traemos listado de regiones
    //$regiones = DB::select('SELECT regID, regNombre FROM regiones');

    $regiones = DB::table('regiones')->get();
    return view('adminRegiones', ['regiones'=>$regiones]);
});

Route::get('/adminDestinos', function(){
    // traemos listado de destinos
    //$destinos = DB::select('SELECT destID, destNombre FROM destinos');

    $destinos = DB::table('destinos')->get();
    return view('adminDestinos', ['destinos'=>$destinos]);
});

Route::get('/agregarRegion', function(){
    return view('agregarRegion');
});

Route::post('/agregarRegion', function(){
    $regNombre = $_POST['regNombre'];
    // con raw sql sería: 
   /* DB::insert('INSERT INTO regiones 
            VALUES (:regNombre), [regNombre]'
            );
    */
    DB::table('regiones')->insert(['regNombre'=>$regNombre]);
    return redirect('/adminRegiones')
                ->with('mensaje', 'Región: '.$regNombre.' agregada correctamente');
});

Route::get('/agregarDestino', function(){
    return view('agregarDestino');
});

Route::post('/agregarDestino', function(){
    $destNombre = $_POST['destNombre'];
    DB::table('destinos')->insert(['destNombre'=>$destNombre]);
    return redirect('/adminDestinos')
                ->with('mensaje', 'Destino: '.$destNombre.' agregado correctamente');
});

Route::get('/modificarRegion/{regID}', function($regID){
    // obtener datos de la región según su ID
/*  $region = DB::select('SELECT regID, regNombre
                            FROM REGIONES
                            WHERE regID = ?', [$regID]);
                            */
/*  $region = DB::select('SELECT regID, regNombre
                            FROM regiones
                            WHERE regID = :regID
                            AND x = :x' , [':regID'=>$regID, ':x'=>$x]);
                            */ // CON RAW SQL
    //con Facade (patron de diseño) no es necesario abrir la conexión, ni el prepare ni el data biding 
    $region = DB::table('regiones')
                    ->where('regID', $regID)
                    ->first(); // esto es lo mismo que fetch
                    //->get();  esto sería lo mismo que fetchAll un array de arrays
    // retornar la vista del form con los datos ya cargados
    return view('modificarRegion', [ 'region'=>$region]);
});

Route::post('/modificarRegion', function(){
    $regNombre = $_POST['regNombre'];
    $regID = $_POST['regID'];
    DB::table('regiones')->where('regID', $regID)
                        ->update(['regNombre'=>$regNombre]);
    return redirect('/adminRegiones')->with('mensaje', 'Región: '.$regNombre.' modificada correctamente');
});