<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {
        //vista
        return view('inicio.index');
    }
}
