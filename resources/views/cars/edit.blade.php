@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Carro</h1>
        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="brand">Marca</label>
                <input type="text" name="brand" class="form-control" value="{{ $car->brand }}" required>
            </div>
            <div class="form-group">
                <label for="model">Modelo</label>
                <input type="text" name="model" class="form-control" value="{{ $car->model }}" required>
            </div>
            <div class="form-group">
                <label for="year">Año</label>
                <input type="number" name="year" class="form-control" value="{{ $car->year }}" required>
            </div>
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" name="color" class="form-control" value="{{ $car->color }}" required>
            </div>
            <div class="form-group">
                <label for="price">Precio</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ $car->price }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
