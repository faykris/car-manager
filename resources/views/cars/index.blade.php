@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-12 col-md-9">
                <h3>Listado de Carros</h3>
            </div>
            <div class="col-12 col-md-3 d-flex justify-content-md-end">
                <button class="btn btn-primary create-btn" title="Agregar carro">
                    <i class="fa-solid fa-plus"></i> Agregar
                </button>
            </div>
        </div>

        <!-- Formulario de búsqueda -->
        <form method="GET" action="{{ route('cars.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="brand" class="form-control" placeholder="Buscar por Marca" value="{{ request('brand') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="model" class="form-control" placeholder="Buscar por Modelo" value="{{ request('model') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        Buscar
                    </button>
                    <button type="button" class="btn btn-secondary index-btn mx-2" title="Restaurar filtro">
                        Limpiar
                    </button>
                </div>
            </div>
        </form>

        <!-- Tabla de carros -->
        <table class="table table-striped">
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
                    <td>${{ $car->price }}</td>
                    <td>
                        <!-- Botón para editar -->
                        <button class="btn-table-option edit-btn" data-id="{{ $car->id }}" title="Editar">
                            <i class="fa-solid fa-edit"></i>
                        </button>

                        <!-- Botón para validar con SweetAlert -->
                        <button class="btn-table-option delete-btn" data-id="{{ $car->id }}" title="Eliminar">
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

        <div class="d-flex justify-content-center">
            {{ $cars->links() }}
        </div>
    </div>
@endsection
