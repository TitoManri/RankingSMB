//Guardar estrellas del form de calificacion
let estrellasForm = 0

//Conocer ID de URL
let params = new URLSearchParams(location.search);
let id = params.get("id");

//ObjectID
let IDContenido = "";

//Agregar al HTML la informacion del medio de entretenimiento aka Pelicula o Serie
function verInfoMedioCompleto(id) {
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
            document.title = responseInfo.title + " - Reseñas"
            let escribir = $("#infoPeli");
            datos = `
                <h4 class="text-center">${responseInfo.original_title}</h4>
                <h6 class="text-center">(${responseInfo.title})</h6>
                <h6 class="text-center">Fecha de salida: ${responseInfo.release_date}</h6>
                <div class="d-flex justify-content-center">
                    <img src="https://image.tmdb.org/t/p/original/${responseInfo.poster_path}" alt="Poster_${responseInfo.original_title}" data-fancybox data-caption="Poster de ${responseInfo.original_title}" width="275px">
                </div>
                <br>
                <p class="text-center">Duracion: ${responseInfo.runtime} minutos</p>
                <p class="text-center">${responseInfo.overview}</p>`
            //Agregar FancyBox para poder ver la imagen en grande
            Fancybox.bind("[data-fancybox]")
            escribir.append(datos);
            //Recomendar la pelicula en base a la ID
            recomendarEnBaseAPelicula();
            //Informacion del modal, ubicado en 'Ver Mas'
            agregarInfoModal(responseInfo, false);
            subirPeliculaEnBD(responseInfo, id)
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
            //Poner un error 404 en caso de algun error
            vaciarHTML();
        }
    });
}

function confirmarSiExistePeliculaEnBD(id) {
    $.ajax({
        url: `../controllers/peliculasController.php?op=existePeliculaEnBD`,
        type: 'POST',
        data: {
            ID_Pelicula: id
        },
        dataType: 'json',
        success: function (responseInfo) {
            console.log(responseInfo.msg)
            let existe = responseInfo.exito;
            if (existe) {
                verInfoMedioCompletoDesdeBD(responseInfo.object);
            } else {
                verInfoMedioCompleto(id);
            }
            agregarComentarios();
            return existe;
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
            //Poner un error 404 en caso de algun error
            return false;
        }
    });
}

function subirPeliculaEnBD(pelicula, id) {
    let generos = pelicula.genres;
    let estado = ""
    if(pelicula.status == "Released") estado = "Lanzada"
    else if(pelicula.status == "In Production") estado = "En produccion"
    else estado = "Estado desconocido"
    $.ajax({
        url: `../controllers/peliculasController.php?op=SubirPelicula`,
        type: 'POST',
        data: {
            ID_Pelicula: id,
            TituloOriginal: pelicula.original_title,
            TituloTraducido: pelicula.title,
            Generos: generos,
            Lanzamiento: pelicula.release_date,
            Sinopsis: pelicula.overview,
            Duracion: pelicula.runtime,
            Poster: `https://image.tmdb.org/t/p/original/${pelicula.poster_path}`,
            CostoPelicula: pelicula.budget,
            RecaudacionPelicula: pelicula.revenue,
            CalificacionGeneral: pelicula.vote_average,
            Estado: estado,
            Publico: pelicula.adult,
        },
        dataType: 'json',
        success: function (responseInfo) {
            IDContenido = pelicula._id.$oid;
            $("#IdContenido").val(responseInfo._id.$oid);
        },
        error: function (error) {
            console.error('Error al obtener la pelicula:', error);
        }
    });
}

