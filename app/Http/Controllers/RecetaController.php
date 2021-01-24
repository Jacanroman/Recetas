<?php

namespace App\Http\Controllers;

use App\Models\CategoriaReceta;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
        //Con esto protegemos las rutas para que solo se puedan abrir
        //si estas autentificado

        //anadiendo Except le decimos que esta todo protegido menos
        // la function que le agregamos en el Except en este caso show estara publico
        $this->middleware('auth',['except'=>'show']);

        //para agregar varias funciones en el except es 'except'=>['show','create']
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recetas = Auth::user()->recetas;
        //esto es lo mismo que lo anterior
        //auth()->user()->recetas->dd();
        return view('recetas.index')->with('recetas', $recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //DB::table('categoria_recetas')->get()->pluck('nombre','id')->dd();

        /*Obtener las categorias (sin modelo)
        $categorias = DB::table('categoria_recetas')->get()->pluck('nombre','id');
        */

        //Con modelo (para recoger el id_categoria y el nombre)

        $categorias = CategoriaReceta::all(['id','nombre']);


        return view('recetas.create')->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        //dd($request['imagen']->store('upload-recetas','public'));

        //validacion
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image'
        ]);
        
        // obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-recetas','public');


        //Resize de la imagen (usamos intervention Image)
        //$img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        /*almacenar en la base de datos (sin modelos)
        DB::table('recetas')->insert([
            'titulo' =>$data['titulo'],
            'ingredientes'=>$data['ingredientes'],
            'preparacion'=>$data['preparacion'],
            'imagen' => $ruta_imagen,
            'user_id' =>Auth::user()->id,
            'categoria_id' =>$data['categoria']

        ]);
        */

        //alamacenar en la base de datos con modelo

        auth()->user()->recetas()->create([
            'titulo' =>$data['titulo'],
            'ingredientes'=>$data['ingredientes'],
            'preparacion'=>$data['preparacion'],
            'imagen' => $ruta_imagen,
            'categoria_id' =>$data['categoria']
        ]);
        
        //dd($request->all());

        //redireccionamos

        return redirect()->route('recetas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
    
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        /*llamamos al modelo de CategoriaReceta para recoger
        el id_categorias y el nombre de categorias*/

        $categorias = CategoriaReceta::all(['id','nombre']);
        

            //VISTAAAAA
        
        /*Pasamos la vista con los datos que recogimos al llamar al modelo
        despues de Compact tenemos que pasar el nombre de la variable anterior $categorias
        return view('recetas.edit', compact('categorias'));
        */

         /*Pasamos la vista con los datos que recogimos al llamar al modelo
        despues de Compact tenemos que pasar el nombre de la variable anterior $categorias
        en la function edit ya tenemos una instancia de $receta y le pasamos esa receta a la vista tambien
        */
        return view('recetas.edit', compact('categorias','receta'));
        


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //
    }
}
