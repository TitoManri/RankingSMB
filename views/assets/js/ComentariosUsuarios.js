//Conocer ID de URL
let params = new URLSearchParams(location.search);
let id = params.get("id");

console.log(idTipo);

console.log(Tipo);

function verInfoMedioCompletoPelicula(id) {
    //Llamado a API de TMDB
    //Info de la API: https://developer.themoviedb.org/docs/getting-started
    //Authorization hace referencia a la llave de API de TMDB
    $.ajax({
        url: `https://api.themoviedb.org/3/movie/${id}?language=es-CR`,
        type: 'GET',
        headers: {
            accept: "application/json",
            Authorization: `Bearer ${tmdbAPI}`
        },
        success: function (responseInfo) {
            //Seleccionar donde se escribira, en este caso, el div con ID infoPeli
                let escribir = $("#infoPeli");
                datos = `
                <h4 class="text-center">${responseInfo.original_title}</h4>
                <h6 class="text-center">(${responseInfo.title})</h6>
                <div class="d-flex justify-content-center">
                    <img src="https://image.tmdb.org/t/p/original/${responseInfo.poster_path}" alt="Poster_${responseInfo.original_title}" data-fancybox data-caption="Poster de ${responseInfo.original_title}" width="275px">
                </div>
                <br>
                <p class="text-center">Duracion: ${responseInfo.runtime} minutos</p>
                <p class="text-center">${responseInfo.overview}</p>`
                //Agregar FancyBox para poder ver la imagen en grande
                Fancybox.bind("[data-fancybox]")
                escribir.append(datos);
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
            //Poner un error 404 en caso de algun error
            vaciarHTML();
        }
    });
}

function verInfoMedioCompletoSeries(id) {
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
            console.log(responseInfo)
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
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
            //Poner un error 404 en caso de algun error
            vaciarHTML();
        }
    });
}

