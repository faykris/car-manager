// Manejar acciones del DOM
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const editButtons = document.querySelectorAll(".edit-btn");
    const createButton = document.querySelector(".create-btn");
    const goIndexButton = document.querySelector(".index-btn");

    // Volver al inicio
    if (goIndexButton) {
        goIndexButton.addEventListener("click", function () {
            window.location.href = `/cars`;
        });
    }

    // Mostrar pantalla crear
    if (createButton) {
        createButton.addEventListener("click", function () {
            window.location.href = `/cars/create`;
        });
    }

    // Mostrar pantalla editar
    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const carId = this.getAttribute("data-id");
            window.location.href = `/cars/${carId}/edit`;
        });
    });

    // Validar eliminar con modal SweetAlert
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const carId = this.getAttribute('data-id'); // Obtén el ID del carro
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action is not reversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
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
                                'Deleted!',
                                'Car deleted successfully.',
                                'success'
                            ).then(() => {
                                window.location.href = `/cars?page=1`;
                            });
                        } else {
                            Swal.fire(
                                'Error',
                                'The car is not deleted.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
});

// Mostrar mensaje existoso después de guardar y actualizar
function showSuccessMessage(message) {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: message,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Accept'
    });
}
