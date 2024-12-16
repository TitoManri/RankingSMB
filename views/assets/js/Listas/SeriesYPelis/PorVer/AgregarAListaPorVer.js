$(document).ready(function () {
    $("#PorVer").click(function () {
        const idUsuario = $("#ID_Usuario").val(); // Obtenemos el valor de idUsuario
        const idPeliculaSerie = $("#Id_Peli").val(); // Obtenemos el valor de idPeliculaSerie
        
        $.ajax({
            url: "../controllers/listasPorVerSM.php", // URL sin parámetros en la URL
            type: "POST", // Usamos POST para enviar los datos en el cuerpo
            data: {
                op: 'AgregarAPorVerPelicula', // Enviamos la operación como parámetro
                idUsuario: idUsuario, // Enviamos idUsuario como parámetro
                idPeliculaSerie: idPeliculaSerie // Enviamos idPeliculaSerie como parámetro
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
