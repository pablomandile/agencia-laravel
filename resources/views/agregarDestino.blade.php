@extends('layouts.plantilla')
    @section('contenido')

        <h1>Alta de un nuevo destino</h1>
        <div class="alert bg-light shadow-sm col-8 mx-auto p-4">
            <form action="/agregarDestino" method="post">
                @csrf
                <label for="destNombre">Nombre del destino</label>
                <input type="text" name="destNombre" id="destNombre" class="form-control">
                <br>
                <button class="btn btn-dark">Agregar destino</button>
                <a href="/adminDestinos" class="btn btn-outline-secondary ml-3">Volver a panel Destinos</a>
            </form>
        </div>

    @endsection 