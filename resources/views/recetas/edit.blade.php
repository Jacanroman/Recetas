@extends('layouts.app')


@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('botones')

    <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2">Inicio</a>

@endsection

@section('content')

    {{--$receta--}}

    <h2 class="text-center mb-5">Editar Recetas: {{$receta->titulo}}</h2>

    

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <!--en action= route despues de poner el nombre de la ruta en el array el primer 'receta' es el mismo
            que tenemos en el controller y en el comodin de web.php -->
            <form method="POST" action="{{route('recetas.update',['receta' =>$receta->id])}}" enctype="multipart/form-data">
                @csrf

                <!--Como html no soporta PUT, PATCH, DELETE le tenemos que indicar
                mediante Laravel la operacion que vamos a realizar en este caso PUT-->
                @method('PUT')


                <div class="form-group">
                    <label for="titulo">Titulo Receta</label>
                    <input type="text" 
                        name="titulo" 
                        class="form-control @error('titulo') is-invalid @enderror" 
                        id="titulo" 
                        placeholder="Titulo Receta" 
                        value="{{$receta->titulo}}" />
                
                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria</label>

                    <select
                        name="categoria"
                        class="form-control @error('categoria') is-invalid @enderror"
                        id="categoria"
                    >
                        <option value="">-- Seleccione-</option>
                        @foreach($categorias as $categoria)
                            <option
                             value="{{$categoria->id}}"
                              {{$receta->categoria_id == $categoria->id ? 'selected' : ''}}>
                              {{$categoria->nombre}}</option>
                        @endforeach
                    </select>

                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for='preparacion'>Preparacion</label>
                    <input id='preparacion' type='hidden' name="preparacion" value='{{$receta->preparacion}}'/>
                    <trix-editor input='preparacion'></trix-editor>
                
                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for='ingredientes'>Ingredientes</label>
                    <input id='ingredientes' type='hidden' name="ingredientes" value='{{$receta->ingredientes}}'/>
                    <trix-editor input='ingredientes'></trix-editor>
                    
                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for='imagen'>Imagen</label>
                    <input 
                        id="imagen" 
                        type="file" 
                        class="form-control"
                        name="imagen"
                    />

                    <div class="mt-4">
                        <p>Imagen Actual:</p>

                        <img src="/recetaslaravel/storage/app/public/{{$receta->imagen}}" style="width: 300px" />
                    </div>
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Editar Receta" />
                </div>
            </form>
        </div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
@endsection