<?php
require __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

//Inicio de la sesión
session_start();
if (!empty($_SESSION['correo'])) {
    //Variables del usuario
    $id = $_SESSION['id'];
    $nombreUsuario = $_SESSION['nombreUsuario'];
    $correo = $_SESSION['correo'];

} else {
    //Lo manda si la intenta acceder sin haber iniciado sesión
    header('Location: ./inicioSesion.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
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

    <!-- Parte de netflix -->
    <div class="top">
        <div class="columns">
            <div class="column is-full featured_wrapper p-0">
                <img src="https://themacguffinmen.com/wp-content/uploads/2014/01/her1.jpg" class="featured">
                <div class="title_wrapper">
                    <span class="has-text-white">Comunidad para compartir opiniones sobre tus series, películas y libros
                        favoritos</span>
                    <h1 class="title is-1 has-text-white">Ranking SMB</h1>
                    <button id="boton-contenido" class="button is-medium">Catálogo</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container p-0 pt-6 last">
        <div id="peliculas" class="columns is-multiline ">
            <div class="column is-full">
                <h1 class="title is-3 has-text-white">Popular esta semana</h1>
            </div>
            <!-- se insertan las películas usando js-->
        </div>

        <!-- carousel-->
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://64.media.tumblr.com/4ebc3f285254cf7b0d2733124afe6dc6/47f19caee3f7dca9-54/s2048x3072/3141d20fe645f4130c71e73d93ccf0faadcc4c19.jpg"
                        class="d-block w-100" alt="..." height="400px">
                </div>
                <div class="carousel-item">
                    <img src="https://64.media.tumblr.com/e5816b70956eeb24543e54a61a2a2ad4/65bab2b77e54edcb-0d/s2048x3072/a3ad94eaf23ef902736dfda9605215bad205c5d8.pnj"
                        class="d-block w-100" alt="..." height="400px">
                </div>
                <div class="carousel-item">
                    <img src="https://64.media.tumblr.com/51af4f717c0c1e5e4a756ac68502a665/65bab2b77e54edcb-90/s2048x3072/45c362d488ce0b1a67196f58bc70fec620756728.pnj"
                        class="d-block w-100" alt="..." height="400px">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div id="libros" class="columns last">
            <!-- se insertan los libros por medio de js -->
        </div>
    </div>

    <!-- Parte de cartas-->
    <br>
    <div id="series" class="container">
        <div class="column is-full">
            <h1 class="title is-3 has-text-white">Series mejores rankeadas</h1>
        </div>
        <!-- aquí se insertan las cards desde el js-->
    </div>

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
<script src="./assets/js/catalogo.js"></script>

</html>