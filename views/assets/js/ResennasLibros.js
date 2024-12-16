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
        url: `https://www.googleapis.com/books/v1/volumes/${id}?key=${googleAPI}&langRestrict=es-CR`,
        type: 'GET',
        success: function (responseInfo) {
            console.log(responseInfo)
            document.title = responseInfo.volumeInfo.title + ". Reseñas"
            //Seleccionar donde se escribira, en este caso, el div con ID infoPeli
            let escribir = $("#infoPeli");
            datos = `
                        <h4 class="text-center">${responseInfo.volumeInfo.title}</h4>
                        <div class="d-flex justify-content-center">
                            <img src="https://books.google.com/books/publisher/content/images/frontcover/${id}?fife=w400-h600&source=gbs_api" alt="Poster_${responseInfo.volumeInfo.title}" data-fancybox data-caption="Poster de ${responseInfo.volumeInfo.title}" width="275px">
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
            agregarInfoModal(responseInfo, false)
            subirLibroEnBD(responseInfo, id);
            $("#comentariosUsuarios").append(`
                <div class="d-flex justify-content-center pt-5">
                    <h1 class="text-light text-center">Todavia no hay opiniones sobre la pelicula. Escribe una reseña!</h1>
                </div>`)
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
            //Poner un error 404 en caso de algun error
            vaciarHTML();
        }
    });
}

function verLibroDesdeBD(libro) {

    document.title = libro.Titulo + ". Reseñas"
    //Seleccionar donde se escribira, en este caso, el div con ID infoPeli
    let escribir = $("#infoPeli");
    datos = `
                        <h4 class="text-center">${libro.Titulo}</h4>
                        <div class="d-flex justify-content-center">
                            <img src="https://books.google.com/books/publisher/content/images/frontcover/${id}?fife=w400-h600&source=gbs_api" alt="Poster_${libro.Titulo}" data-fancybox data-caption="Poster de ${libro.Titulo}" width="275px">
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
    IDContenido = libro._id.$oid;
    $("#IdContenido").val(libro._id.$oid);
    agregarInfoModal(libro, true)
}

function confirmarSiExisteLibroEnBD(id) {
    $.ajax({
        url: `../controllers/librosController.php?op=existeLibroEnBD`,
        type: 'POST',
        data: {
            ID_Libro: id
        },
        dataType: 'json',
        success: function (responseInfo) {
            console.log(responseInfo.msg)
            let existe = responseInfo.exito;
            if (existe) {
                verLibroDesdeBD(responseInfo.object);
                agregarComentarios();
            } else {
                verInfoMedioCompleto(id);
            }
            return existe;
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
            //Poner un error 404 en caso de algun error
            return false;
        }
    });
}

//Agregar info con respecto a info brindada. Se le pasa un JSON con la info
function agregarInfoModal(responseModal, tipo) {
    let agregarCodigo = $("#infoModal")
    let codigoModal = '';
    if (tipo) {
        const timestamp = parseInt(responseModal.Lanzamiento.$date.$numberLong, 10);
        const jsDate = new Date(timestamp);
        
        const day = String(jsDate.getDate()).padStart(2, '0');
        const month = String(jsDate.getMonth() + 1).padStart(2, '0');
        const year = jsDate.getFullYear();
        
        const fechaFinal = `${year}-${month}-${day}`;

        let adulto = "Error"
        if (responseModal.Publico == "NOT_MATURE") adulto = "Para todo mundo"
        else adulto = "Para mayores de edad"
        codigoModal = `
    <div class="text-dark">
    <p>Fecha de salida: ${fechaFinal}</p>
    <p>Para que público es? ${adulto}</p>
    <p>Link de compra: <a target="_blank" href="${responseModal.LinkCompraGoogle}">Google</a></p>
    <p>Publicante: ${responseModal.Publicante}</p>
    </div>
    `
    } else {
        let adulto = "Error"
        if (responseModal.volumeInfo.maturityRating == "NOT_MATURE") adulto = "Para todo mundo"
        else adulto = "Para mayores de edad"
        codigoModal = `
    <div class="text-dark">
    <p>Fecha de salida: ${responseModal.volumeInfo.publishedDate}</p>
    <p>Para que público es? ${adulto}</p>
    <p>Link de compra: <a target="_blank" href="${responseModal.saleInfo.buyLink}">Google</a></p>
    <p>Publicante: ${responseModal.volumeInfo.publisher}</p>
    </div>
    `
    }
    agregarCodigo.append(codigoModal);
}

function subirLibroEnBD(libro, id) {

    let adulto = "Error"
    if (libro.volumeInfo.maturityRating == "NOT_MATURE") adulto = "Para todo mundo"
    else adulto = "Para mayores de edad"

    $.ajax({
        url: `../controllers/librosController.php?op=SubirLibro`,
        type: 'POST',
        data: {
            ID_Libro: id,
            Titulo: libro.volumeInfo.title,
            Publicante: libro.volumeInfo.publisher,
            Autor: libro.volumeInfo.authors[0],
            Lanzamiento: libro.volumeInfo.publishedDate,
            Publico: adulto,
            Sinopsis: libro.volumeInfo.description,
            Poster: `https://books.google.com/books/publisher/content/images/frontcover/${id}?fife=w400-h600&source=gbs_api`,
            TotalPaginas: libro.volumeInfo.pageCount,
            LinkCompraGoogle: libro.saleInfo.buyLink
        },
        dataType: 'json',
        success: function (responseInfo) {
            let libro = responseInfo.object;
            IDContenido = libro.$oid;
            $("#IdContenido").val(libro.$oid);
        },
        error: function (error) {
            console.error('Error al obtener la pelicula:', error);
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

//Cuando la pagina carga, ejecutar llamados
$(function () {
    //En caso de que la ID brindada (En linea 6) sea nula, tirar error.
    if (id == null) {
        vaciarHTML();
    } else {
        //Buscar informacion con la ID brindada
        confirmarSiExisteLibroEnBD(id)
    }
});