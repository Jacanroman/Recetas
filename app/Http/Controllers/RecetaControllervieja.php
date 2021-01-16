<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecetaController extends Controller
{
    /*cuando un controlador tiene un solo metodo en vez de 
    darle el nombre que queramos le damos el nombre __invoke()   
    public function __invoke(){

        $receta = [
            'nombre' => 'Pizza Hawaiana',
            'description' => 'Prepara la mejor pizza'
        ];

        return $receta;
        //return view('nosotros');
    }
    
    //cuando tiene mas de un metodo
    
    public function hola()
    {
        return view('nosotros');
    }
    */

    public function __invoke(Request $request)
    {
        $recetas = ['Receta Pizza', 'Receta Hamburguesa','Receta Tacos'];
        $categorias =['Comida Mexicana','Comida Argentina','Postre'];
        
        //primera forma
        //return view('recetas.index')->with('recetas',$recetas)->with('categorias',$categorias);

        //Segunda forma
        
        return view('recetas.index', compact('recetas','categorias'));
    }
}
