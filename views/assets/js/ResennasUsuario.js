//Agregar o quitar estrellas (graficamente)
$("input[type=radio][name=Calificacion]").on("change", function () {
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
    if ($("input[type=radio][name=Calificacion]:checked").length == 0) {
        $("#validarCalificacion").append(`<p class="text-danger" style="margin-bottom: 23.9px;">Agrega una calificacion para enviar tu opinion!</p>`)
        $("#divBotonEnviar").removeClass("mt-5");
        return;
    } else {
        $("#divBotonEnviar").addClass("mt-5");
        $("#validarCalificacion").empty();
        //Seguir codigo de insercion dentro de controller de PHP
    }
    enviarResenna(formData);
});

function enviarResenna(infoResenna) {
    $.ajax({
        url: "../controllers/resennasController.php?op=subirResenna",
        type: "POST",
        data: infoResenna,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            if (data.exito) {
                Swal.fire({
                    title: "Exito",
                    text: "Se envio la opinión!",
                    icon: "success"
                });
                $("#enviarOpinion")[0].reset();
                $("#comentariosUsuarios").empty();
                agregarComentarios();
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
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

function agregarComentarios() {
    $.ajax({
        url: `../controllers/resennasController.php?op=conseguirResennasDeContenido`,
        type: 'POST',
        data: {
            IDContenido: IDContenido
        },
        dataType: 'json',
        success: function (respuesta) {
            let opiniones = respuesta.object;
            if (opiniones.length == 0) {
                $("#comentariosUsuarios").append(`
                    <div class="d-flex justify-content-center pt-5">
                        <h1 class="text-light text-center">Todavia no hay opiniones sobre la pelicula. Escribe una reseña!</h1>
                    </div>`)
            } else {
                opiniones.forEach(opinion => {
                    const timestamp = parseInt(opinion.FechaModificacion.$date.$numberLong, 10);
                    const jsDate = new Date(timestamp);

                    const fechaFinal = tiempoDesde(new Date(Date.now()), jsDate);
                    let comentario = `
                <section class="row" style="width: 100%; margin-bottom: 25px">
                <div class="col-2">`
                    //Imagen
                    comentario += `
                <img src="${opinion.usuarioInfo.FotodePerfil}" alt="" class="imgPerfil">
                </div>
                <div class="col" style="margin-top: 15px;">
                <p style="margin-bottom: 0px !important">`
                    //Nombre de usuario
                    comentario += `
                <span class="FondoVerde border10" style="padding: 5px; margin-bottom: 0px !important" id="nombreUsuario1">${opinion.usuarioInfo.NombredeUsuario}</span>
                <br>`
                    //Hora de creacion
                    comentario += `
                <span class="form-text">Hace ${fechaFinal}</span>
                <div class="d-flex justify-content-center border10" style="background-color: #003344; width: 10rem">`;

                    //Por la calificacion que le dio el usuario, agregarle las estrellas debajo de su opinion
                    for (let index = 0; index < opinion.Calificacion; index++) {
                        comentario += `<i class="bi bi-star-fill estrellaRellena h5 pe-2"></i>`
                    }
                    comentario += `</div>
                </p>
                <a href="./verComentarioUsuario.php?opinion=${opinion._id.$oid}" class="opinionUsuario d-flex" style="text-decoration: none; color: black; width: 32rem;">`
                    //Opinion
                    if(opinion.Opinion) comentario += opinion.Opinion
                    else comentario += "No hay opinion"
                comentario += `
                </a>
                </section>`;
                    $("#comentariosUsuarios").append(comentario);
                });
            }
        }
    });
}

//Cambiar clases, seguro hay una forma mas facil de hacerlo pero quiero dormir
//2:12 AM 21/11/24
$("#Favorito").click(function (e) {
    $("#Visto").removeClass("boton-active");
    $("#PorVer").removeClass("boton-active");
    $("#Visto").addClass("boton-Opciones");
    $("#PorVer").addClass("boton-Opciones");
    $("#Favorito").removeClass("boton-Opciones");
    $("#Favorito").addClass("boton-active");
});

$("#Visto").click(function (e) {
    $("#PorVer").removeClass("boton-active");
    $("#Favorito").removeClass("boton-active");
    $("#PorVer").addClass("boton-Opciones");
    $("#Favorito").addClass("boton-Opciones");
    $("#Visto").removeClass("boton-Opciones");
    $("#Visto").addClass("boton-active");
});

$("#PorVer").click(function (e) {
    $("#Visto").removeClass("boton-active");
    $("#Favorito").removeClass("boton-active");
    $("#Visto").addClass("boton-Opciones");
    $("#Favorito").addClass("boton-Opciones");
    $("#PorVer").removeClass("boton-Opciones");
    $("#PorVer").addClass("boton-active");
});