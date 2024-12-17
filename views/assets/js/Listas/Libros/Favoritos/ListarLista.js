$(document).ready(function () {
    const idUsuario = $("#ID_Usuario").val();

    $.ajax({
        url: '../controllers/listasFavoritosL.php',
        type: 'POST',
        data: { op: 'ListarLibrosFavoritos', idUsuario: idUsuario },
        dataType: 'json', // Esta es la clave para que jQuery analice automáticamente la respuesta JSON

        success: function (response) {
            console.log(response);
            if (response.exito) {
                console.log(response.data);
                var peliculas = response.data;
                var contenedor = $('.container-Fav'); 
                contenedor.empty(); 

                peliculas.forEach(function (pelicula) {
                    contenedor.append(`
                        <div class="row">
                            <div class="col-12">
                                <div class="UnaLinea">
                                    <a data-fancybox class="imagen-1" href="${pelicula.Poster}" data-caption="${pelicula.Titulo}">
                                        <img class="imagen-2" src="${pelicula.Poster}" width="153" height="247" alt="${pelicula.Titulo}" />
                                    </a>
                                    <div class="todoBlanco">
                                        <p><strong>${pelicula.Titulo}</strong></p>
                                        <p>${pelicula.Sinopsis}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    `);
                });
            } else {
                console.error('Error al obtener las películas favoritas:', response.msg);
            }
        },
        error: function (xhr, error) {
            console.error('Error al realizar la solicitud:', error);
            console.error('Respuesta del servidor:', xhr.responseText);
        }
    });
});
