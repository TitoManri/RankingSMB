<?php
include_once "../config/apikey.php";
session_start();
$iniciado = true;
if (empty($_SESSION['NombreUsuario'])) {
    $iniciado = false;
}
$idTipo = $_POST["IDTipo"];
$Tipo = $_POST["Tipo"];

$rutaVolver = "";
if ($Tipo == 1) {
    $rutaVolver = "./verResennasPelicula.php?id=" . $idTipo;
} elseif ($Tipo == 2) {
    $rutaVolver = "./verResennasSeries.php?id=" . $idTipo;
} elseif ($Tipo == 3) {
    $rutaVolver = "./verResennasLibros.php?id=" . $idTipo;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios de la opinion</title>

    <!-- Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/css/Resennas.css">
    <style>
        body {
            background-color: #01455c;
        }
    </style>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

</head>

<body>
    <?php
    include_once "./templates/Header_Footer/header.php"
    ?>
    <div class="row" id="informacionPelicula">
        <section class="col-4 FondoVerde" style="box-shadow: 1px 0px 5px black;">
            <br>
            <div class="container">
                <div id="infoPeli" class="text-light">
                </div>
                <div class="d-flex justify-content-center">
                    <a href='<?php echo $rutaVolver ?>' class="btn btn-ver">
                        Volver al contenido
                    </a>
                </div>
            </div>
            <br><br><br>
        </section>

        <?php
        if ($iniciado) {
        ?>
            <section class="col-6 pt-3">
                <div class="container FondoVerde ms-3 border10" style="color: white;">
                    <div class="pt-4 ps-5" id="comentarioOriginal">
                        <h5>Calificacion de: </h5>

                    </div>
                    <hr>
                    <section id="opiniones" style="margin-bottom: 15px;">
                        <h3 class="text-center">Comentarios</h3>
                        <br>
                        <form class="d-flex justify-content-center" method="post" id="enviarComentario">
                            <div style="width: 85%">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Escribe tu opinion" name="comentario" id="comentario" style="resize: none;" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                                    <label for="floatingTextarea2" style="color: black !important">Escribe un comentario</label>
                                </div>
                                <div id="validarCalificacion">

                                </div>
                                <div class="d-flex justify-content-end mt-5" id="divBotonEnviar">
                                    <button type="submit" class="btn btn-ver">Enviar</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="border10 comentarios" id="comentariosUsuarios">

                        </div>
                    </section>
                    <br>
                </div>
                <br>
            </section>
        <?php
        } else {
        ?>
            <section class="col-6 pt-3">
                <div class="container FondoVerde ms-3 border10" style="color: white;">
                    <div class="pt-4 ps-5">
                        <h5>Calificacion de: </h5>
                        <div class=" d-flex justify-content-center"">
                        <div class=" row" style="background-color: #B1B2B5; width: 35rem; border-radius: 15px;">
                            <br>
                            <div class="col-1" style="margin-right: 2rem;">
                                <img src="./assets/img/ImagenPerfil.jpg" alt="" class="imgPerfil">
                            </div>
                            <div class="col-3" style="margin-top: 2vh;">
                                <p style="margin-bottom: 0px !important">
                                    <span class="FondoVerde border10" style="padding: 5px; margin-bottom: 0px !important" id="nombreUsuario1">Usuario1</span>
                                    <br>
                                    <span class="form-text">Hace X tiempo</span>
                                </p>
                            </div>
                            <div class="col-2" style="margin-top: 2vh;">
                                <div class="d-flex justify-content-center border10" style="background-color: #003344; width: 30vh; height: 5vh;" id="estrellasOpinion">
                                    <i class="bi bi-star-fill estrellaRellena h3 me-2"></i>
                                    <i class="bi bi-star-fill estrellaRellena h3 me-2"></i>
                                    <i class="bi bi-star-fill estrellaRellena h3 me-2"></i>
                                </div>
                            </div>

                            <br>
                            <div style="width: 85%; margin-left: 2rem">
                                <div class="opinionUsuario">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas fugiat odit repudiandae expedita molestiae! Itaque voluptate, enim voluptates odit rem, ullam doloribus incidunt sequi, qui dolore aspernatur quia laboriosam aut?</p>
                                </div>
                                <br>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <hr>
                <section id="opiniones" style="margin-bottom: 15px;">
                    <h3 class="text-center">Comentarios</h3>
                    <br>
                    <br>
                    <div class="border10 comentarios" id="comentariosUsuarios">

                    </div>
                </section>
                <br>
    </div>
    <br>
    </section>
<?php
        }
?>
</div>
<div>

    <?php
    include_once "./templates/Header_Footer/footer.php"
    ?>
</div>
</body>
<!--Scripts-->
<script>
    let omdbAPI = '<?php echo $omdb ?>'
    let tmdbAPI = '<?php echo $tmdbAPI ?>'
    let idTipo = '<?php echo $idTipo ?>'
    let Tipo = '<?php echo $Tipo ?>'
    let googleAPI = '<?php echo $googleBooks ?>'
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="./assets/js/ComentariosUsuarios.js"></script>

</html>
