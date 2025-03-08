@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Lista de Carros</h1>
        <a href="{{ route('cars.create') }}" class="btn btn-primary mb-3">Agregar Carro</a>

        <!-- Tabla de carros -->
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Color</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->color }}</td>
                    <td>{{ $car->price }}</td>
                    <td>
                        <!-- Botón para editar -->
                        <a href="{{ route('cars.edit', $car->id) }}" class="btn-table-option">
                            <i class="fa-solid fa-edit"></i>
                        </a>

                        <!-- Botón con SweetAlert -->
                        <button class="btn-table-option delete-btn" data-id="{{ $car->id }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        <!-- Formulario oculto para compatibilidad con Laravel -->
                        <form id="delete-form-{{ $car->id }}" action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
