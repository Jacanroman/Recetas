@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2">Inicio</a>
@endsection


@section('content')
    {{--$perfil--}}

    <h1 class="text-center">Editar Mi Perfil</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form 
                action=""
            >
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" 
                        name="nombre" 
                        class="form-control @error('nombre') is-invalid @enderror" 
                        id="nombre" 
                        placeholder="Tu Nombre" 
                        {{--value="{{$perfil->nombre}}"--}} />
                
                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Sitio Web</label>
                    <input type="text" 
                        name="url" 
                        class="form-control @error('url') is-invalid @enderror" 
                        id="url" 
                        placeholder="Tu Sitio Web" 
                        {{--value="{{$perfil->url}}"--}} />
                
                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group mt-4">
                    <label for='biografia'>Biografia</label>
                    <input id='biografia' type='hidden' name="biografia"/>
                    <trix-editor input='preparacion'></trix-editor>
                
                    @error('biografia')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for='imagen'>Tu imagen</label>
                    <input 
                        id="imagen" 
                        type="file" 
                        class="form-control"
                        name="imagen"
                    />

                    @if($perfil->imagen)
                        <div class="mt-4">
                            <p>Imagen Actual:</p>

                            {{--<img src="/recetaslaravel/storage/app/public/{{$receta->imagen}}" style="width: 300px" />--}}
                        </div>

                        @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    @endif
                </div>
        </div>
    </div>
    
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
@endsection