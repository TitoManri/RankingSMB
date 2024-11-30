//Notificaciones: Cargar Notificaciones
$(document).ready(function() {
  //console.log("Holaaaaaaaaaaaaaaaaaaaaaaa");
  const idUsuario = document.getElementById("idUsuario").value;
  console.log("Este es el usuario: " + idUsuario);

  // Realizar la solicitud AJAX
  $.ajax({
      //Donde esta tu controller
      url: '../controllers/notificaciones.php',
      //GET, POST, PUT, DELETE / POST, porque este puede accesar y devolver informacion y es mas flexible que el GET
      method: 'POST',
      //Data que se va a mandar al controller
      data: {
          op: 'cargarNotificaciones', 
          idUsuario: idUsuario
      },
      
      //Tipo de dato que se va a manejar en la respuesta / o sea se le va a devolver un JSON al ajax para que verifique la respuesta
      dataType: 'json',
      //Si es correcto
      success: function (respuesta) {
        console.log("Arreglo de notificaciones recuperado:", respuesta.notificaciones);
        const contenedor = document.getElementById('listaDeNotificaciones'); // Conectar con el contenedor

        contenedor.innerHTML = ''; // Limpiar antes de mostrar nuevas notificaciones
      
        respuesta.notificaciones.forEach(notificacion => {
          const elemento = document.createElement('div');
          elemento.classList.add('notificacion');
      
          // Definimos la clase y estado del checkbox según si está leído o no
          const isLeido = notificacion.Leido;
          const checkboxAttributes = isLeido 
              ? 'checked disabled' 
              : '';
          const idNotificacion = notificacion._id;
          console.log("Item: " + idNotificacion.toString());
          console.log('Item: ' + JSON.stringify(idNotificacion));

          JSON.stringify(idNotificacion);

          // Plantilla HTML más limpia
          //Cuando es un objectID se tiene que pasar a string
          elemento.innerHTML = `
              <div class="row">
                  <div class="col-10"> 
                      <article class="text contenedor-interno notification ${isLeido ? 'read' : 'unreaded'}">
                          <img src="./assets/img/estrella.png" class="img" alt="...">
                          <h5>${notificacion.TipoNotificacion || 'Notificación'}</h5>
                      </article>
                      <br>
                  </div>
                  <div class="col-2 d-flex justify-content-end align-items-center"> 
                      <input class="form-check-input leido" type="checkbox" value="${isLeido}" name="${idNotificacion}" ${checkboxAttributes}> 
                  </div>
              </div>
          `;
      
          contenedor.appendChild(elemento);
      });
      
         // Aquí se muestra el arreglo en la consola
      },

      //Por si tira un error
      error: function (xhr, status, error) {
          console.error("Error en la solicitud AJAX:", error);
      }
  });
});

/**
//HTML de Referencia

<article class="text contenedor-interno notification unreaded">
  <img src="./assets/img/estrella.png" class="img" alt="...">
  <h5>Tienes una nueva recomendacion</h5>
</article> 

 */