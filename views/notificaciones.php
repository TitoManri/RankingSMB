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

  <div class="container contenedor-externo">
    <div class="container">
      <div class="row">
        <div class="col-12 "> 
          <h3 class="Blanco">Actividad Reciente</h3>
            <div id="contenedor-externo">
            <article class="text contenedor-interno">
              <img src="./assets/img/estrella.png" class="img" alt="...">
              <h5 class="text-strong">Tienes una nueva recomendacion</h5>
            </article>
            <article class="text contenedor-interno">
              <img src="./assets/img/user_friends.png" class="img" alt="...">
              <h5 class="text-strong">El_Topito quiere ser tu amigo</h5>  
            </article>
            <article class="text contenedor-interno">
              <img src="./assets/img/like.png" class="img" alt="...">
              <h5 class="text-strong">Parece que te gusta mucho el genero <em>Fantasia</em> hemos encontrado algo que podria gustarte</h5>
            </article>
            
              <hr>

            <article class="text contenedor-interno">
              <img src="./assets/img/estrella.png" class="img" alt="...">
              <h5>Tienes una nueva recomendacion</h5>
            </article>
            <article class="text contenedor-interno">
              <img src="./assets/img/user_friends.png" class="img" alt="...">
              <h5>Patito quiere ser tu amigo </h5>
            </article>
            <article class="text contenedor-interno">
              <img src="./assets/img/estrella.png" class="img" alt="...">
              <h5>Tienes una nueva recomendacion</h5>
            </article>
            <article class="text contenedor-interno">
              <img src="./assets/img/user_friends.png" class="img" alt="...">
              <h5>Scara14 quiere ser tu amigo </h5>
            </article>
            <article class="text contenedor-interno">
              <img src="./assets/img/like.png" class="img" alt="...">
              <h5>Parece que te gusta mucho el genero <em>Horror</em> hemos encontrado algo que podria gustarte</h5>
            </article>
            <article class="text contenedor-interno">
              <img src="./assets/img/user_friends.png" class="img" alt="...">
              <h5>TitoManri quiere ser tu amigo </h5>
            </article>
            <article class="text contenedor-interno">
              <img src="./assets/img/estrella.png" class="img" alt="...">
              <h5>Tienes una nueva recomendacion</h5>
            </article>
            <article class="text contenedor-interno">
              <img src="./assets/img/user_friends.png" class="img" alt="...">
              <h5>Yorsh quiere ser tu amigo </h5>
            </article>
            <article class="text contenedor-interno">
              <img src="./assets/img/like.png" class="img" alt="...">
              <h5>Parece que te gusta mucho el genero <em>Terror</em> hemos encontrado algo que podria gustarte</h5>
            </article>
            <article class="text contenedor-interno">
              <img src="./assets/img/user_friends.png" class="img" alt="...">
              <h5>Venado_Cola_Blanca quiere ser tu amigo </h5>
            </article>

          </div>
        </div>          
      </div>
    </div>
  </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="./assets/js/notificaciones.js"></script>
</html>