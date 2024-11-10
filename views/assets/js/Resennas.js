let estrellasForm = 0

let params = new URLSearchParams(location.search);
let id = params.get("id");

function verInfoMedioCompleto(id) {
    $.ajax({
        url: `https://www.omdbapi.com/?i=${id}&plot=full&apikey=${omdbAPI}`,
        type: 'GET',
        success: function (responseInfo) {
            if (responseInfo.Error != "Incorrect IMDb ID.") {
                let escribir = $("#infoPeli");
                let Descripcion = responseInfo.Plot;
                let titulo = responseInfo.Title;
                traducirDescripcion(Descripcion);
                datos = `
                <h4 class="text-center">${responseInfo.Title}</h4>
                <div class="d-flex justify-content-center">
                    <img src="${responseInfo.Poster}" alt="Poster_${responseInfo.Title}" data-fancybox data-caption="Poster de ${responseInfo.Title}" width="275px">
                </div>
                <br>
                <p class="text-center" id="textoTraducido">${responseInfo.Plot}</p>`
                Fancybox.bind("[data-fancybox]")
                escribir.append(datos);
                recomendarEnBaseATitulo(titulo);
            } else {
                vaciarHTML();
            }
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
            vaciarHTML();
        }
    });
}

function verDescripcionCorta() {
    $.ajax({
        url: `https://www.omdbapi.com/?i=${id}&plot=short&apikey=${omdbAPI}`,
        type: 'GET',
        success: function (responseInfo) {
            let Descripcion = responseInfo.Plot;
            traducirDescripcionCorta(Descripcion);
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}

function traducirDescripcion(Descripcion) {
    $.ajax({
        url: `https://api.mymemory.translated.net/get?q=${Descripcion}!&langpair=en|es-cr`,
        type: 'GET',
        success: function (responseInfo) {
            DescripcionTraducida = responseInfo.responseData.translatedText;
            if (DescripcionTraducida == "QUERY LENGTH LIMIT EXCEEDED. MAX ALLOWED QUERY : 500 CHARS") {
                verDescripcionCorta();
                return;
            }
            $("#textoTraducido").replaceWith(`<p class="text-center" id="textoTraducido">${DescripcionTraducida}</p>`)
        },
        error: function (error) {
            console.log(error);
            return;
        }
    });
}

function traducirDescripcionCorta(Descripcion) {
    $.ajax({
        url: `https://api.mymemory.translated.net/get?q=${Descripcion}!&langpair=en|es-cr`,
        type: 'GET',
        success: function (responseInfo) {
            DescripcionTraducida = responseInfo.responseData.translatedText;
            if (DescripcionTraducida == "QUERY LENGTH LIMIT EXCEEDED. MAX ALLOWED QUERY : 500 CHARS") {
                return;
            }
            $("#textoTraducido").replaceWith(`<p class="text-center" id="textoTraducido">${DescripcionTraducida}</p>`)
        },
        error: function (error) {
            console.log(error);
            return;
        }
    });
}

function recomendarEnBaseATitulo(Titulo){
    $.ajax({
        url: `    https://www.omdbapi.com/?apikey=${omdbAPI}&s=${Titulo}`,
        type: 'GET',
        success: function (responseInfo) {
            console.log(responseInfo);
            let codigo = "";
            for (let index = 0; index < 7; index++) {
                const medio = responseInfo.Search[index];
                if(index == 0 || (index % 2 === 0)){
                    codigo = `<div class="row mb-3">`
                }
                codigo += `
                <div class="PosterRecomendados">
                    <a href="../views/verResennasPelicula.php?id=${medio.imdbID}">
                        <img src="${medio.Poster}" alt="Poster_${medio.Title}" class="img-fluid">
                        <div class="nombrePosterRecomendados">
                            <p class="text-center">${medio.Title}</p>
                        </div>
                    </a>
                </div>`
                if(index % 2 !== 0){
                    codigo += `</div>`
                    $("#recomendados").append(codigo);
                }
            }
        },
        error: function (error) {
            console.log(error);
            return;
        }
    });
}

function vaciarHTML() {
    $("#informacionPelicula").empty();
    $('footer').addClass("fixed-bottom")
    $("#informacionPelicula").append(`
        <div class="d-flex justify-content-center pt-5">
            <h1 class="text-light">Error 404. No se encontro ninguna pelicula ;(</h1>
        </div>`)
}

$(function () {
    if (id == null) {
        vaciarHTML();
    } else {
        verInfoMedioCompleto(id);
    }
});

$("input[type=radio][name=calificacion]").on("change", function () {
    if (estrellasForm > this.value) {
        for (let index = 5; index > (this.value - 1); index--) {
            $("#estrella" + index).removeClass("estrellaRellena bi-star-fill");
            $("#estrella" + index).addClass("bi-star");
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

$("#enviarOpinion").on("submit", function (event) {
    event.preventDefault();
    if ($("input[type=radio][name=calificacion]").value == null) {
        $("#validarCalificacion").append(`<p class="text-danger" style="margin-bottom: 23.9px;">Agrega una calificacion para enviar tu opinion!</p>`)
        $("#divBotonEnviar").removeClass("mt-5")
    }
});