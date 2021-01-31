@extends('layouts.app')


@section('content')

    {{--<h1>{{$receta}}</h1>--}}

    <article class="contenido-receta">
        <h1 class="text-center mb-4">{{$receta->titulo}}</h1>

        <div class="imagen-receta">
            <img src="/recetaslaravel/storage/app/public/{{$receta->imagen}}" class="w-100">
            
        </div>

        <div class="receta-meta mt-2">
            <p>
                <span class="font-weight-bold text primary">Escrito en:</span>
                {{$receta->categoria->nombre}}
            </p>

            <p>
                <span class="font-weight-bold text primary">Autor:</span>
                {{--TODO SHOW EL NAME OF THE USER--}}
                {{$receta->autor->name}}
            </p>

            <p>
                <span class="font-weight-bold text primary">Fecha:</span>
                
                {{$receta->created_at}}
            </p>
            <div class="ingredientes">
                <h2 class="my-3 text-primary">Ingredientes</h2>
                {!!$receta -> ingredientes!!}
            </div>

            <div class="preparacion">
                <h2 class="my-3 text-primary">Preparacion</h2>
                {!!$receta -> preparacion!!}
            </div>
                
            <div >
                @if($like)
                    <span class="like-btn like-active" onclick="LikeReceta('{{$receta->id}}')"></span>
                @else
                    <span class="like-btn" onclick="LikeReceta('{{$receta->id}}')"></span>
                @endif
            </div>
        </div>
    </article> 
    <script>
        function LikeReceta(recetaId){
            //console.log("Diste me gusta: ",recetaId);
            axios.post('http://localhost/recetaslaravel/public/recetas/'+recetaId)
            //axios.post('/recetas/'+recetaId)
                .then(respuesta =>{
                    console.log(respuesta)
                })
                .catch(error =>{
                    console.log(error);
                });
        }
    </script>
@endsection