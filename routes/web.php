<?php

use Illuminate\Support\Facades\Auth;
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


Route::get('/','InicioController@index')->name('inicio.index');

/*con el anterior RecetasController que tenia un invoke
Route::get('/recetas', 'RecetaController');
*/

Route::get('/recetas','RecetaController@index')->name('recetas.index');
Route::get('/recetas/create', 'RecetaController@create')->name('recetas.create');
Route::post('/recetas', 'RecetaController@store')->name('recetas.store');
Route::get('/recetas/{receta}', 'RecetaController@show')->name('recetas.show');
Route::get('/recetas/{receta}/edit', 'RecetaController@edit')->name('recetas.edit');
Route::put('/recetas/{receta}', 'RecetaController@update')->name('recetas.update');
Route::delete('/recetas/{receta}', 'RecetaController@destroy')->name('recetas.destroy');

Route::get('/categoria/{categoriaReceta}', 'CategoriasController@show')->name('categorias.show');


//Todo lo relacionado con perfiles
Route::get('/perfiles/{perfil}', 'PerfilController@show')->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit', 'PerfilController@edit')->name('perfiles.edit');
Route::put('/perfiles/{perfil}', 'PerfilController@update')->name('perfiles.update');

//Todo lo relacionado con Likes Almacena los likes de recetas
Route::post('/recetas/{receta}', 'LikesController@update')->name('likes.update');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
