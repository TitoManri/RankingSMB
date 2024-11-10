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
        url: `https://www.googleapis.com/books/v1/volumes/${id}?key=${googleAPI}&langRestrict=es-CR`,
        type: 'GET',
        success: function (responseInfo) {
            document.title = responseInfo.volumeInfo.title + ". Reseñas"
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
            agregarInfoModal(responseInfo)
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
            //Poner un error 404 en caso de algun error
            vaciarHTML();
        }
    });
}

//Agregar info con respecto a info brindada. Se le pasa un JSON con la info
function agregarInfoModal(responseModal) {
    let agregarCodigo = $("#infoModal")
    let adulto = "Error"
    if(responseModal.volumeInfo.maturityRating == "NOT_MATURE") adulto = "Para todo mundo"
    else adulto = "Para mayores de edad"
    let codigoModal = `
    <div class="text-dark">
    <p>Fecha de salida: ${responseModal.volumeInfo.publishedDate}</p>
    <p>Para que público es? ${adulto}</p>
    <p>Link de compra: <a href="${responseModal.saleInfo.buyLink}">Google</a></p>
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
                <input type="hidden" name="Tipo" value="1">
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