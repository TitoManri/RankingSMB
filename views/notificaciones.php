<?php
//Inicio de la sesión
session_start();
if (!empty($_SESSION['correo'])) {
    //Variables del usuario
    $id = $_SESSION['id'];
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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/notificaciones.css">
</head>
<body>
  <header>
    <?php include './templates/Header_Footer/header.php' ?>
  </header>

  <h1 class="text-center Nombre_Grande">Notificaciones</h1>
  <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $id ?>">
  <div class="container contenedor-externo">
    <div class="container">
          <h3 class="Blanco">Actividad Reciente</h3>
            <div id="contenedor-externo">
              <div id="listaDeNotificaciones"> </div>
          </div>
        </div>          
  </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="./assets/js/notificaciones/cargarNotificaciones.js"></script>
<script src="./assets/js/notificaciones/leerNotificacion.js"></script>
</html>