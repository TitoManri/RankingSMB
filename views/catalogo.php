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
                    <button id="boton-contenido" class="button is-medium">Descubre nuevo contenido</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="container">
        <div class="columns is-multiline p-0 pt-6 last">
            <div class="column is-full">
                <h1 class="title is-3 has-text-white">Popular esta semana</h1>
            </div>
            <div class="column is-one-quarter">
                <img src="https://orangecubeproject.com/wp-content/uploads/2021/01/210109_HORIZONTAL_NAMES.jpg">
                <div class="column is-full">
                    <h1 class="has-text-white">Nombre Película</h1>
                </div>
            </div>
            <div class="column is-one-quarter">
                <img src="https://orangecubeproject.com/wp-content/uploads/2021/01/210109_HORIZONTAL_NAMES.jpg">
                <div class="column is-full">
                    <h1 class="has-text-white">Nombre Película</h1>
                </div>
            </div>
            <div class="column is-one-quarter">
                <img src="https://orangecubeproject.com/wp-content/uploads/2021/01/210109_HORIZONTAL_NAMES.jpg">
                <div class="column is-full">
                    <h1 class="has-text-white">Nombre Película</h1>
                </div>
            </div>
            <div class="column is-one-quarter">
                <img src="https://orangecubeproject.com/wp-content/uploads/2021/01/210109_HORIZONTAL_NAMES.jpg">
                <div class="column is-full">
                    <h1 class="has-text-white">Nombre Película</h1>
                </div>
            </div>
        </div>

        <!-- carousel-->
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://64.media.tumblr.com/4ebc3f285254cf7b0d2733124afe6dc6/47f19caee3f7dca9-54/s2048x3072/3141d20fe645f4130c71e73d93ccf0faadcc4c19.jpg"
                        class="d-block w-100" alt="..." height="400px">
                    <!-- 
                <div class="carousel-caption d-none d-md-block">
                    <h1>Ranking SMB</h1>
                    <h6>Comunidad donde podrá compartir todas tus opiniones de películas, series y libros</h6>
                </div> -->
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

        <div class="columns last">
            <div class="column is-one-quarter">
                <img src="https://orangecubeproject.com/wp-content/uploads/2021/01/210109_HORIZONTAL_NAMES.jpg">
                <div class="column is-full">
                    <h1 class="has-text-white">Nombre Película</h1>
                </div>
            </div>
            <div class="column is-one-quarter">
                <img src="https://orangecubeproject.com/wp-content/uploads/2021/01/210109_HORIZONTAL_NAMES.jpg">
                <div class="column is-full">
                    <h1 class="has-text-white">Nombre Película</h1>
                </div>
            </div>
            <div class="column is-one-quarter">
                <img src="https://orangecubeproject.com/wp-content/uploads/2021/01/210109_HORIZONTAL_NAMES.jpg">
                <div class="column is-full">
                    <h1 class="has-text-white">Nombre Película</h1>
                </div>
            </div>
            <div class="column is-one-quarter">
                <img src="https://orangecubeproject.com/wp-content/uploads/2021/01/210109_HORIZONTAL_NAMES.jpg">
                <div class="column is-full">
                    <h1 class="has-text-white">Nombre Película</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Parte de cartas-->
    <div class="container">
        <div class="column is-full">
            <h1 class="title is-3 has-text-white">Actividad reciente</h1>
        </div>
        <div class="movie_card" id="bright">
            <div class="info_section">
                <div class="movie_header">
                    <img class="locandina"
                        src="https://movieplayer.net-cdn.it/t/images/2017/12/20/bright_jpg_191x283_crop_q85.jpg" />
                    <h1>Bright</h1>
                    <h4>2017, David Ayer</h4>
                    <span class="minutes">117 min</span>
                    <p class="type">Action, Crime, Fantasy</p>
                </div>
                <div class="movie_desc">
                    <p class="text">
                        Set in a world where fantasy creatures live side by side with humans. A human cop is forced to
                        work
                        with an Orc to find a weapon everyone is prepared to kill for.
                    </p>
                </div>
                <div class="movie_social">
                    <ul>
                        <li><i class="material-icons">share</i></li>
                        <li><i class="material-icons"></i></li>
                        <li><i class="material-icons">chat_bubble</i></li>
                    </ul>
                </div>
            </div>
            <div class="blur_back bright_back"></div>
        </div>

        <div class="movie_card" id="tomb">
            <div class="info_section">
                <div class="movie_header">
                    <img class="locandina" src="https://mr.comingsoon.it/imgdb/locandine/235x336/53750.jpg" />
                    <h1>Tomb Raider</h1>
                    <h4>2018, Roar Uthaug</h4>
                    <span class="minutes">125 min</span>
                    <p class="type">Action, Fantasy</p>
                </div>
                <div class="movie_desc">
                    <p class="text">
                        Lara Croft, the fiercely independent daughter of a missing adventurer, must push herself beyond
                        her
                        limits when she finds herself on the island where her father disappeared.
                    </p>
                </div>
                <div class="movie_social">
                    <ul>
                        <li><i class="material-icons">share</i></li>
                        <li><i class="material-icons"></i></li>
                        <li><i class="material-icons">chat_bubble</i></li>
                    </ul>
                </div>
            </div>
            <div class="blur_back tomb_back"></div>
        </div>

        <div class="movie_card" id="ave">
            <div class="info_section">
                <div class="movie_header">
                    <img class="locandina" src="https://mr.comingsoon.it/imgdb/locandine/235x336/53715.jpg" />
                    <h1>Black Panther</h1>
                    <h4>2018, Ryan Coogler</h4>
                    <span class="minutes">134 min</span>
                    <p class="type">Action, Adventure, Sci-Fi</p>
                </div>
                <div class="movie_desc">
                    <p class="text">
                        T'Challa, the King of Wakanda, rises to the throne in the isolated, technologically advanced
                        African
                        nation, but his claim is challenged by a vengeful outsider who was a childhood victim of
                        T'Challa's
                        father's mistake.
                    </p>
                </div>
                <div class="movie_social">
                    <ul>
                        <li><i class="material-icons">share</i></li>
                        <li><i class="material-icons"></i></li>
                        <li><i class="material-icons">chat_bubble</i></li>
                    </ul>
                </div>
            </div>
            <div class="blur_back ave_back"></div>
        </div>
    </div>

    <div class="fixed-bottom">
        <?php include_once "./templates/Header_Footer/footer.php" ?>
    </div>
</body>
<!--Scripts-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>