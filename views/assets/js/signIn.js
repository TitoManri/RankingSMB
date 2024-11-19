$(document).ready(function() {   
    $('#formRegistro').on('submit', function(e) {
        e.preventDefault();
        
        const contrasena = $('#contrasena').val();
        const confirmarContrasena = $('#confirmarContrasena').val();
        
        if (contrasena !== confirmarContrasena) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Las contraseñas no coinciden'
            });
            return;
        }
        const formData = new FormData(this);
        
        $.ajax({
            url: '../controllers/registro.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json', 
            success: function(data) {
                if (data.exito) {
                    $('#formRegistro').hide();
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso',
                        text: data.msg,
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = 'index.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.msg
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {                
                let errorMsg = 'Ocurrió un error al intentar registrar. Inténtalo de nuevo.';
                try {
                    let responseJson = JSON.parse(jqXHR.responseText);
                    errorMsg += ': ' + responseJson.msg;
                } catch (e) {
                    errorMsg += ': ' + errorThrown;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMsg
                });
            }
        });
    });
});