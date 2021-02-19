<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img class="card-img-top" src="/recetaslaravel/storage/app/public/{{$receta->imagen}}" alt="imagen receta">
        <div class="card-body">
            <h3 class="card-title">{{$receta->titulo}}</h3>
            
            <div class="meta-receta d-flex justify-content-between">
                <p class="text-primary fecha font-weight-bold">
                    {{$receta->created_at}}
                </p>
                <p>{{count($receta->likes)}} Les gusto</p>
            </div>

            <p class="card-text">
                {{Str::words(strip_tags($receta->preparacion), 20, '...')}}
            </p>

            <a href="{{route('recetas.show', ['receta'=>$receta->id])}}"
                class="btn btn-primary d-block btn-receta">Ver Receta
            </a>
        </div>
    </div>
</div>  