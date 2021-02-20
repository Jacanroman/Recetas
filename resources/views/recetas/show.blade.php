@extends('layouts.app')


@section('content')

    {{--<h1>{{$receta}}</h1>--}}

    <article class="contenido-receta bg-white p-5 shadow">
        <h1 class="text-center mb-4">{{$receta->titulo}}</h1>

        <div class="imagen-receta">
            <img src="/recetaslaravel/storage/app/public/{{$receta->imagen}}" class="w-100">
            
        </div>

        <div class="receta-meta mt-3">
            <p>
                <span class="font-weight-bold text primary">Escrito en:</span>
                
                <a class="text-dark" href="{{route('categorias.show', ['categoriaReceta' => $receta->categoria->id])}}">
                    {{$receta->categoria->nombre}} 
                </a>
                
                
            </p>

            <p>
                <span class="font-weight-bold text primary">Autor:</span>
                {{--TODO SHOW EL NAME OF THE USER--}}
                <a class="text-dark" href="{{route('perfiles.show', ['perfil' => $receta->autor->id])}}">
                    {{$receta->autor->name}}
                </a>
                
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
                
            <div class="justify-content-center text-center" >
                @if($like)
                    <span class="like-btn like-active" onclick="LikeReceta('{{$receta->id}}')"></span>
                @else
                    <span class="like-btn" onclick="LikeReceta('{{$receta->id}}')"></span>
                @endif

                <p>{{$likes}} Les gusto esta receta</p>
            </div>
        </div>
    </article> 
    <script>
        
        function LikeReceta(recetaId){
            //console.log("Diste me gusta: ",recetaId);
            axios.post('http://localhost/recetaslaravel/public/recetas/'+recetaId)
            //axios.post('/recetas/'+recetaId)
                .then(respuesta =>{
                    if(respuesta.data.attached.length > 0){
                       console.log(respuesta.data);
                    }else{
                        console.log("adios");
                    }
                })
                .catch(error =>{
                    if(error.response.status === 401){
                        window.location = 'http://localhost/recetaslaravel/public/register';
                    }
                });
        }
    </script>
@endsection