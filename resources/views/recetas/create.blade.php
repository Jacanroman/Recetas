@extends('layouts.app')


@section('botones')

    <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2">Inicio</a>

@endsection
{{--esto de @section('content') indica que vamos a hacer 
a tener un bloque de codigo que vamos a meter dentro de content que 
esta dentro de layouts.app/app.blade.php @yeald('section')--}}
@section('content')

    <h2 class="text-center mb-5">Crear nueva  recetas</h2>

   

@endsection