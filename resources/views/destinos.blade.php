@extends ('layouts.testPlantilla')
    @section('contenido')
        <h1>listado de destinos</h1>
        <ul class="list-group col-6 mx-auto">
            @foreach($destinos as $destino)
                <li class="list-group-item">{{$destino->destNombre}}</li>
            @endforeach
        </ul>
    @endsection