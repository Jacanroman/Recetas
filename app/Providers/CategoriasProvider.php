<?php

namespace App\Providers;

//no se importa de Illuminate o de facades directamente:

use App\Models\CategoriaReceta;
use View;
use Illuminate\Support\ServiceProvider;

class CategoriasProvider extends ServiceProvider
{
    /** El metodo register colocamos las dependencias al crear el proyecto
     * registra todo antes que laravel comienza.
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *Se ejecuta todo cuando la aplicacion esta lista
     * @return void
     */
    public function boot()
    {
        //A todas las vistas le pasamos las categorias
        View::composer('*', function($view){
            
            $categorias = CategoriaReceta::all();
            $view->with('categorias',$categorias);
        });
    }
}
