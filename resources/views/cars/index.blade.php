<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lista de Carros</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
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
                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">Editar</a>

                    <!-- Botón con SweetAlert -->
                    <button class="btn btn-danger delete-btn" data-id="{{ $car->id }}">Eliminar</button>

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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script para manejar la eliminación con SweetAlert -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const carId = this.getAttribute('data-id'); // Obtén el ID del carro
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/cars/${carId}`, {
                            method: 'POST', // Laravel requiere que se use POST con _method DELETE
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ _method: 'DELETE' }) // Indica a Laravel que es DELETE
                        }).then(response => {
                            if (response.ok) {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El carro ha sido eliminado.',
                                    'success'
                                ).then(() => {
                                    window.location.reload(); // Recarga la página
                                });
                            } else {
                                Swal.fire(
                                    'Error',
                                    'No se pudo eliminar el carro.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    });

</script>
</body>
</html>
