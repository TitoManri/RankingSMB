<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/lista.css" >
    <link rel="stylesheet" href="./assets/css/header.css" >
</head>
<body>
  <?php include_once "./templates/Header_Footer/header.php" ?>

  <p class="Nombre_Grande">Peliculas Y Series</p>
    <div class="container container-fluid contenedor">
      <div class="row gx-3">
        <div class="col-2">
          <a href="./listaFavoritosMyS.php" class="hvr-radial-in-MyS-Favorito hvr-round-corners">
            <img src="./assets/img/heart.png" class="rounded cuadrado-MyS" alt="">
          </a>
        </div>
        <div class="col-2">
          <a href="./listaPorVerMyS.php" class="hvr-radial-in-MyS-PorVer hvr-round-corners">
            <img src="./assets/img/vision (1).png" class="rounded  cuadrado-MyS" alt="">
          </a>        
        </div>
        <div class="col-2 cuadrado">
          <a href="./listaVistoMyS.php" class="hvr-radial-in-MyS-Visto hvr-round-corners">
            <img src="./assets/img/verified (2).png" class="rounded  cuadrado-MyS" alt="">
          </a>
        </div>
      </div>
    </div>

  <p class="Nombre_Grande">Libros</p>
  <div class="container container-fluid contenedor">
      <div class="row gx-3">
        <div class="col-2">
          <a href="./listaFavoritosL.php" class="hvr-radial-in-L-Favorito hvr-round-corners">
            <img src="./assets/img/heart.png" class="rounded  cuadrado-L" alt="">
          </a>
        </div>
        <div class="col-2">
          <a href="./listaPorVerL.php" class="hvr-radial-in-L-PorVer hvr-round-corners">
            <img src="./assets/img/vision (1).png" class="rounded  cuadrado-L" alt="">
          </a>        
        </div>
        <div class="col-2">
          <a href="./listaVistoL.php" class="hvr-radial-in-L-Visto hvr-round-corners">
            <img src="./assets/img/verified (2).png" class="rounded  cuadrado-L" alt="">
          </a>
        </div>
      </div>
    </div>  
</body>
</html>