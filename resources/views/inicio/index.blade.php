@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
@endsection

@section('hero')
    <div class="hero-categorias">
        <form class="container h-50" action={{route('buscar.show')}}>
            <div class="row h-50 align-items-center">
                <div class="col-md-8 texto-buscar">
                    <p class="display-4">Encuentra una receta para tu proxima comida</p>

                    <input
                        type="search"
                        name="buscar"
                        class="form-control"
                        placeholder="Buscar Receta"
                    />
                </div>
            </div>
        </form>
    </div>

@endsection

@section('content')

    {{--Para agregar imagenes estaticas
    <img src="{{url('/images/image.png')}}" alt="imagen fondo">
    o tambien se puede en vez de usar url usar asset
    <img src="{{asset('/images/image.png')}}" alt="imagen fondo">
    --}}
    
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mb-4">Ultimas Recetas</h2>

        <div class="owl-carousel owl-theme">
            @foreach($nuevas as $nueva)
            
                <div class="card">
                    <img src="/recetaslaravel/storage/app/public/{{$nueva->imagen}}" class="card-img-top" alt="imagen receta">

                    <div class="card-body">
                        <h3>{{Str::title($nueva->titulo)}}</h3>
                        {{--para escapar el codigo html se usa !!
                            o si lo quieres eliminar usar strip_tags()--}}
                        <p>{{Str::words(strip_tags($nueva->preparacion), 15)}}</p>

                        <a href="{{route('recetas.show', ['receta' =>$nueva->id])}}"
                            class="btn btn-primary d-block font-weight-bold text-uppercase"
                        >Ver Receta </a>
                    </div>
                </div>
            
            @endforeach
        </div>
    </div>

    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Recetas mas Votadas</h2>

        <div class="row">
                @foreach($votadas as $receta)
                    @include('ui.receta')
                @endforeach
        </div>
    </div>

    @foreach($recetas as $key => $grupo)
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mt-5 mb-4">{{str_replace('-',' ',$key)}}</h2>

            <div class="row">
                @foreach($grupo as $recetas)
                    @foreach($recetas as $receta)
                        @include('ui.receta')
                    @endforeach
                @endforeach
            </div>
        </div>
   @endforeach
@endsection