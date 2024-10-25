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
    <link rel="stylesheet" href="./assets/signIn/logIn.css">
    <link rel="stylesheet" href="./assets/css/header.css">
    <title>Iniciar Sesión</title>
</head>


<body>
    <!-- Header -->
    <?php
    include_once "./templates/Header_Footer/header.php"
    ?>

    <section id="contenido-principal">
        <div class=" text-center">
            <div class="row gx-5">

                <div class="col-7">
                    <section class="caja-login">
                        <div class="container">
                            <form>
                                <br>
                                <center>
                                    <h1>Iniciar Sesión</h1>
                                </center>
                                <hr class="hr" />
                                <div class="input-wrapper">
                                    <input type="email" class="input" id="correo" placeholder=" " autocomplete="off" />
                                    <label class="label" for="correo">Nombre de Usuario o correo</label>
                                    <div class="input-wrapper">
                                        <input type="password" class="input" id="contrasena" placeholder=" " autocomplete="off" />
                                        <label class="label" for="contrasena">Contraseña</label>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary btn-lg">Registrarse</button>
                                <br>
                                <br>
                            </form>
                        </div>

                    </section>
                </div>
                
                <div class="col-4">
                    <section class="caja-logo">
                        <div class="text-center">
                            <h1 class="text-center">RankingSMB</h1>
                            <img src="./assets/img/Logo_RankingSMB.png" alt="Logo_RankingSMB" height="256">
                            <hr class="hr" />
                            <h2>Bienvenido a RankingSMB, disfruta tu experiencia con nosotros</h2>
                        </div>
                        </section=>
                </div>
                <div class="col-1 mx-auto"></div>
            </div>
        </div>
    </section>
    <section id="contenido-frases">
        <div class=" text-center">
            <div class="row gx-5 align-items-center">
                <div class="col-5">
                    <section class="">
                        <div class="text-center">
                            <img class="poster" src="https://cloudfront-us-east-1.images.arcpublishing.com/copesa/S4367N7H5VAYTB225C4GCG2ZHI.jpeg" alt="Logo_RankingSMB" height="700">
                        </div>
                    </section>
                </div>
                <div class="col-6">
                    <section class="cita">
                        <div class="text-center">
                            <h2>"No es responsabilidad de los científicos decidir si se debe utilizar o no una bomba de hidrógeno. Esa responsabilidad corresponde al pueblo norteamericano y a los representantes por él elegidos"-Robert Oppenheimer</h2>
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

<script src="https://unpkg.com/scrollreveal"></script>

<!-- Js Personalizado-->
<script src="./assets/signIn/signIn.js"></script>


</html>