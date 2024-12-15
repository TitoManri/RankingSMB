$(document).ready(function() {
    $('#exampleModal').on('shown.bs.modal', function () {
        $('#actualizarPerfil').off('submit').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '../controllers/perfil.php?op=actualizarPerfil',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    try {
                        if (response.success) {
                            Swal.fire({
                                title: 'Actualización exitosa',
                                text: 'Se actualizaron los datos correctamente.',
                                icon: 'success',
                                confirmButtonText: 'Listo'
                            }).then(() => {
                                location.reload(true);
                            });
                        } else {
                            console.error('Error updating profile:', response.message);
                        }
                    } catch (e) {
                        console.error('Error parsing JSON response:', e);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error updating profile:', error);
                    console.error('Response text:', xhr.responseText);
                }
            });
        });
    });
});
