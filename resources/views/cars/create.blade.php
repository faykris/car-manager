@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Agregar Carro</h1>
        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="brand">Marca</label>
                <input type="text" name="brand" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="model">Modelo</label>
                <input type="text" name="model" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="year">Año</label>
                <input type="number" name="year" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" name="color" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Precio</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
