<?php
//Inicio de la sesión
session_start();
if (!empty($_SESSION['correo'])) {
    //Variables del usuario
    $id = $_SESSION['id'];
    $nivel = $_SESSION['nivel'];
    $nombre = $_SESSION['nombre'];
    $primerApellido = $_SESSION['primerApellido'];
    $SegundoApellido = $_SESSION['segundoApellido'];
    $nombreUsuario = $_SESSION['nombreUsuario'];
    $correo = $_SESSION['correo'];
    $telefono = $_SESSION['telefono'];
    $fotoPerfil = $_SESSION['fotoPerfil'];

}else{
    //Lo manda si la intenta acceder sin haber iniciado sesión
    header('Location: ./inicioSesion.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="./assets/general.css">
    <link rel="stylesheet" href="./assets/header-footer/headerFooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/perfil.css">

    <title>Registro</title>
</head>

<body>
    <!-- Header -->
    <?php include_once "./templates/Header_Footer/header.php"; ?>

    <div class="container-fixed text-center">
        <div class="row align-items-start">
            <div class="col-9">
                <div class="row mt-5">
                    <div class="col-6 d-flex flex-column align-items-center">
                        <div class="d-flex justify-content-center mb-4">
                            <img id="pfp" src="<?php echo $fotoPerfil?>"
                                class="rounded-circle foto-perfil" style="width: 300px; height: 300px; object-fit: cover;"/>
                        </div>
                        <button type="button" class="btn btn-light btn-lg d-flex align-items-center">
                            <span class="game-icons--rank-1 me-2"></span>
                            Nivel: <?php echo $nivel?>
                        </button>
                    </div>

                    <div class="col-6">
                        <h1 class="caja-perfil-datos p-3 mt-3" id="nombreCompleto" name="nombreCompleto"><?php echo $nombre." ".$primerApellido." ".$SegundoApellido?></h1>
                        <br>
                        <br>
                        <div class="row mt-4">
                        <div class="col">
                                <h2 class="caja-perfil-datos">Usuario</h2>
                                <h3 id="nombreUsuario" name="nombreUsuario"><?php echo $nombreUsuario ?></h3>
                            </div>
                            <div class="col">
                                <h2 class="caja-perfil-datos">Correo</h2>
                                <h3 id="correo" name="correo"><?php echo $correo ?></h3>
                            </div>
                            <div class="col">
                                <h2 class="caja-perfil-datos">Telefono</h2>
                                <h3 id="telefono" name="telefono"><?php echo $telefono ?></h3>
                            </div>
                        </div>
                        <br>
                        <br>
                        <button type="button" class="btn btn btn-outline-light mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <h3>Editar Perfil</h3>
                        </button>
                    </div>
                </div>
                <br><hr><br><br>
                <h1 class="titulo ">Listas</h1>
                <div class="row mb-5">
                    <div class="col">
                        <h1 class="subtitulo">Peliculas y Series</h1>
                    </div>
                    <div class="col">
                        <h1 class="subtitulo ">Libros</h1>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="container">
                            <div class="row">
                                <div class="col-4 animate__animated animate__heartBeat">
                                    <a href="./listaFavoritosMyS.php" class="peliculas-series-listas hvr-radial-in-MyS-Favorito hvr-round-corners mr-2">
                                        <img src="./assets/img/heart.png" class="rounded cuadrado-MyS" alt="">
                                    </a>
                                </div>
                                <div class="col-4 animate__animated animate__heartBeat">
                                    <a href="./listaPorVerMyS.php" class="peliculas-series-listas hvr-radial-in-MyS-PorVer hvr-round-corners">
                                        <img src="./assets/img/vision (1).png" class="rounded  cuadrado-MyS" alt="">
                                    </a>
                                </div>
                                <div class="col-4  animate__animated animate__heartBeat cuadrado">
                                    <a href="./listaVistoMyS.php" class="peliculas-series-listas hvr-radial-in-MyS-Visto hvr-round-corners">
                                        <img src="./assets/img/verified (2).png" class="rounded  cuadrado-MyS" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="container">
                            <div class="row ">
                                <div class="col-4 animate__animated animate__heartBeat">
                                    <a href="./listaFavoritosMyS.php" class="libros-listas hvr-radial-in-L-Favorito hvr-round-corners">
                                        <img src="./assets/img/heart.png" class="rounded  cuadrado-L" alt="">
                                    </a>
                                </div>
                                <div class="col-4 animate__animated animate__heartBeat">
                                    <a href="./listaPorVerMyS.php" class="libros-listas hvr-radial-in-L-PorVer hvr-round-corners">
                                        <img src="./assets/img/vision (1).png" class="rounded  cuadrado-L" alt="">
                                    </a>
                                </div>
                                <div class="col-4 animate__animated animate__heartBeat">
                                    <a href="./listaVistoMyS.php" class="libros-listas hvr-radial-in-L-Visto hvr-round-corners">
                                        <img src="./assets/img/verified (2).png" class="rounded  cuadrado-L" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <br>
                <div class="row vstack m-3">
                    <div class="col animate__animated animate__bounceInRight">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                <h1>Amigos</h1>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="no" src="https://cdn.hero.page/pfp/daca14e0-298a-4675-a868-7a0308d6edc1-neko-girl-pfp-anime-cute-pfp-from-popular-shows-1.png"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9 d-flex align-items-center">
                                        <h2 class="texto-negrita">Scara14</h2>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="no" src="https://cdn.imgchest.com/files/l7lxcgnrl57.png"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9 d-flex align-items-center">
                                        <h2 class="texto-negrita">TitoManri</h2>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="no" src="https://cdn.hero.page/pfp/59a0bbc4-5aa5-4a60-85fc-74a52ad1a89f-schoolgirl-with-pink-hair-cute-anime-pfp-girl-styles-1.png"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9 d-flex align-items-center">
                                        <h2 class="texto-negrita">Patito</h2>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="no" src="https://pbs.twimg.com/media/F-28_vlXcAAcJFP.jpg"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9 d-flex align-items-center">
                                        <h2 class="texto-negrita">Yorsh</h2>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="no" src="https://pbs.twimg.com/media/F-28_vlXcAAcJFP.jpg"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9 d-flex align-items-center">
                                        <h2 class="texto-negrita">Yorsh</h2>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="no" src="https://pbs.twimg.com/media/F-28_vlXcAAcJFP.jpg"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9 d-flex align-items-center">
                                        <h2 class="texto-negrita">Yorsh</h2>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="no" src="https://pbs.twimg.com/media/F-28_vlXcAAcJFP.jpg"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9 d-flex align-items-center">
                                        <h2 class="texto-negrita">Yorsh</h2>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="no" src="https://pbs.twimg.com/media/F-28_vlXcAAcJFP.jpg"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9 d-flex align-items-center">
                                        <h2 class="texto-negrita">Yorsh</h2>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="no" src="https://pbs.twimg.com/media/F-28_vlXcAAcJFP.jpg"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9 d-flex align-items-center">
                                        <h2 class="texto-negrita">Yorsh</h2>
                                    </div>
                                </div>
                            </a>

                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="color: black;">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Profile</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="actualizarPerfil">
                        <div>
                            <div class="d-flex justify-content-center mb-4">
                                <img id="selectedAvatar" src="<?php echo $fotoPerfil?>"
                                    class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                            </div>
                            <div class="d-flex justify-content-center">
                                    <input type="text" class="form-control" id="FotodePerfil" name="FotodePerfil" value="<?php echo $fotoPerfil?>">
                            </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="Nombre" class="col-form-label">Nombre</label>
                                <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo $nombre?>">
                            </div>
                            <div class="col">
                                <label for="PrimerApellido" class="col-form-label">Primer Apellido</label>
                                <input type="text" class="form-control" id="PrimerApellido" name="PrimerApellido" value="<?php echo $primerApellido?>">
                            </div>
                            <div class="col">
                                <label for="SegundoApellido" class="col-form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" id="SegundoApellido" name="SegundoApellido" value="<?php echo $SegundoApellido?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="Correo" class="col-form-label">Correo</label>
                                <input type="text" class="form-control" id="Correo" name="Correo" value="<?php echo $correo?>">
                            </div>
                            <div class="col">
                                <label for="Telefono" class="col-form-label">Telefono</label>
                                <input type="text" class="form-control" id="Telefono" name="Telefono" value="<?php echo $telefono?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="navbarMain fixed-bottom">
    <!-- Footer -->
    <?php include_once "./templates/Header_Footer/footer.php"; ?>
    </footer>
</body>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://unpkg.com/scrollreveal"></script>

<!-- JS Personalizado -->
<script src="./assets/signIn/signIn.js"></script>
<script src="./assets/js/ActualizarPerfil.js"></script>



</html>