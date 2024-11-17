//Guardar estrellas del form de calificacion
let estrellasForm = 0

//Conocer ID de URL
let params = new URLSearchParams(location.search);
let id = params.get("id");

//Agregar al HTML la informacion del medio de entretenimiento aka Pelicula o Serie
function verInfoMedioCompleto(id) {
    //Llamado a API de TMDB
    //Info de la API: https://developer.themoviedb.org/docs/getting-started
    //Authorization hace referencia a la llave de API de TMDB
    $.ajax({
        url: `https://api.themoviedb.org/3/tv/${id}?language=es-CR`,
        type: 'GET',
        headers: {
            accept: "application/json",
            Authorization: `Bearer ${tmdbAPI}`
        },
        success: function (responseInfo) {
            document.title = responseInfo.original_name + " - Reseñas"
            //Seleccionar donde se escribira, en este caso, el div con ID infoPeli
            let escribir = $("#infoPeli");
            datos = `
                <h4 class="text-center">${responseInfo.original_name}</h4>
                <h6 class="text-center">(${responseInfo.name})</h6>
                <div class="d-flex justify-content-center">
                    <img src="https://image.tmdb.org/t/p/original/${responseInfo.poster_path}" alt="Poster_${responseInfo.original_title}" data-fancybox data-caption="Poster de ${responseInfo.original_title}" width="275px">
                </div>
                <br>
                <p class="text-center">Cantidad de episodios: ${responseInfo.number_of_episodes} <br> Cantidad de temporadas: ${responseInfo.number_of_seasons}</p>
                <p class="text-center">${responseInfo.overview}</p>`
            //Agregar FancyBox para poder ver la imagen en grande
            Fancybox.bind("[data-fancybox]")
            escribir.append(datos);
            //Recomendar la pelicula en base a la ID
            recomendarEnBaseAPelicula();
            //Informacion del modal, ubicado en 'Ver Mas'
            agregarInfoModal(responseInfo);
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
            //Poner un error 404 en caso de algun error
            vaciarHTML();
        }
    });
}

//Recomendar titulos similares en base a la pelicula de la review
function recomendarEnBaseAPelicula() {
    //Llamado a API de TMDB
    //Info de la API: https://developer.themoviedb.org/docs/getting-started
    //Authorization hace referencia a la llave de API de TMDB
    $.ajax({
        url: `https://api.themoviedb.org/3/tv/${id}/recommendations?language=es-CR&page=1`,
        type: 'GET',
        headers: {
            accept: "application/json",
            Authorization: `Bearer ${tmdbAPI}`
        },
        success: function (responseInfo) {
            console.log(responseInfo)
            //Iniciar codigo en null
            let codigo = "";
            //Mostrar solo 6 peliculas, series, etc.
            for (let index = 0; index < 7; index++) {
                //Variable de la pelicula recomendada
                const medio = responseInfo.results[index];

                //Codigo para solo poner dos titulos por fila
                if (index == 0 || (index % 2 === 0)) {
                    codigo = `<div class="row mb-3">`
                }
                codigo += `
                <div class="PosterRecomendados">
                    <a href="../views/verResennasSeries.php?id=${medio.id}">
                        <img src="https://image.tmdb.org/t/p/original/${medio.poster_path}" alt="Poster_${medio.name}" class="img-fluid">
                        <div class="nombrePosterRecomendados">
                            <p class="text-center">${medio.name}</p>
                        </div>
                    </a>
                </div>`
                //En caso de que sea la segunda recomendacion, cerrar div y agregarlo a recomendados
                if (index % 2 !== 0) {
                    codigo += `</div>`
                    $("#recomendados").append(codigo);
                }
            }
        },
        error: function (error) {
            //Solo imprimir error, no eliminar html
            console.log(error);
            return;
        }
    });
}

//Agregar info con respecto a info brindada. Se le pasa un JSON con la info
function agregarInfoModal(responseModal) {
    let agregarCodigo = $("#infoModal")
    let adulto = responseModal.adult ? "Si" : "No"
    let produccion = responseModal.in_production ? "Si" : "No"
    let codigoModal = `
    <div class="text-dark">
    <p>Es solo para adultos? ${adulto}</p>
    <p>Primera vez que se emitió: ${responseModal.first_air_date}</p>
    <p>Se sigue produciendo? ${produccion}</p>
    <p>Lenguaje original: ${responseModal.original_language}</p>
    <p>Pais de Origen: ${responseModal.origin_country[0]}</p>
    <p>Estado de la serie: ${responseModal.status}</p>
    <p>Calificacion general: ${responseModal.vote_average}</p>
    </div>
    `
    agregarCodigo.append(codigoModal);
}

