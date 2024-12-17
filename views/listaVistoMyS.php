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
  <title>Lista de Peliculas o Series ya vistas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/listaInterna.css" >
  <link rel="stylesheet" href="./assets/css/header.css" >
</head>

<body>
    <header>
      <?php include './templates/Header_Footer/header.php' ?>
    </header>

    <input type="hidden" id="ID_Usuario" value="<?php echo $id ?>">
    
    <article class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="text-center Nombre_Grande">Peliculas y Series Ya vistas</h1>
      </div>
    </div>
  </article>

  <ul id="PorVer">
    <div class="container contenedor container-YV"></div>
  </ul>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="./assets/js/Listas/ListaInterna.js"></script>

<script src="./assets/js/Listas/SeriesYPelis/Visto/ListarLista.js"></script>

</html>