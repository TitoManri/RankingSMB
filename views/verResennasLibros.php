<?php
require __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

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

        .boton-active#Favorito {
            background-color: #87541c !important;
        }

        .boton-active#PorVer {
            background-color: #87541c !important;
        }

        .boton-active#Visto {
            background-color: #87541c !important;
        }

        .boton-Opciones#Favorito:hover {
            background-color: #87541c !important;
        }

        .boton-Opciones#PorVer:hover {
            background-color: #87541c !important;
        }

        .boton-Opciones#Visto:hover {
            background-color: #87541c !important;
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
                                    <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Informacion del libro</h1>
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

    </div>
    <div>

        <?php
        include_once "./templates/Header_Footer/footer.php"
        ?>
    </div>
</body>
<!--Scripts-->
<script>
    let googleAPI = '<?php echo $_ENV['googleBooks'] ?>'
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="./assets/js/ResennasLibros.js"></script>
<script src="./assets/js/ResennasUsuario.js"></script>

</html>