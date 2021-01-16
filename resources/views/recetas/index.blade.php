@extends('layouts.app')

{{--esto de @section('content') indica que vamos a hacer 
a tener un bloque de codigo que vamos a meter dentro de content que 
esta dentro de layouts.app/app.blade.php @yeald('section')--}}
@section('content')

<h1>Recetas</h1>
@foreach($recetas as $receta)
<li>{{$receta}} </li>
    
@endforeach


<h1>Categorias</h1>
@foreach($categorias as $categoria)

<li>{{$categoria}}</li>

@endforeach

@endsection