<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {
        //Obtener las recetas mas nuevas (las 2 ultimas que se lo decimos con limits)
        $nuevas = Receta::orderBy('created_at', 'ASC')->limit(2)->get();
        /*Esto anterior se puede hacer tambien asi
        $nuevas = Receta::latest()->get(); */

        //vista con compact le pasamos la variable $nuevas
        return view('inicio.index', compact('nuevas'));
    }
}
