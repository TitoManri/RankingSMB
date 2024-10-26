<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas</title>
    <!-- Links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">-->
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/peliculas.css">
</head>

<body>
    <?php include_once "./templates/Header_Footer/header.php" ?>

    <!-- Filtros y búsqueda-->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <h4 class="mx-5 my-2 text-white">Filtros</h5>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Género filtro -->
                    <li class="nav-item dropdown m-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Género
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Acción</a></li>
                                <li><a class="dropdown-item" href="#">Comedia</a></li>
                                <li><a class="dropdown-item" href="#">Terror</a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- Calificación -->
                    <li class="nav-item dropdown m-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Calificación
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">5</a></li>
                                <li><a class="dropdown-item" href="#">4</a></li>
                                <li><a class="dropdown-item" href="#">3</a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- Año filtro -->
                    <li class="nav-item dropdown m-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Año
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">2024</a></li>
                                <li><a class="dropdown-item" href="#">2023</a></li>
                                <li><a class="dropdown-item" href="#">2022</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Descubre contenido" aria-label="Buscar">
                    <button class="btn" id="boton-busqueda" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- #PARTE DE CATÁLOGO -->
    

    <div class="fixed-bottom">
        <?php include_once "./templates/Header_Footer/footer.php" ?>
    </div>
</body>
<!--Scripts-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>