$(document).ready(function() {   
    $('#formIniciarSesion').on('submit', function(e) {
        e.preventDefault();
        $('#hiddenContrasena').val($('#contrasena').val());
        const formData = new FormData(this);

        // Print the form data
        for (let [key, value] of formData.entries()) {
            console.log(key, value);
        }
        
        $.ajax({
            url: '../controllers/inicioSesion.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',  
            success: function(data) {
                if (data.exito) {
                    $('#formIniciarSesion').hide();
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: data.msg,
                    }).then(() => {
                        $(location).attr('href', 'perfil.php');
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.msg,
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {   
                console.log(jqXHR.responseText);             
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al intentar iniciar sesión. Inténtalo de nuevo.',
                });
            }
        });
    });
});