//Agregar al HTML la informacion del medio de entretenimiento aka Pelicula o Serie
function verInfoMedioCompletoDesdeBD(pelicula) {
    //Llamado a API de TMDB
    //Info de la API: https://developer.themoviedb.org/docs/getting-started
    //Authorization hace referencia a la llave de API de TMDB

    //Seleccionar donde se escribira, en este caso, el div con ID infoPeli
    document.title = pelicula.TituloTraducido + " - Reseñas"
    const timestamp = parseInt(pelicula.Lanzamiento.$date.$numberLong, 10);
    const jsDate = new Date(timestamp);
    
    const day = String(jsDate.getDate()).padStart(2, '0');
    const month = String(jsDate.getMonth() + 1).padStart(2, '0');
    const year = jsDate.getFullYear();
    
    const fechaFinal = `${year}-${month}-${day}`;
    let escribir = $("#infoPeli");
    datos = `
                <h4 class="text-center">${pelicula.TituloOriginal}</h4>
                <h6 class="text-center">(${pelicula.TituloTraducido})</h6>
                <h6 class="text-center">Fecha de salida: ${fechaFinal}</h6>
                <div class="d-flex justify-content-center">
                    <img src="${pelicula.Poster}" alt="Poster_${pelicula.TituloOriginal}" data-fancybox data-caption="Poster de ${pelicula.TituloOriginal}" width="275px">
                </div>
                <br>
                <p class="text-center">Duracion: ${pelicula.Duracion} minutos</p>
                <p class="text-center">${pelicula.Sinopsis}</p>`
    //Agregar FancyBox para poder ver la imagen en grande
    Fancybox.bind("[data-fancybox]")
    escribir.append(datos);
    IDContenido = pelicula._id.$oid;
    $("#IdContenido").val(pelicula._id.$oid);
    //Recomendar la pelicula en base a la ID
    recomendarEnBaseAPelicula();
    //Informacion del modal, ubicado en 'Ver Mas'
    agregarInfoModal(pelicula, true);

}

//Recomendar titulos similares en base a la pelicula de la review
function recomendarEnBaseAPelicula() {
    //Llamado a API de TMDB
    //Info de la API: https://developer.themoviedb.org/docs/getting-started
    //Authorization hace referencia a la llave de API de TMDB
    $.ajax({
        url: `https://api.themoviedb.org/3/movie/${id}/recommendations?language=es-CR&page=1`,
        type: 'GET',
        headers: {
            accept: "application/json",
            Authorization: `Bearer ${tmdbAPI}`
        },
        success: function (responseInfo) {
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
                    <a href="../views/verResennasPelicula.php?id=${medio.id}">
                        <img src="https://image.tmdb.org/t/p/original/${medio.poster_path}" alt="Poster_${medio.title}" class="img-fluid">
                        <div class="nombrePosterRecomendados">
                            <p class="text-center">${medio.title}</p>
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
function agregarInfoModal(responseModal, tipo) {
    let agregarCodigo = $("#infoModal")
    let codigoModal = ``;

    if (tipo) {
        let adulto = ""
        if(responseModal.Publico === "true") adulto = "Si"
        else adulto = "No"
        let generos = ""
        let cantidadGeneros = 0;
        responseModal.Generos.forEach(genero => {
            cantidadGeneros++;
            generos += genero.name
            if (responseModal.Generos.length != cantidadGeneros) generos += ", ";
            else generos += ".";
        });

        codigoModal = `
        <div class="text-dark">
        <p>Es solo para adultos? ${adulto}</p>
        <p>Costo de la pelicula: ${responseModal.CostoPelicula} USD$</p>
        <p>Recaudacion de la pelicula: ${responseModal.RecaudacionPelicula} USD$</p>
        <p>Calificacion general: ${responseModal.CalificacionGeneral}</p>
        <p>Generos: ${generos}</p>
        <p>Estado de la pelicula: ${responseModal.Estado}</p>
        </div>
        `
    } else {
        let estado = ""
        if(responseModal.status == "Released") estado = "Lanzada"
        else if(responseModal.status == "In Production") estado = "En produccion"
        else estado = "Estado desconocido"
        let adulto = responseModal.adult ? "Si" : "No"
        let generos = ""
        let cantidadGeneros = 0;
        responseModal.genres.forEach(genero => {
            cantidadGeneros++;
            generos += genero.name
            if (responseModal.genres.length != cantidadGeneros) generos += ", ";
            else generos += ".";
        });

        codigoModal = `
        <div class="text-dark">
        <p>Es solo para adultos? ${adulto}</p>
        <p>Costo de la pelicula: ${responseModal.budget} USD$</p>
        <p>Recaudacion de la pelicula: ${responseModal.revenue} USD$</p>
        <p>Calificacion general: ${responseModal.vote_average}</p>
        <p>Generos: ${generos}</p>
        <p>Estado de la pelicula: ${estado}</p>
        </div>
        `
    }

    agregarCodigo.append(codigoModal);
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
        confirmarSiExistePeliculaEnBD(id)
    }
});
