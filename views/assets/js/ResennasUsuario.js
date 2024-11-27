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
    for (const value of formData.values()) {
        console.log(value);
      }});

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