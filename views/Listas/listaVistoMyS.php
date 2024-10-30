<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Peliculas o Series ya vistas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/listaInterna.css">
  <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
  <header>
    <?php include '../templates/Header_Footer/header.php' ?>
  </header>

  <h1 class="text-center Nombre_Grande">Ya vistos</h1>

  <div class="container">
    <div class="row">
      <div class="col">
        <form class="d-flex space" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>  

      <div class="col">

      </div>

      <div class="col">
        <label for="id_label_multiple">
          <select class="js-example-basic-multiple js-states form-control filtro" id="id_label_multiple" multiple="multiple"></select>
        </label>
      </div>
    </div>
  </div>

  <div class="container container-fluid contenedor">
    <div class="row">
      <div class="col-12 "> 
        <div class="UnaLinea">
          <a data-fancybox class="imagen-1" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTe3-Dz4gNSDiDin93KBLLGbhD82GBdCYq-nA&s" data-caption="Barbie Fairytopia">
            <img class="imagen-2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTe3-Dz4gNSDiDin93KBLLGbhD82GBdCYq-nA&s" width="153" height="247" alt="" />
          </a>
          <div class="todoBlanco">
            <p><strong>Barbie Fairytopia</strong></p>
            <p>Barbie en el papel de Elina. Atravesando el arco iris se llega al mundo de Fairytopia, donde vive Elina, una preciosa hada de las flores que daría cualquier cosa por tener alas.</p>
            <p>Genero: <em>Fantasia</em></p>
            <p><em>2005</em></p>
          </div>
        </div>
        <hr>
        <div class="UnaLinea">
          <a data-fancybox class="imagen-1" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTe3-Dz4gNSDiDin93KBLLGbhD82GBdCYq-nA&s" data-caption="Barbie Fairytopia">
            <img class="imagen-2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTe3-Dz4gNSDiDin93KBLLGbhD82GBdCYq-nA&s" width="153" height="247" alt="" />
          </a>
          <div class="todoBlanco">
            <p><strong>Barbie Fairytopia</strong></p>
            <p>Barbie en el papel de Elina. Atravesando el arco iris se llega al mundo de Fairytopia, donde vive Elina, una preciosa hada de las flores que daría cualquier cosa por tener alas.</p>
            <p>Genero: <em>Fantasia</em></p>
            <p><em>2005</em></p>
          </div>
        </div>
        <hr>
        <div class="UnaLinea">
          <a data-fancybox class="imagen-1" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTe3-Dz4gNSDiDin93KBLLGbhD82GBdCYq-nA&s" data-caption="Barbie Fairytopia">
            <img class="imagen-2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTe3-Dz4gNSDiDin93KBLLGbhD82GBdCYq-nA&s" width="153" height="247" alt="" />
          </a>
          <div class="todoBlanco">
            <p><strong>Barbie Fairytopia</strong></p>
            <p>Barbie en el papel de Elina. Atravesando el arco iris se llega al mundo de Fairytopia, donde vive Elina, una preciosa hada de las flores que daría cualquier cosa por tener alas.</p>
            <p>Genero: <em>Fantasia</em></p>
            <p><em>2005</em></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../assets/js/Listas/ListaInterna.js"></script>
</html>