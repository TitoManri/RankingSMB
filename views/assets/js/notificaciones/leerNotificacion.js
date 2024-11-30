$(document).ready(function() {
    console.log("Página cargada.");

    $(document).on('change', '.leido', function() {
        const idNotificacion = $(this).attr('name');
        
        console.log("Estado del checkbox: ", $(this).is(':checked'));
        // Verificamos si el checkbox NO está marcado
        if ($(this).is(':checked')) {

            $.ajax({
                url: '../controllers/notificaciones.php',
                method: 'POST',
                data: {
                    op: 'leerNotificacion', 
                    idNotificacion: idNotificacion
                },
                dataType: 'json',
                success: function (respuesta) {
                    console.log("Notificación marcada como leída.");
                    location.reload(); 
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                }
            });
        } else {
            console.log("Checkbox marcado, no se realiza la acción.");
        }
    });
});
