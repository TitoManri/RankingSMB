$(document).ready(function(){
    console.log("Si entro #1")
    const idUsuario = document.getElementById("idUsuario").value;
    console.log("Este es el usuario: " + idUsuario);

    $.ajax({
        url: '../controllers/listrasMyS.php', 
        method: 'POST', 
        data: {
            op: 'listarFavoritosMyS',  
            idUsuario: idUsuario      
        },
        success: function (response) {
            console.log("Respuesta recibida:", response);
        
            // Validamos si el estado es exitoso
            if (response.status === 'success') {
                const favoritos = response.data; // Obtenemos la lista de favoritos
                const contenedor = document.getElementById('contenedorFavoritos'); // Identificamos el contenedor
        
                contenedor.innerHTML = ''; // Limpiamos el contenedor antes de agregar nuevos elementos
        
                // Iteramos sobre los favoritos
                favoritos.forEach(favorito => {
                    const elemento = document.createElement('div');
                    elemento.classList.add('container', 'contenedor', 'container-Fav');
        
                    // Agregamos el contenido HTML dinámico
                    elemento.innerHTML = `
                        <div class="row">
                            <div class="col-12">
                                <div class="UnaLinea">
                                    <a data-fancybox class="imagen-1" href="${favorito.Poster}" data-caption="${favorito.Title}">
                                        <img class="imagen-2" src="${favorito.Poster}" width="153" height="247" alt="${favorito.Title}" />
                                    </a>
                                    <div class="todoBlanco">
                                        <p><strong>${favorito.Title}</strong></p>
                                        <p>${favorito.Plot}</p>
                                        <p><em>${favorito.Year}</em></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
        
                    contenedor.appendChild(elemento); // Agregamos el elemento al contenedor
                });
            } else {
                // Si hubo un error, lo mostramos en la consola o en el DOM
                console.error('Error:', response.message);
            }
        },
        error: function(xhr, status, error) {
            // Esta función se ejecuta si la solicitud falla
            console.error('Error en la solicitud AJAX:', error);
        }
    });
    

})