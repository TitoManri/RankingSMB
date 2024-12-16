<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


session_start();
$iniciado = true;
if (empty($_SESSION['id'])) {
    $iniciado = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- Prueba -->

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
                    <a href="" id="VolverAlContenido" class="btn btn-ver">
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
                                <input type="hidden" name="IdUsuario" id="IdUsuario" class="form-control" value="<?php echo $_SESSION['id'] ?>" required>
                                <input type="hidden" name="IdReseña" id="IdReseña" class="form-control" value="" required>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Escribe tu opinion" name="TextoComentario" id="TextoComentario" style="resize: none;" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
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
                        <div class=" d-flex justify-content-center">
                            <div class="border10 comentarios" id="comentariosUsuarios" style="width: 50rem;">

                            </div>
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
                    <div class="pt-4 ps-5" id="comentarioOriginal">
                        <h5>Calificacion de: </h5>

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
    let tmdbAPI = '<?php echo $_ENV['tmdbAPI'] ?>'
    let googleAPI = '<?php echo $_ENV['googleBooks'] ?>'
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
<script src="./assets/js/ComentariosUsuarios.js"></script>

</html>