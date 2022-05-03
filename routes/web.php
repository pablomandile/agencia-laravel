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

Route::get('/eliminarRegion/{regID}', function($regID){
    $region = DB::table('regiones')
    ->where('regID', $regID)
    ->first();
    // retornar la vista informativa para confirmar
    return view('eliminarRegion', [ 'region'=>$region ]);
});

Route::post('/eliminarRegion', function(){
    $regNombre = $_POST['regNombre'];
    $regID = $_POST['regID'];
    DB::table('regiones')
                ->where('regID', $regID)
                ->delete();
    return redirect('adminRegiones')->with('mensaje', 'Región '.$regNombre.' eliminada correctamente');
});

Route::get('/adminDestinos', function(){
    // traemos listado de destinos
    //$destinos = DB::select('SELECT destID, destNombre FROM destinos');

    //$destinos = DB::select('SELECT destID, destNombre, destPrecio, d.regID, r.regNombre
    //                         FROM destinos d, regiones r
    //                         WHERE d.regID = r.regID);

        //$destinos = DB::select('SELECT destID, destNombre, destPrecio, d.regID, r.regNombre
    //                         FROM destinos as d
    //                         INNER JOIN regiones as r
    //                         ON d.regID = r.regID');

    $destinos = DB::table('destinos as d')
                        //->select('destNombre', 'destPrecio', 'r.regNombre')
                        ->join('regiones as r', 'd.regID', '=', 'r.regID')
                        ->get();
    return view('adminDestinos', ['destinos'=>$destinos]);
});

Route::get('/agregarDestino',function (){
    $regiones = DB::table('regiones')->get();
    return view('agregarDestino', ['regiones'=>$regiones]);
});

// Route::get('/agregarDestino',function (){
//     // $regiones = DB::table('regiones')->get();
//     return view('agregarDestino');
// });

Route::post('/agregarDestino', function(){
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];
    DB::table('destinos')->insert(
        [
            'destNombre'=>$destNombre,
            'regID'=>$regID,
            'destPrecio'=>$destPrecio,
            'destAsientos'=>$destAsientos,
            'destDisponibles'=>$destDisponibles
        ]
    );
    return redirect('/adminDestinos')
                ->with('mensaje', 'Destino: '.$destNombre.' agregado correctamente');
});

Route::get('/modificarDestino/{destID}', function($destID){
    //obtenemos datos de un destipo por su id
    $destino = DB::table('destinos as d')
                    ->join('regiones as r', 'd.regID', '=', 'r.regID')
                    ->where('destID', $destID)
                    ->first();
    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();

    return view('modificarDestino', 
                        [
                            'destino'=>$destino,
                            'regiones'=>$regiones
                        ]
    );
});

Route::post('/modificarDestino', function(){
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destID = $_POST['destID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];
    DB::table('destinos')
            ->where('destID', $destID)
            ->update(
                [
                    'destNombre'=>$destNombre,
                    'regID'=>$regID,
                    'destPrecio'=>$destPrecio,
                    'destAsientos'=>$destAsientos,
                    'destDisponibles'=>$destDisponibles,
                ]
        );
    return redirect('/adminDestinos')
                ->with('mensaje', 'Destino: '.$destNombre.' modificado correctamente');
});
Route::get('/eliminarDestino/{destID}', function($destID){
    $destino = DB::table('destinos')
    ->where('destID', $destID)
    ->first();
    // retornar la vista informativa para confirmar
    return view('eliminarDestino', [ 'destino'=>$destino ]);
});

Route::post('/eliminarDestino', function(){
    $destNombre = $_POST['destNombre'];
    $destID = $_POST['destID'];
    DB::table('destinos')
                ->where('destID', $destID)
                ->delete();
    return redirect('adminDestinos')->with('mensaje', 'Destino: '.$destNombre.' eliminado correctamente');
});