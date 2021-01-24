@extends('layouts.app')


@section('botones')

    <a href="{{route('recetas.create')}}" class="btn btn-primary mr-2">Crear Receta</a>

@endsection
{{--esto de @section('content') indica que vamos a hacer 
a tener un bloque de codigo que vamos a meter dentro de content que 
esta dentro de layouts.app/app.blade.php @yeald('section')--}}
@section('content')

    <h2 class="text-center mb-5">Administra tus recetas</h2>


    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-ligth">
                <tr>
                    <th scole="col">Titulo</th>
                    <th scole="col">Categoria</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>

            
            <tbody>
                @foreach($recetas as $receta)
                <tr>
                    <td>{{$receta->titulo}}</td>
                    <td>{{$receta->categoria->nombre}}</td>
                    <td>
                        <form action="{{route('recetas.destroy', ['receta' => $receta->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger w-100 mb-2 d-block" value="Eliminar &times;" onclick="return confirm('Deseas Eliminar la receta?')"">
                        </form>

                        <a href="{{route('recetas.edit',['receta' => $receta->id])}}" class="btn btn-dark mb-2 d-block">Editar</a>
                        <!--Tenemos dos formas para hacer un href a un controlador
                        o con action poniendo la ruta completa y el controlador y la accion
                        <a href="{{--action('App\Http\Controllers\RecetaController@show',['receta' => $receta->id])--}}" class="btn btn-success mr-1">Ver</a>
                        
                        o con route y el alias (esta forma mejor)-->
                        <a href="{{route('recetas.show',['receta' => $receta->id])}}" class="btn btn-success mb-2 d-block">Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection