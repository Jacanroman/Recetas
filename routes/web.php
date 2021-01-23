<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\RecetaController;
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


/*
Route::get('/nosotros',function(){
    return view('nosotros');
});
*/

/*para llamar clases con mas de un metodo
Route::get('/nosotros','RecetaController@hola');
*/

//Route::get('/nosotros','RecetaController');


Route::get('/', function () {
    //return "hola mundo";
    return view('welcome');
});

/*con el anterior RecetasController que tenia un invoke
Route::get('/recetas', 'RecetaController');
*/

Route::get('/recetas','RecetaController@index')->name('recetas.index');
Route::get('/recetas/create', 'RecetaController@create')->name('recetas.create');
Route::post('/recetas', 'RecetaController@store')->name('recetas.store');
Route::get('/recetas/{receta}', 'RecetaController@show')->name('recetas.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
