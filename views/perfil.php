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
                            <img id="selectedAvatar" src="https://i.pinimg.com/originals/9b/aa/62/9baa62b8c23ec8d7c622038ce13d0519.jpg"
                                class="rounded-circle foto-perfil" style="width: 300px; height: 300px; object-fit: cover;" alt="example placeholder" />
                        </div>
                        <button type="button" class="btn btn-primary btn-lg d-flex align-items-center">
                            <span class="game-icons--rank-1 me-2"></span>
                            Nivel: Rookie n.10
                        </button>
                    </div>

                    <div class="col-6">
                        <h1 class="mt-3">Nombre de la Persona</h1>
                        <br>
                        <h5>Vivamus feugiat lacus sed suscipit sollicitudin. Nulla quam nibh, porta ac eleifend pharetra, egestas eget dolor. Aliquam pellentesque consectetur ullamcorper. Pellentesque tincidunt leo augue, ac tincidunt quam pellentesque sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ut consectetur justo. Quisque venenatis eget est ut vulputate. Proin interdum odio sem, quis commodo lacus egestas ut. Proin ut convallis massa. Integer maximus leo nec nunc faucibus mollis. Sed fermentum metus vel ligula commodo, vitae ultrices risus pulvinar. Vestibulum ac tempor purus, in ornare ligula. Maecenas sit amet vulputate metus, in commodo nulla. Proin consequat imperdiet velit, in consectetur nisi cursus ac.</h5>
                        <br>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <h3>Editar Perfil</h3>
                        </button>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <h1 class="titulo">Listas</h1>
                <div class="row mb-5">
                    <div class="col">
                        <h1 class="subtitulo">Peliculas y Series</h1>
                    </div>
                    <div class="col">
                        <h1 class="subtitulo">Libros</h1>
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
                                            <img id="selectedAvatar" src="https://cdn.hero.page/pfp/daca14e0-298a-4675-a868-7a0308d6edc1-neko-girl-pfp-anime-cute-pfp-from-popular-shows-1.png"
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
                                            <img id="selectedAvatar" src="https://cdn.imgchest.com/files/l7lxcgnrl57.png"
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
                                            <img id="selectedAvatar" src="https://cdn.hero.page/pfp/59a0bbc4-5aa5-4a60-85fc-74a52ad1a89f-schoolgirl-with-pink-hair-cute-anime-pfp-girl-styles-1.png"
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
                                            <img id="selectedAvatar" src="https://pbs.twimg.com/media/F-28_vlXcAAcJFP.jpg"
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

                    <br>
                    <div class="col animate__animated animate__bounceInUp">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                <h1>Actividad Reciente</h1>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="selectedAvatar" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQr3MEldN3QAarU4EydTIY1JCRJhv83VFSffg&s"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9">
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="selectedAvatar" src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/97f5e2de-0a65-4192-a65b-5f265139e2fb/dhpk887-30b845ac-235e-46c3-8099-87b5eb566890.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzk3ZjVlMmRlLTBhNjUtNDE5Mi1hNjViLTVmMjY1MTM5ZTJmYlwvZGhwazg4Ny0zMGI4NDVhYy0yMzVlLTQ2YzMtODA5OS04N2I1ZWI1NjY4OTAuanBnIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.NtQOwlx3uMf38hVqpE-16QrYoJqNKk_dMdaJPqrT0RE"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9">
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="selectedAvatar" src="https://manybackgrounds.com/images/hd/aesthetic-anime-pfp-ken-kaneki-i9e6lrp51a1jitjf.jpg"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9">
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action amigos-caja" aria-current="true">
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <img id="selectedAvatar" src="https://manybackgrounds.com/images/hd/aesthetic-anime-pfp-ken-kaneki-i9e6lrp51a1jitjf.jpg"
                                                class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="example placeholder" />
                                        </div>
                                    </div>
                                    <div class="col-9">
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
                    <h3 class="modal-title">Modal title</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div>
                            <div class="d-flex justify-content-center mb-4">
                                <img id="selectedAvatar" src="https://i.pinimg.com/originals/9b/aa/62/9baa62b8c23ec8d7c622038ce13d0519.jpg"
                                    class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                            </div>
                            <div class="d-flex justify-content-center">
                                <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                                    <label class="form-label text-white m-1" for="customFile2">Choose file</label>
                                    <input type="file" class="form-control d-none" id="customFile2" onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nombre" class="col-form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre">
                            </div>
                            <div class="col">
                                <label for="primer-apellido" class="col-form-label">Primer Apellido</label>
                                <input type="text" class="form-control" id="primer-apellido">
                            </div>
                            <div class="col">
                                <label for="segundo-apellido" class="col-form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" id="segundo-apellido">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nombre" class="col-form-label">Correo</label>
                                <input type="text" class="form-control" id="nombre">
                            </div>
                            <div class="col">
                                <label for="primer-apellido" class="col-form-label">Telefono</label>
                                <input type="text" class="form-control" id="primer-apellido">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Editar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include_once "./templates/Header_Footer/footer.php"; ?>

</body>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script src="https://unpkg.com/scrollreveal"></script>

<!-- JS Personalizado -->
<script src="./assets/signIn/signIn.js"></script>

</html>