function verInfoMedioCompletoLibro(id) {
    //Llamado a API de TMDB
    //Info de la API: https://developer.themoviedb.org/docs/getting-started
    //Authorization hace referencia a la llave de API de TMDB
    $.ajax({
        url: `https://www.googleapis.com/books/v1/volumes/${id}?key=${googleAPI}&langRestrict=es-CR`,
        type: 'GET',
        success: function (responseInfo) {
            document.title = responseInfo.volumeInfo.title + ". Reseñas"
            console.log(responseInfo)
            //Seleccionar donde se escribira, en este caso, el div con ID infoPeli
            let escribir = $("#infoPeli");
            datos = `
                        <h4 class="text-center">${responseInfo.volumeInfo.title}</h4>
                        <div class="d-flex justify-content-center">
                            <img src="${responseInfo.volumeInfo.imageLinks.smallThumbnail}" alt="Poster_${responseInfo.volumeInfo.title}" data-fancybox data-caption="Poster de ${responseInfo.volumeInfo.title}" width="275px">
                        </div>
                        <br>
                        <p class="text-center">Cantidad de paginas: ${responseInfo.volumeInfo.pageCount} paginas</p>
                        <p class="text-center">Autor: ${responseInfo.volumeInfo.authors[0]}</p>
                        <div style="font-size: 14px;">
                        <p class="text-center">${responseInfo.volumeInfo.description}</p>
                        </div>`
            //Agregar FancyBox para poder ver la imagen en grande
            Fancybox.bind("[data-fancybox]")
            escribir.append(datos);
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
            //Poner un error 404 en caso de algun error
            vaciarHTML();
        }
    });
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

function agregarComentariosDeOpinion(id) {
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
                <div class="col-2">
                <img src="./assets/img/ImagenPerfil.jpg" alt="" class="imgPerfil">
                </div>
                <div class="col" style="margin-top: 15px;">
                <p style="margin-bottom: 0px !important">
                <span class="FondoVerde border10" style="padding: 5px; margin-bottom: 0px !important" id="nombreUsuario1">Usuario1</span>
                <br>
                <span class="form-text">Hace X tiempo</span>
                </p>
                <br>
                <div class="opinionUsuario">
                <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem nostrum laboriosam optio veritatis,
                nobis, facilis autem quibusdam commodi earum saepe corrupti possimus exercitationem sint totam aliquid
                doloremque porro cupiditate quisquam.
                </p>
                </div>
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

function agregarOpinion(id) {
    /*$.ajax({
        url: ``,
        type: 'GET',
        success: function (comentarios) {*/
    let comentarios = Math.random() * (4 - 0) + 0;
    //En caso de no haber comentarios, escribir que no existe y alentar al usuario que escriba una reseña
            let comentario = `
                            <div class=" d-flex justify-content-center">
                            <div class="row" style="background-color: #B1B2B5; width: 35rem; border-radius: 15px;">
                                <br>
                                <div class="col-1" style="margin-right: 2rem;">`
            //Imagen
            comentario += `
            <img src="./assets/img/ImagenPerfil.jpg" alt="" class="imgPerfil">
            </div>`
            comentario += `
                                <div class="col-3" style="margin-top: 2vh;">
                                    <p style="margin-bottom: 0px !important">
                                        <span class="FondoVerde border10" style="padding: 5px; margin-bottom: 0px !important" id="nombreUsuario1">Usuario1</span>
                                        <br>`
            //Tiempo
            comentario += `
            <span class="form-text">Hace X tiempo</span>
            </p>
            </div>`

            comentario += `
                                <div class="col-2" style="margin-top: 2vh;">
                                    <div class="d-flex justify-content-center border10" style="background-color: #003344; width: 30vh; height: 5vh;" id="estrellasOpinion">
            `
            //Estrellas
            let estrellas = Math.random() * (5 - 1) + 1;
            for (let index = 0; index < estrellas; index++) {
                comentario += `<i class="bi bi-star-fill estrellaRellena h3 me-2"></i>`
            }
            comentario += `
            </div>
            </div>
            <br>
            <div style="width: 85%; margin-left: 2rem">
            <div class="opinionUsuario">`
            //Opinion
            comentario += `<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas fugiat odit repudiandae expedita molestiae! Itaque voluptate, enim voluptates odit rem, ullam doloribus incidunt sequi, qui dolore aspernatur quia laboriosam aut?</p>
            `
            comentario +=`
            </div>
            <br>
            </div>
            <br>
            </div>
            </div>`;

            $("#comentarioOriginal").append(comentario);
        }
    

    /*},
    error: function (error) {
        console.log(error);
        return;
    }
});*/


//Cuando la pagina carga, ejecutar llamados
$(function () {
    //En caso de que la ID brindada (En linea 6) sea nula, tirar error.
    if (idTipo == null && id==null) {
        vaciarHTML();
    } else {
        //Buscar informacion con la ID brindada
        //Filtrar por tipo
        if(Tipo=="1"){
            verInfoMedioCompletoPelicula(idTipo);
        }else if(Tipo=="2"){
            verInfoMedioCompletoSeries(idTipo);
        }else if(Tipo=="3"){
            verInfoMedioCompletoLibro(idTipo);
        }else{
            vaciarHTML();
        }
        agregarOpinion(id);
        agregarComentariosDeOpinion(id);
    }
});

//Cuando se envia el comentario, atrapar por medio de esta funcion
$('#enviarComentario').submit(function (event) {
    event.preventDefault();
    var formData = new FormData($("#enviarComentario")[0]);
    let comentario = $("textarea#comentario").val();
    
    //En caso de que el usuario no haya dado una calificacion, incitarlo a que lo haga.
    if (comentario == "") {
        $("#validarCalificacion").append(`<p class="text-danger" style="margin-bottom: 23.9px;">Escribe un comentario para agregarlo a la opinion!</p>`)
        $("#divBotonEnviar").removeClass("mt-5");
        return;
    } else {
        $("#divBotonEnviar").addClass("mt-5");
        $("#validarCalificacion").empty();
        //Seguir codigo de insercion dentro de controller de PHP
    }
});
