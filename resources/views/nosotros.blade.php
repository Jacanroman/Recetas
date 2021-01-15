<h1>Desde nosotros.blade.php </h1>

{{ 1 + 1}}

@php

$variable = 20;

echo "$variable";

@endphp

{{$variable}}


@if ($variable===20)

    {{"si es 20"}}
@endif