//Funcion de como funcionaria en el futuro el tema de los comentarios
function agregarComentarios() {
    /*$.ajax({
        url: ``,
        type: 'GET',
        success: function (comentarios) {*/
    let comentarios = Math.random() * (4 - 0) + 0;
    //En caso de no haber comentarios, escribir que no existe y alentar al usuario que escriba una reseña
    if (comentarios == 0) {
        $("#comentariosUsuarios").append(`
            <div class="d-flex justify-content-center pt-5">
                <h1 class="text-light text-center">Todavia no hay opiniones sobre la pelicula. Escribe una reseña!</h1>
            </div>`)
    } else {
        for (let index = 0; index < comentarios; index++) {
            let comentario = `
                <section class="row" style="width: 100%; margin-bottom: 25px">
                <div class="col-2">`
                //Imagen
                comentario +=`
                <img src="./assets/img/ImagenPerfil.jpg" alt="" class="imgPerfil">
                </div>
                <div class="col" style="margin-top: 15px;">
                <p style="margin-bottom: 0px !important">`
                //Nombre de usuario
                comentario +=`
                <span class="FondoVerde border10" style="padding: 5px; margin-bottom: 0px !important" id="nombreUsuario1">Usuario1</span>
                <br>`
                //Hora de creacion
                comentario +=`
                <span class="form-text">Hace X tiempo</span>
                <div class="d-flex justify-content-center border10" style="background-color: #003344; width: 10rem">`;
            let estrellas = Math.random() * (5 - 1) + 1;
            //Por la calificacion que le dio el usuario, agregarle las estrellas debajo de su opinion
            for (let index = 0; index < estrellas; index++) {
                comentario += `<i class="bi bi-star-fill estrellaRellena h5 pe-2"></i>`
            }
            comentario += `</div>
                </p>
                <form action="./verComentarioUsuario.php?idComentario=1" method="POST">
                <div class="opinionUsuario">
                <input type="hidden" name="IDTipo" value="${id}">
                <input type="hidden" name="Tipo" value="2">
                <button class="text-start" style="
                	background: none;
                    color: inherit;
                    border: none;
                    padding: 0;
                    font: inherit;
                    cursor: pointer;
                    outline: inherit;
                ">`
                //Opinion
                comentario +=`
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem nostrum laboriosam optio veritatis,
                nobis, facilis autem quibusdam commodi earum saepe corrupti possimus exercitationem sint totam aliquid
                doloremque porro cupiditate quisquam.
                </button>
                </div>
                </form>
                </div>
                </section>`;

            $("#comentariosUsuarios").append(comentario);
        }
    }

    /*},
    error: function (error) {
        console.log(error);
        return;
    }
});*/
}

//En caso de haber algun error, se agrega un error 404
function vaciarHTML() {
    $("#informacionPelicula").empty();
    $('footer').addClass("fixed-bottom")
    $("#informacionPelicula").append(`
        <div class="d-flex justify-content-center pt-5">
            <h1 class="text-light">Error 404. No se encontro ninguna pelicula ;(</h1>
        </div>`)
    document.title = "Error 404."
}

//Cuando la pagina carga, ejecutar llamados
$(function () {
    //En caso de que la ID brindada (En linea 6) sea nula, tirar error.
    if (id == null) {
        vaciarHTML();
    } else {
        //Buscar informacion con la ID brindada
        verInfoMedioCompleto(id);
        agregarComentarios();
    }
});

//Agregar o quitar estrellas (graficamente)
$("input[type=radio][name=calificacion]").on("change", function () {
    if (estrellasForm > this.value) {
        for (let index = 5; index > (this.value - 1); index--) {
            $("#estrella" + index).removeClass("bi-star-fill");
            $("#estrella" + index).addClass("bi-star");
            $("#estrella" + index).removeClass("estrellaRellena");
        }
        estrellasForm = this.value;
    } else {
        for (let index = 0; index < this.value; index++) {
            $("#estrella" + index).addClass("estrellaRellena bi-star-fill");
            $("#estrella" + index).removeClass("bi-star");
        }
        estrellasForm = this.value;
    }
});

//Cuando se envia la opinion, atrapar por medio de esta funcion
$('#enviarOpinion').submit(function (event) {
    event.preventDefault();
    var formData = new FormData($("#enviarOpinion")[0]);

    //En caso de que el usuario no haya dado una calificacion, incitarlo a que lo haga.
    if ($("input[type=radio][name=calificacion]:checked").length == 0) {
        $("#validarCalificacion").append(`<p class="text-danger" style="margin-bottom: 23.9px;">Agrega una calificacion para enviar tu opinion!</p>`)
        $("#divBotonEnviar").removeClass("mt-5");
        return;
    } else {
        $("#divBotonEnviar").addClass("mt-5");
        $("#validarCalificacion").empty();
        //Seguir codigo de insercion dentro de controller de PHP
    }
    console.log(document.querySelector("input[type=radio][name=calificacion]:checked").value);
});