//Ajax que tira sweet alert si el registro fue exitoso o no

//Cuando el documento este listo y cargado en la pagina
$(document).ready(function() {   
    //Cuando se envie el formulario de registro
    $('#formRegistro').on('submit', function(e) {
        //Evita que se recargue la pagina
        e.preventDefault();
        //Crea un objeto FormData con los datos del formulario
        const formData = new FormData(this);
        //Envia los datos del formulario al controlador de registro
        $.ajax({
            //Controlador
            url: '../controllers/registro.php',
            //Metodo GET,POST,DELETE,PUT 
            //1. GET: Obtener
            //2. POST: Enviar
            //3. DELETE: Eliminar
            //4. PUT: Actualizar
            type: 'POST',
            //Datos que se enviaran al controlador (Se envia en array, objeto o json)
            data: formData,
            //No se necesita cache
            contentType: false,
            //No se necesita procesar datos
            processData: false,
            //Tipo de datos que se espera recibir del controlador
            dataType: 'json', 
            //Si la peticion fue exitosa
            success: function(data) {
                //Si el registro fue exitoso
                if (data.exito) {
                    //Muestra un mensaje de exito
                    $('#response').html('<div class="alert alert-success">' + data.msg + '</div>');
                    //Redirecciona a la pagina de login
                    $(location).attr('href', 'logIn.php');
                } else {
                    //Muestra un mensaje de error
                    $('#response').html('<div class="alert alert-danger">' + data.msg + '</div>');
                }
            },
            //Si la peticion fallo general, desde el controllador o modelo
            error: function(jqXHR, textStatus, errorThrown) {                
                $('#response').html('<div class="alert alert-danger">Ocurrió un error al intentar registrar. Inténtalo de nuevo.: </div>' + errorThrown);
            }
        });
    });
});