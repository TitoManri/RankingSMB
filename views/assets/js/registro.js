
$(document).ready(function() {   
    $('#formRegistro').on('submit', function(e) {
        e.preventDefault();
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
                    $('#response').html('<div class="alert alert-success">' + data.msg + '</div>');
                    $(location).attr('href', 'logIn.php');
                } else {
                    $('#response').html('<div class="alert alert-danger">' + data.msg + '</div>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {                
                $('#response').html('<div class="alert alert-danger">Ocurrió un error al intentar registrar. Inténtalo de nuevo.: </div>' + errorThrown);
            }
        });
    });
});