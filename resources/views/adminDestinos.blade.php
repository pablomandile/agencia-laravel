@extends('layouts.plantilla')
    @section('contenido')

        <h1>Panel de administración de destinos</h1>
        
        <table class="table table-striped table-hover table-borderless">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Destino</th>
                    <th>Región</th>
                    <th>Precio</th>
                    <th colspan="2">
                        <a href="/agregarDestino" class="btn btn-dark">Agregar</a>
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach($destinos as $destino)
                <tr>
                    <td>{{$destino->destID}}</td>
                    <td>{{$destino->destNombre}}</td>
                    <td>{{$destino->regNombre}}</td>
                    <td>${{$destino->destPrecio}}</td>
                    <td><a href="/ModificarDestino/id" class="btn btn-outline-secondary">Modificar</a></td>
                    <td><a href="/EliminarDestino/id" class="btn btn-outline-secondary">Eliminar</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endsection