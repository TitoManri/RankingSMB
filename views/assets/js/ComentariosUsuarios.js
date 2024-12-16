//Conocer ID de URL
let params = new URLSearchParams(location.search);
let idOpinion = params.get("opinion");

function agregarComentariosDeOpinion(OID) {
    $.ajax({
        url: `../controllers/comentariosController.php?op=ListarComentarios`,
        type: 'POST',
        data: {
            IdReseña: OID
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            let comentarios = data.object;
            if (comentarios == null) {
                $("#comentariosUsuarios").append(`
                    <div class="d-flex justify-content-center pt-5">
                        <h1 class="text-light text-center">Todavia no hay comentarios sobre la reseña. Escribe un comentario!</h1>
                    </div>`)
            } else {
                comentarios.forEach(comentario => {
                    const timestamp = parseInt(comentario.Fecha.$date.$numberLong, 10);
                    const jsDate = new Date(timestamp);

                    const fechaFinal = tiempoDesde(new Date(Date.now()), jsDate);
                    let comentarioPegar = `
                    <section class="row" style="width: 100%; margin-bottom: 25px">
                    <div class="col-1" style="width: 6rem;">
                    <img src="./assets/img/default.jpg" alt="" class="imgPerfil">
                    </div>
                    </div>
                    <div class="col" style="margin-top: 15px;">
                    <p style="margin-bottom: 0px !important">
                    <span class="FondoVerde border10" style="padding: 5px; margin-bottom: 0px !important" id="nombreUsuario1">${comentario.usuarioInfo.NombredeUsuario}</span>
                    <br>
                    <span class="form-text">Hace ${fechaFinal}</span>
                    </p>
                    <br>
                    <div class="opinionUsuario">
                    <p>
                    ${comentario.TextoComentario}
                    </p>
                    </div>
                    </div>
                    </section>`;
    
                $("#comentariosUsuarios").append(comentarioPegar);
                });
            }
        },
        error: function (error) {
            console.log(error);
            return;
        }
    })
}

function tiempoDesde(current, previous) {

    var msPerMinute = 60 * 1000;
    var msPerHour = msPerMinute * 60;
    var msPerDay = msPerHour * 24;
    var msPerMonth = msPerDay * 30;
    var msPerYear = msPerDay * 365;

    var elapsed = current - previous;

    if (elapsed < msPerMinute) {
        if (Math.round(elapsed / 1000) == 1) {
            return Math.round(elapsed / 1000) + ' segundo';
        }
        return Math.round(elapsed / 1000) + ' segundos';
    }

    else if (elapsed < msPerHour) {
        if (Math.round(elapsed / msPerMinute) == 1) {
            return Math.round(elapsed / msPerMinute) + ' minuto';
        }
        return Math.round(elapsed / msPerMinute) + ' minutos';
    }

    else if (elapsed < msPerDay) {
        if (Math.round(elapsed / msPerHour) == 1) {
            return Math.round(elapsed / msPerHour) + ' hora';
        }
        return Math.round(elapsed / msPerHour) + ' horas';
    }

    else if (elapsed < msPerMonth) {
        if (Math.round(elapsed / msPerDay) == 1) {
            return '1 día';
        }
        return 'aproximadamente ' + Math.round(elapsed / msPerDay) + ' días';
    }

    else if (elapsed < msPerYear) {
        if (Math.round(elapsed / msPerMonth) == 1) {
            return 'aproximadamente ' + Math.round(elapsed / msPerMonth) + ' mes';
        }
        return 'aproximadamente ' + Math.round(elapsed / msPerMonth) + ' meses';
    }

    else {
        if (Math.round(elapsed / msPerYear) == 1) {
            return 'aproximadamente ' + Math.round(elapsed / msPerYear) + ' año';
        }
        return 'aproximadamente ' + Math.round(elapsed / msPerYear) + ' años';
    }
}

function agregarOpinion(id) {
    $.ajax({
        url: "../controllers/resennasController.php?op=conseguirResennaPorID",
        type: "POST",
        data: {
            IDResenna: id
        },
        dataType: 'json',
        success: function (data) {
            let opinion = data.object;
            let resenna = "";
            const timestamp = parseInt(opinion.FechaModificacion.$date.$numberLong, 10);
            const jsDate = new Date(timestamp);

            const fechaFinal = tiempoDesde(new Date(Date.now()), jsDate);
            resenna += `<div class=" d-flex justify-content-center" id="comentarioOriginal">
                            <div class=" row" style="background-color: #B1B2B5; width: 35rem; border-radius: 15px;">
                                <br>
                                <div class="col-1" style="margin-right: 2rem;">
                                    <img src="./assets/img/${opinion.usuarioInfo.FotodePerfil}" alt="FotoDePerfil_Usuario" class="imgPerfil">
                                </div>
                                <div class="col-3" style="margin-top: 2vh;">
                                    <p style="margin-bottom: 0px !important">
                                        <span class="FondoVerde border10" style="padding: 5px; margin-bottom: 0px !important" id="nombreUsuario1">Usuario1</span>
                                        <br>
                                        <span class="form-text">Hace ${fechaFinal}</span>
                                    </p>
                                </div>
                                <div class="col-2" style="margin-top: 2vh;">
                                
                                    <div class="d-flex justify-content-center border10" style="background-color: #003344; width: 30vh; height: 5vh;" id="estrellasOpinion">`
            for (let index = 0; index < opinion.Calificacion; index++) {
                resenna += `<i class="bi bi-star-fill estrellaRellena h3 me-2"></i>`
            }
            resenna += `
                                    </div>
                                </div>

                                <br>
                                <div style="width: 85%; margin-left: 2rem">
                                    <div class="opinionUsuario">
                                        <p>${opinion.Opinion}</p>
                                    </div>
                                    <br>
                                </div>
                                <br>
                            </div>
                        </div>`
            $("#comentarioOriginal").append(resenna);
            let medioID = opinion.IdContenido.$oid;
            if (opinion.TipoContenido == 1) {
                verPeliculaDesdeBD(medioID);
            } else if (opinion.TipoContenido == 2) {
                verSerieDesdeBD(medioID);
            } else if (opinion.TipoContenido == 3) {
                verLibroDesdeBD(medioID);
            } else {
                console.log("Error");
            }
            $("#IdReseña").val(opinion._id.$oid);
            agregarComentariosDeOpinion(opinion._id.$oid);

        },
        error: function (data) {
            console.log(data);
        }
    });
}

