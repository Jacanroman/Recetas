@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Ultimas Recetas</h2>

        <div class="">
            @foreach($nuevas as $nueva)
            <div class="col-md-4">
                <div class="card">
                    <img src="/recetaslaravel/storage/app/public/{{$nueva->imagen}}" class="card-img-top" alt="imagen receta">

                    <div class="card-body">
                        <h3>{{Str::title($nueva->titulo)}}</h3>
                        {{--para escapar el codigo html se usa !!
                            o si lo quieres eliminar usar strip_tags()--}}
                        <p>{{Str::limit(strip_tags($nueva->preparacion), 50)}}</p>

                        <a href="{{route('recetas.show', ['receta' =>$nueva->id])}}"
                            class="btn btn-primary d-block font-weight-bold text-uppercase"
                        >Ver Receta </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection