@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h3>Add New Car</h3>
        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 col-md-6 form-group">
                    <label for="brand">Brand</label>
                    <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}">
                    @error('brand')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="model">Model</label>
                    <input type="text" name="model" class="form-control @error('model') is-invalid @enderror" value="{{ old('model') }}">
                    @error('model')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="year">Year</label>
                    <input type="number" name="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year') }}">
                    @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="color">Color</label>
                    <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color') }}">
                    @error('color')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                    @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary index-btn mx-2" title="Volver al inicio">
                    <i class="fa-solid fa-arrow-left"></i> Go back
                </button>
                <button type="submit" class="btn btn-primary" title="Guardar nuevo carro">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
