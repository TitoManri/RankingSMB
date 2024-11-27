//Ajax que tira sweet alert si el inicio de sesion fue exitoso o no

$(document).ready(function() {   
    $('#formIniciarSesion').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: '../controllers/inicioSesion.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',  
            success: function(data) {
                if (data.exito) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: data.msg,
                    }).then(() => {
                        $(location).attr('href', 'index.php');
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
