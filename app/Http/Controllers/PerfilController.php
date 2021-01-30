<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //habilitamos el middleware de autenticacion
    public function __construct()
    {
        //tiene que estar autenticado excepto para show
        $this->middleware('auth', ['except'=>'show']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //Obtener las recetas con paginacion

        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(2);

        //Mostrara un solo perfil
        return view('perfiles.show', compact('perfil', 'recetas'));
        //return auth()->user();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //Ejecutar el Policy
        $this->authorize('view', $perfil);

        //
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //Ejecutar el Policy

        $this->authorize('update', $perfil);

        //dd($request['imagen']);
        //Validar
        $data = request()->validate([
            'nombre'=>'required',
            'url' => 'required',
            'biografia'=>'required',
            
        ]);

        // Si el usuario sube una imagen

        if($request['imagen']){
            //Obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-perfiles','public');

            //Resize de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            //Crear un arreglo de imagen
            $array_imagen=['imagen'=>$ruta_imagen];
        }

        //Asignar nombre y url 
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        //Eliminar url y name de $data porque no nos hace falta
        // ya que para actualizar la tabla perfil (no tiene estos campos)
        unset($data['url']);
        unset($data['nombre']);
        
        

        //Guardar informacion
            //Asiganr Biografia e imagen
            //array_merge sirve para unir dos arrays en este caso unimos
            //el array data y el array array_imagen
        auth()->user()->perfil()->update(array_merge(
            $data,
            $array_imagen ?? [] //le decimos ?? [] porque hay que pasar dos arreglos
            //en el caso de que exita $array_imagen le pasamo eso si no un array vacio []
        ));

        //redireccionar
        return redirect()->route('recetas.index');
    }

   
}
