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

<!-- Encabezado para Películas y Series -->
    <section>
      <p class="Nombre_Grande">Películas y Series</p>
      <div class="container contenedor">
        <div class="row gx-3">
          <!-- Favoritos -->
          <div class="col-2">
            <a href="./listaFavoritosMyS.php" class="hvr-radial-in-MyS-Favorito hvr-round-corners">
              <img src="./assets/img/heart.png" class="rounded cuadrado-MyS" alt="Favoritos">
            </a>
          </div>
          <!-- Por Ver -->
          <div class="col-2">
            <a href="./listaPorVerMyS.php" class="hvr-radial-in-MyS-PorVer hvr-round-corners">
              <img src="./assets/img/vision (1).png" class="rounded cuadrado-MyS" alt="Por Ver">
            </a>
          </div>
          <!-- Vistos -->
          <div class="col-2">
            <a href="./listaVistoMyS.php" class="hvr-radial-in-MyS-Visto hvr-round-corners">
              <img src="./assets/img/verified (2).png" class="rounded cuadrado-MyS" alt="Vistos">
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Encabezado para Libros -->
    <section>
      <p class="Nombre_Grande">Libros</p>
      <div class="container contenedor">
        <div class="row gx-3">
          <!-- Favoritos -->
          <div class="col-2">
            <a href="./listaFavoritosL.php" class="hvr-radial-in-L-Favorito hvr-round-corners">
              <img src="./assets/img/heart.png" class="rounded cuadrado-L" alt="Favoritos">
            </a>
          </div>
          <!-- Por Leer -->
          <div class="col-2">
            <a href="./listaPorVerL.php" class="hvr-radial-in-L-PorVer hvr-round-corners">
              <img src="./assets/img/vision (1).png" class="rounded cuadrado-L" alt="Por Leer">
            </a>
          </div>
          <!-- Leídos -->
          <div class="col-2">
            <a href="./listaVistoL.php" class="hvr-radial-in-L-Visto hvr-round-corners">
              <img src="./assets/img/verified (2).png" class="rounded cuadrado-L" alt="Leídos">
            </a>
          </div>
        </div>
      </div>
    </section>
</body>
</html>