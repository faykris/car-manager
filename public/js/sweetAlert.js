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
