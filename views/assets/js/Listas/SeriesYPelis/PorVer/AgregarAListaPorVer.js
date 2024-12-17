$(document).ready(function () {
    $("#PorVer").click(function () {
        //Variables de la vista
        const idUsuario = $("#IdUsuario").val(); 
        const idPeliculaSerie = $("#Id_Peli").val(); 
        
        $.ajax({
            url: "../controllers/listasPorVerSM.php", 
            type: "POST", 
            data: {
                op: 'AgregarAPorVerPelicula', 
                idUsuario: idUsuario, 
                idPeliculaSerie: idPeliculaSerie
            },
            success: function (response) {
                if (response.status === "success") {
                    Swal.fire({
                        title: "¡Éxito!",
                        text: response.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error",
                        confirmButtonText: "Cerrar"
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title: "Ocurrió un error",
                    text: "Detalles: " + error,
                    icon: "error",
                    confirmButtonText: "Cerrar"
                });
            }
        });
    });
});
