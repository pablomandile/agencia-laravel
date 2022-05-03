@extends('layouts.plantilla')
    @section('contenido')
    
        <h1>Modificar un destino</h1>
        <div class="alert bg-light border-white col-8 mx-auto shadow rounded p-4">
            <form action="/modificarDestino" method="post">
            @csrf
                <label for="destNombre">Nombre del destino</label>
                <input type="text" name="destNombre" 
                        value="{{ $destino->destNombre }}" 
                        id="destNombre" class="form-control" required>
                <br>
                Región: <br>
                <select name="regID" class="form-control" required>
                {{-- @ if($region->regID == $destino->regID) selected @endif --}}
                <!-- y usando un condicional ternario -->
                {{-- {{ ($region->regID == $destino->regID) ? 'selected' : '' }} --}}
                    @foreach ($regiones as $region)
                    <option {{ ($region->regID == $destino->regID) ? 'selected' : '' }} value="{{ $region->regID }}">{{ $region->regNombre }}</option>
                    @endforeach
                </select>
                <br>
                Precio: <br>
                <input type="number" name="destPrecio" 
                        value="{{ $destino->destPrecio }}" class="form-control" required>
                <br>
                Asientos Totales: <br>
                <input type="number" name="destAsientos" 
                        value="{{ $destino->destAsientos }}" class="form-control" required>
                <br>
                Asientos Disponibles: <br>
                <input type="number" name="destDisponibles" 
                        value="{{ $destino->destDisponibles }}" class="form-control" required>
                <br>
                <input type="hidden" name="destID" value="{{ $destino->destID }}">
                <button class="btn btn-dark">Modificar</button>
                <a href="/adminDestinos" class="btn btn-outline-secondary ml-3">Volver a panel</a>
            </form>
        </div>

    @endsection 