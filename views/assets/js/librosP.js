//Cargar libros en el div 
$.ajax({
    url: `https://www.googleapis.com/books/v1/volumes?q=*&orderBy=relevance&projection=lite&key=${googleAPI}&langRestrict=es-CR`,
    type: 'GET',
    success: function (response) {
        //seleccionar donde se escribirá, en este caso en el div 
        let divLibrosArriba = $("#libros1");

        //limitar los resultados a los primeros 5 libros
        response.items.slice(0, 4).forEach(book => {
            // Verificar si hay una imagen disponible
            let imagen1 = book.volumeInfo.imageLinks?.thumbnail || 'https://static.wikia.nocookie.net/cityofdevils/images/3/30/Image-not-available.jpg/revision/latest?cb=20200325180534';

            //crear html con la información de cada libro
            let datos = `
                <div class="column is-one-quarter">
                    <img src="${imagen1}" alt="${book.volumeInfo.title}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${book.volumeInfo.title}</h1>
                    </div>
                </div>
            `;

            //agrega el contenido generado al contenedor principal
            divLibrosArriba.append(datos);
        });

        //seleccionar donde se escribirá, en este caso en el div
        let divLibrosAbajo = $("#libros2");

        //limitar los resultados a los primeros 5 libros
        response.items.slice(4, 8).forEach(book => {
            // Verificar si hay una imagen disponible
            let imagen2 = book.volumeInfo.imageLinks?.thumbnail || 'https://static.wikia.nocookie.net/cityofdevils/images/3/30/Image-not-available.jpg/revision/latest?cb=20200325180534';

            //crear html con la información de cada libro
            let datos = `
                <div class="column is-one-quarter">
                    <img src="${imagen2}" alt="${book.volumeInfo.title}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${book.volumeInfo.title}</h1>
                    </div>
                </div>
            `;

            //agrega el contenido generado al contenedor principal
            divLibrosAbajo.append(datos);
        });
    },
    error: function (error) {
        console.error(error);
    }
});

//acortar la descripción si excede un límite de caracteres
function truncarTexto(texto) {
    return texto.length > 273 ? texto.substring(0, 273) + "..." : texto;
}

//cargar libros con ratings más altos
$.ajax({
    url: `https://www.googleapis.com/books/v1/volumes?q=*&orderBy=relevance&projection=lite&key=${googleAPI}&langRestrict=es`,
    type: 'GET',
    success: function (response) {
        // Seleccionar el div donde se escribirán los datos
        let divRatingsAltos = $("#RatingsAltos");

        for (const libro of response.items.slice(0, 3)) {
            // Acceder a los autores y título del libro
            const imagen = libro.volumeInfo.imageLinks?.thumbnail || 'https://static.wikia.nocookie.net/cityofdevils/images/3/30/Image-not-available.jpg/revision/latest?cb=20200325180534';
            const titulo = libro.volumeInfo.title || "Título desconocido";
            const autores = libro.volumeInfo.authors ? libro.volumeInfo.authors.join(', ') : "Autor desconocido";
            const descripcion = libro.volumeInfo.description ? truncarTexto(libro.volumeInfo.description) : "Descripción no disponible.";
            const pais = libro.accessInfo?.country || "País no disponible";


            let datos = `
                <div class="movie_card" id="peliculaCard">
                    <div class="info_section">
                        <div class="movie_header">
                            <img class="locandina"
                                src="${imagen}" />
                            <h1>${titulo}</h1>
                            <h4>${libro.volumeInfo.publishedDate}</h4>
                            <span class="episodios">${pais}</span>
                            <p class="type">${autores}</p>
                        </div>
                        <div class="movie_desc">
                            <p class="text">
                                ${descripcion}
                            </p>
                        </div>
                        <div class="movie_social">
                            <ul>
                                <li><i class="material-icons">share</i></li>
                                <li><i class="material-icons"></i></li>
                                <li><i class="material-icons">chat_bubble</i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="blur_back" style="background-image: url('https://www.readingrockets.org/sites/default/files/styles/share_image/public/2023-05/a-z-about-reading-2.jpg?itok=0_SUq0LQ');"></div>
                </div>
            `;

            // Agregar el contenido al div
            divRatingsAltos.append(datos);
        }
    },
    error: function () {
        console.error("Error al cargar los libros.");
        $("#RatingsAltos").html("<p>Error al cargar los libros.</p>");
    }
});

