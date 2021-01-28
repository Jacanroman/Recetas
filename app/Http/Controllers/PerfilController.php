<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //Mostrara un solo perfil
        return view('perfiles.show', compact('perfil'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
