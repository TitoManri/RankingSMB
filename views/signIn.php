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
    <link rel="stylesheet" href="./assets/signIn/signIn.css">
    <link rel="stylesheet" href="./assets/css/header.css">
    <title>LogIn</title>
</head>

<body>
    <!-- Header -->
    <?php
    include_once "./templates/Header_Footer/header.php"
    ?>

    <section id="contenido-principal">
        <div class="container text-center">
            <div class="row">
                <div class="col"></div>
                <div class="col ml-4">
                    <section class="caja-login">
                        <div class="container">
                            <form>
                                <center>
                                    <h1>Registrarse</h1>
                                </center>
                                <hr class="hr" />
                                <div>
                                    <div class="d-flex justify-content-center mb-4">
                                        <img id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg"
                                            class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                                            <label class="form-label text-white m-1" for="customFile2">Choose file</label>
                                            <input type="file" class="form-control d-none" id="customFile2" onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <div class="input-wrapper">
                                            <input type="text" class="input" id="nombre" placeholder=" " autocomplete="off" />
                                            <label class="label" for="nombre">Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-wrapper">
                                            <input type="text" class="input" id="primerApellido" placeholder=" " autocomplete="off" />
                                            <label class="label" for="primerApellido">Primer Apellido</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-wrapper">
                                            <input type="text" class="input" id="segundoApellido" placeholder=" " autocomplete="off" />
                                            <label class="label" for="segundoApellido">Segundo Apellido</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col">
                                        <div class="input-wrapper">
                                            <input type="text" class="input" id="nombreUsuario" placeholder=" " autocomplete="off" />
                                            <label class="label" for="nombreUsuario">Nombre de Usuario</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-wrapper">
                                            <input type="email" class="input" id="correo" placeholder=" " autocomplete="off" />
                                            <label class="label" for="correo">Correo</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col">
                                        <div class="input-wrapper">
                                            <input type="text" class="input" id="codigoPais" placeholder=" " autocomplete="off" />
                                            <label class="label" for="codigoPais">Código País</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-wrapper">
                                            <input type="text" class="input" id="telefono" placeholder=" " autocomplete="off" />
                                            <label class="label" for="telefono">Teléfono</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col">
                                        <div class="input-wrapper">
                                            <input type="password" class="input" id="contrasena" placeholder=" " autocomplete="off" />
                                            <label class="label" for="contrasena">Contraseña</label>
                                        </div>
                                    </div>
                                    <div class="input-wrapper">
                                        <input type="password" class="input" id="confirmarContrasena" placeholder=" " autocomplete="off" />
                                        <label class="label" for="confirmarContrasena">Confirmar Contraseña</label>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary">Registrarse</button>
                            </form>
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <?php
    include_once "./templates/Header_Footer/footer.php"
    ?>

</body>
<!-- Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!-- Js Personalizado-->
<script src="./assets/signIn/signIn.js"></script>
</html>