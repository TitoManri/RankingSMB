<nav class="navbar navbarMain" data-bs-theme="dark">
        <div class="container-fluid row">
            <div class="d-flex col-8">
                <a href="index.php" class="navbar-brand" style="font-size: 40px;">
                    :
                    <img src="./assets/img/Logo_RankingSMB.png" alt="" width="80px">
                    RankingSMB
                </a>
            </div>
            <div class="d-flex justify-content-end col-3">
                <?php
                if (isset($_SESSION['id'])) {
                    echo '<div class="justify-content-end">
                    <div class="dropdown">
                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle h2"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end opcionesPerfil">
                            <li class="px-1"><a href="./perfil.php" class="dropdown-item" type="button" style="color:black !important">Perfil</a></li>
                            <hr>
                            <li><a href="./cerrarSesion.php" class="dropdown-item" type="button" style="color:black !important">Cerrar Sesion</a></li>
                        </ul>
                    </div>';
                } else {
                    echo '<a href="./inicioSesion.php" class="btn btn-primary me-3">Iniciar Sesion</a>';
                    echo '<a href="./registro.php" class="btn btn-success me-3">Registrarse</a>';
                }
                ?>
            </div>
        </div>
        <div class="container-fluid row">
            <div class="itemsNavbar">
                <a href="../views/peliculas.php" class="ps-3 pe-2">Peliculas</a>
                <a href="../views/series.php" class="ps-3 pe-2">Series</a>
                <a href="../views/libros.php" class="ps-3 pe-2">Libros</a>
                <a href="../views/Listas.php" class="ps-3 pe-2">Listas</a>
            </div>
        </div>
    </nav>