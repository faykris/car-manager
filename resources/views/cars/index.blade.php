@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Title and Add Car button -->
        <div class="row mb-5">
            <div class="col-12 col-md-9">
                <h3>Car List</h3>
            </div>
            <div class="col-12 col-md-3 d-flex justify-content-md-end">
                <button class="btn btn-primary create-btn" title="Agregar carro">
                    <i class="fa-solid fa-plus"></i> Add Car
                </button>
            </div>
        </div>
        <!-- Search form -->
        <form method="GET" action="{{ route('cars.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="brand" class="form-control" placeholder="Search by brand" value="{{ request('brand') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="model" class="form-control" placeholder="Search by model" value="{{ request('model') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">
                        Search
                    </button>
                    <button type="button" class="btn btn-secondary index-btn mx-2" title="Restaurar filtro">
                        Clear
                    </button>
                </div>
            </div>
        </form>
        <!-- Cars table -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Color</th>
                <th>Price</th>
                <th>Actions</th>
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
                        <!-- Edit button -->
                        <button class="btn-table-option edit-btn" data-id="{{ $car->id }}" title="Edit Car">
                            <i class="fa-solid fa-edit"></i>
                        </button>

                        <!-- Confirm delete with SweetAlert modal -->
                        <button class="btn-table-option delete-btn" data-id="{{ $car->id }}" title="Delete Car">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        <!-- Hidden form to compatibility with Laravel -->
                        <form id="delete-form-{{ $car->id }}" action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- No records message -->
        @if ($cars->isEmpty())
            <div class="alert alert-light text-center" role="alert">
                There is not car have been found or registered yet
            </div>
        @endif
        <!-- Paginator -->
        <div class="d-flex justify-content-center">
            {{ $cars->links() }}
        </div>
    </div>
@endsection
