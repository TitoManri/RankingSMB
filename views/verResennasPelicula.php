<?php
include_once "../config/apikey.php";
session_start();
$iniciado = true;
if (empty($_SESSION['NombreUsuario'])) {
    $iniciado = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas</title>

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
                    <button type="button" class="btn btn-ver" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Ver más sobre la película
                    </button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Informacion de la pelicula</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="infoModal">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Salir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
        </section>

        <?php
        if (!$iniciado) {
        ?>
            <section class="col-5 pt-3">
                <div class="container FondoVerde ms-3 border10" style="color: white;">
                    <form action="" method="post" id="enviarOpinion" class="pt-4 ps-5 ">
                        <?php
                        echo '<input name="Nombre_Usuario" id="Nombre_Usuario" class="form-control" type="hidden" value="', "Jorge", '" required>';
                        ?>
                        <div class="d-flex justify-content-center border10" style="background-color: #003344; width: 50%">
                            <input type="radio" name="calificacion" id="calificacion1" value="1">
                            <label for="calificacion1" class="me-2"><i class="bi bi-star h3" id="estrella0"></i></label>

                            <input type="radio" name="calificacion" id="calificacion2" value="2">
                            <label for="calificacion2" class="me-2"><i class="bi bi-star h3" id="estrella1"></i></label>

                            <input type="radio" name="calificacion" id="calificacion3" value="3">
                            <label for="calificacion3" class="me-2"><i class="bi bi-star h3" id="estrella2"></i></label>

                            <input type="radio" name="calificacion" id="calificacion4" value="4">
                            <label for="calificacion4" class="me-2"><i class="bi bi-star h3" id="estrella3"></i></label>

                            <input type="radio" name="calificacion" id="calificacion5" value="5">
                            <label for="calificacion5" class="me-2"><i class="bi bi-star h3" id="estrella4"></i></label>
                        </div>
                        <br>
                        <div style="width: 85%">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Escribe tu opinion" name="opinion" id="opinion" style="resize: none;" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                                <label for="floatingTextarea2" style="color: black !important">Escribe tu opinion</label>
                            </div>
                            <div id="validarCalificacion">

                            </div>
                            <div class="d-flex justify-content-end mt-5" id="divBotonEnviar">
                                <button type="submit" class="btn btn-ver">Enviar</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <section id="opiniones" style="margin-bottom: 15px;">
                        <h3 class="text-center">Opiniones</h3>
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
            <section class="col-5 pt-3">
                <div class="container FondoVerde ms-3 border10" style="color: white;">
                    <div class="pt-4">
                        <h3 class="text-center">Inicia sesion para enviar tu opinion sobre la pelicula!</h3>
                        <br>
                        <div class="d-flex justify-content-center">
                            <a href="" class="btn btn-lg btn-ver">Iniciar sesion</a>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <section id="opiniones" style="margin-bottom: 15px;">
                        <h3 class="text-center">Opiniones</h3>
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
        
        <section class="col-2 pt-3" id="recomendados" style="margin-left: 5rem !important">
            <h4 class="text-center">Recomendados</h4>
            <br>

        </section>
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
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="./assets/js/ResennasPeliculas.js"></script>

</html>