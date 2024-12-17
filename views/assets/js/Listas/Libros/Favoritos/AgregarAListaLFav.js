$(document).ready(function () {
    $("#Favorito").click(function () {
        //Variables de la vista
        const idUsuario = $("#IdUsuario").val(); 
        const idLibro = $("#Id_Libro").val(); 
        
        $.ajax({
            url: "../controllers/listasFavoritosL.php",
            type: "POST", 
            data: {
                op: 'AgregarAFavoritosLibro', 
                idUsuario: idUsuario, 
                idLibro: idLibro,
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
