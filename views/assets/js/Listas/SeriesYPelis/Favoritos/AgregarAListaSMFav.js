$(document).ready(function () {
    $("#Favorito").click(function () {
        const idUsuario = $("#ID_Usuario").val(); // Obtenemos el valor de idUsuario
        const idPeliculaSerie = $("#Id_Peli").val(); // Obtenemos el valor de idPeliculaSerie
        
        $.ajax({
            url: "../controllers/listasSM.php?op=AgregarAFavoritosPelicula", // URL sin parámetros en la URL
            type: "POST", // Usamos POST para enviar los datos en el cuerpo
            data: {
                idUsuario: idUsuario, // Enviamos idUsuario como parámetro
                idPeliculaSerie: idPeliculaSerie // Enviamos idPeliculaSerie como parámetro
            },
            success: function (response) {
                console.log(response); // Verifica la respuesta
                alert("Registro insertado correctamente: " + response.message);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText); // Verifica la respuesta de error
                alert("Ocurrió un error: " + error);
            }
        });
    });
});
