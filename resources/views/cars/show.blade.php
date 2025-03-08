@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalles del Carro</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                <p class="card-text">Año: {{ $car->year }}</p>
                <p class="card-text">Color: {{ $car->color }}</p>
                <p class="card-text">Precio: ${{ $car->price }}</p>
                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
