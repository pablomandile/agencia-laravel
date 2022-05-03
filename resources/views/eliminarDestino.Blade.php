@extends('layouts.plantilla')
    @section('contenido')
        <h1>Baja de un destino</h1>
        <div class="alert bg-light border-danger col-6 shadow-sm p-4 mx-auto">
            <form action="/eliminarDestino" method="post">
                @csrf
                Destino: <span class="lead">{{$destino->destNombre}} </span>
                <input type="hidden" name="destID" value="{{ $destino->destID }}">
                <input type="hidden" name="destNombre" value="{{ $destino->destNombre }}">
                <button class="btn btn-danger btn-block my-2">Confirmar baja</button>
                <a href="/adminDestinos" class="btn btn-outline-secondary btn-block my-2">Volver a panel</a>
            </form>
        </div>
        <script>
            Swal.fire(
                'Advertencia', 
                'Si pulsa Confirmar baja se eliminará la región seleccionada',
                'warning'
            )
        </script>
    @endsection