function verLibroDesdeBD(OID) {

    $.ajax({
        url: `../controllers/librosController.php?op=obtenerLibroDeOID`,
        type: "POST",
        data: {
            id: OID
        },
        dataType: 'json',
        success: function (data) {
            let libro = data.object;
            let escribir = $("#infoPeli");
            datos = `
                                <h4 class="text-center">${libro.Titulo}</h4>
                                <div class="d-flex justify-content-center">
                                    <img src="https://books.google.com/books/publisher/content/images/frontcover/${libro.ID_Libro}?fife=w400-h600&source=gbs_api" alt="Poster_${libro.Titulo}" data-fancybox data-caption="Poster de ${libro.Titulo}" width="275px">
                                </div>
                                <br>
                                <p class="text-center">Cantidad de paginas: ${libro.TotalPaginas} paginas</p>
                                <p class="text-center">Autor: ${libro.Autor}</p>
                                <div style="font-size: 14px;">
                                <p class="text-center">${libro.Sinopsis}</p>
                                </div>`
            //Agregar FancyBox para poder ver la imagen en grande
            Fancybox.bind("[data-fancybox]")
            escribir.append(datos);
            $("#VolverAlContenido").attr("href", `./verResennasLibro.php?id=${libro.ID_Libro}`);
        }, error: function (error) {
            console.log(error)
        }
    });
}

//Agregar al HTML la informacion del medio de entretenimiento aka Pelicula o Serie
function verPeliculaDesdeBD(OID) {
    $.ajax({
        url: `../controllers/peliculasController.php?op=obtenerPeliculaDeOID`,
        type: "POST",
        data: {
            id: OID
        },
        dataType: 'json',
        success: function (data) {
            let pelicula = data.object;
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
            $("#VolverAlContenido").attr("href", `./verResennasPelicula.php?id=${pelicula.ID_Pelicula}`);
        }, error: function (error) {
            console.log(error)
        }
    });
}

function verSerieDesdeBD(OID) {
    $.ajax({
        url: `../controllers/seriesController.php?op=obtenerSerieDeOID`,
        type: "POST",
        data: {
            id: OID
        },
        dataType: 'json',
        success: function (data) {
            let serie = data.object;
            const timestamp = parseInt(serie.Lanzamiento.$date.$numberLong, 10);
            const jsDate = new Date(timestamp);
        
            const day = String(jsDate.getDate()).padStart(2, '0');
            const month = String(jsDate.getMonth() + 1).padStart(2, '0');
            const year = jsDate.getFullYear();
        
            const fechaFinal = `${year}-${month}-${day}`;
            let escribir = $("#infoPeli");
            datos = `
                        <h4 class="text-center">${serie.TituloOriginal}</h4>
                        <h6 class="text-center">(${serie.TituloTraducido})</h6>
                        <div class="d-flex justify-content-center">
                            <img src="${serie.Poster}" alt="Poster_${serie.TituloOriginal}" data-fancybox data-caption="Poster de ${serie.TituloOriginal}" width="275px">
                        </div>
                        <br>
                        <p class="text-center">Cantidad de episodios: ${serie.CapitulosTotales} <br> Cantidad de temporadas: ${serie.Temporadas}</p>
                        <p class="text-center">${serie.Sinopsis}</p>`
            //Agregar FancyBox para poder ver la imagen en grande
            Fancybox.bind("[data-fancybox]")
            escribir.append(datos);
            $("#VolverAlContenido").attr("href", `./verResennasSerie.php?id=${serie.ID_Serie}`);
        }, error: function (error) {
            console.log(error)
        }
    });
}

function enviarComentario(infoComentario) {
    $.ajax({
        url: "../controllers/comentariosController.php?op=SubirComentario",
        type: "POST",
        data: infoComentario,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            if (data.exito) {
                Swal.fire({
                    title: "Exito",
                    text: "Se envio el comentario!",
                    icon: "success"
                });
                $("#enviarComentario")[0].reset();
                $("#comentariosUsuarios").empty();
                let oid = $("#IdReseña").val()
                agregarComentariosDeOpinion(oid);
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}

//Cuando la pagina carga, ejecutar llamados
$(function () {
    agregarOpinion(idOpinion);
});

//Cuando se envia el comentario, atrapar por medio de esta funcion
$('#enviarComentario').submit(function (event) {
    event.preventDefault();
    var formData = new FormData($("#enviarComentario")[0]);
    let comentario = $("textarea#TextoComentario").val();

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
    enviarComentario(formData);
});
