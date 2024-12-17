<?php
include '../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

session_start();
$iniciado = true;
if (empty($_SESSION['id'])) {
    $iniciado = false;
}
$Tipo = 1;
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
        include_once "./templates/Resennas/ResennasUsuarios.php"
        ?>

        <section class="col-2 pt-3" id="recomendados" style="margin-left: 5rem !important">
            <h4 class="text-center">Recomendados</h4>
            <br>

        </section>
    </div>
    <div>

    <div class="fixed-footer">
            <?php
            include_once "./templates/Header_Footer/footer.php"
            ?>
        </div>
    </div>
</body>
<!--Scripts-->
<script>
    let tmdbAPI = '<?php echo $_ENV['tmdbAPI'] ?>'
    let Tipo = 1;
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
<script src="./assets/js/ResennasPeliculas.js"></script>
<script src="./assets/js/ResennasUsuario.js"></script>

<!--Listas -->
<script src="./assets/js/Listas/SeriesYPelis/Favoritos/AgregarAListaSMFav.js"></script>
<script src="./assets/js/Listas/SeriesYPelis/PorVer/AgregarAListaPorVer.js"></script>
<script src="./assets/js/Listas/SeriesYPelis/Visto/AgregarAListaVisto.js"></script>

</html>