@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Car</h1>
        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12 col-md-6 form-group">
                    <label for="brand">Brand</label>
                    <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ $car->brand }}">
                    @error('brand')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="model">Model</label>
                    <input type="text" name="model" class="form-control @error('model') is-invalid @enderror" value="{{ $car->model }}">
                    @error('model')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="year">Year</label>
                    <input type="number" name="year" class="form-control @error('year') is-invalid @enderror" value="{{ $car->year }}">
                    @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="color">Color</label>
                    <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" value="{{ $car->color }}">
                    @error('color')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ $car->price }}">
                    @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary index-btn mx-2" title="Volver al inicio">
                    <i class="fa-solid fa-arrow-left"></i> Go back
                </button>
                <button type="submit" class="btn btn-success" title="Actualizar carro">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
