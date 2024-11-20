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
    <title>Búsqueda</title>
    <!-- Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./assets/css/catalogo.css">
    <link rel="stylesheet" href="./assets/css/cards.css">
    <link rel="stylesheet" href="./assets/css/header.css">
</head>

<body>
    <?php include_once "./templates/Header_Footer/header.php" ?>

    <? php/*
if (!$iniciado) {*/
        ?>
    <!-- Esto se muestra si la sesión está iniciada-->
    <!-- Parte de netflix -->
    <div class="top">
        <div class="columns">
            <div class="column is-full featured_wrapper p-0">
                <img src="https://themacguffinmen.com/wp-content/uploads/2014/01/her1.jpg" class="featured">
                <div class="title_wrapper">
                    <span class="has-text-white">Comunidad para compartir opiniones sobre tus series, películas y libros
                        favoritos</span>
                        <h1 class="title is-1 has-text-white">
                        <a href="./catalogo.php">
                            Ranking SMB
                        </a>
                    </h1>
                    <button id="boton-contenido" class="button is-medium">Busqueda de películas</button>
                </div>
            </div>
        </div>
    </div>

    <!-- búsqueda-->
    <?php
    if (isset($_POST['busquedaPeliculaText'])) {
        $busqueda = htmlspecialchars($_POST['busquedaPeliculaText']);  
        echo "<p hidden id='busquedaParam'>".$busqueda."</p>";  
    }
    ?>

    <div class="container p-0 pt-6 last">
        <div id="peliculas1" class="columns is-multiline">
            <div class="column is-full">
                <h1 class="title is-3 has-text-white">Resultado de la búsqueda</h1>
            </div>
            <!-- se insertan las películas usando js-->
        </div>

        <div id="peliculas2" class="columns is-multiline">
            <!-- se insertan los libros por medio de js -->
        </div>

        <div id="peliculas3" class="columns last">
            <!-- se insertan los libros por medio de js -->
        </div>
    </div>

    <?php
    /*} else {*/
    ?>
    <!-- Lo que pasa si no se ha iniciado sesión-->
    <?php
    /*}*/
    ?>

    <div class="fixed-bottom">
        <?php include_once "./templates/Header_Footer/footer.php" ?>
    </div>
</body>
<!--Scripts-->
<script>
    let tmdbAPI = '<?php echo $_ENV['tmdbAPI'] ?>';
    let googleAPI = '<?php echo $_ENV['googleBooks'] ?>';
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="./assets/js/busquedaPelicula.js"></script>

</html>