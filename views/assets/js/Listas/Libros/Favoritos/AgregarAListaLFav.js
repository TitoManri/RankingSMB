$(document).ready(function () {
    $("#Favorito").click(function () {
        const idUsuario = $("#IdUsuario").val(); // Obtenemos el valor de idUsuario
        const idLibro = $("#Id_Libro").val(); // Obtenemos el valor de idPeliculaSerie
        
        $.ajax({
            url: "../controllers/listasFavoritosL.php", // URL sin parámetros en la URL
            type: "POST", // Usamos POST para enviar los datos en el cuerpo
            data: {
                op: 'AgregarAFavoritosLibro', // Enviamos la operación como parámetro
                idUsuario: idUsuario, // Enviamos idUsuario como parámetro
                idLibro: idLibro // Enviamos idPeliculaSerie como parámetro
            },
            success: function (response) {
                console.log(response); // Verifica la respuesta
                if (response.status === "success") {
                    alert("Registro insertado correctamente: " + response.message);
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText); // Verifica la respuesta de error
                alert("Ocurrió un error: " + error);
            }
        });
    });
});
