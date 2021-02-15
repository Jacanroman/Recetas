<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;

class InicioController extends Controller
{
    //
    public function index()
    {
        //Obtener las recetas mas nuevas (las 2 ultimas que se lo decimos con limits)
        $nuevas = Receta::orderBy('created_at', 'ASC')->limit(2)->get();
        /*Esto anterior se puede hacer tambien asi
        $nuevas = Receta::latest()->get(); */

        //Recetas por categorias
        //Obtener todas las categorias
        $categorias = CategoriaReceta::all();
        
        //Agrupar las recetas por categoria
        $recetas=[];

        foreach($categorias as $categoria){
            $recetas[Str::slug($categoria->nombre)][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }
        return $recetas;
        

        //vista con compact le pasamos la variable $nuevas
        return view('inicio.index', compact('nuevas', 'recetas'));
    }
}
