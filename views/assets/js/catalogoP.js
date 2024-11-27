//Cargar películas y series en el div de arriba
$.ajax({
    url: 'https://api.themoviedb.org/3/movie/popular?language=es-CR&page=1',
    type: 'GET',
    headers: {
        accept: "application/json",
        Authorization: `Bearer ${tmdbAPI}`
    },
    success: function (response) {
        //seleccionar donde se escribirá, en este caso en el div con id peliculasSeries
        let divPeliculasArriba = $("#peliculasSeries");

        //limitar los resultados a las primeras 5 películas
        response.results.slice(0, 4).forEach(movie => {
            //crear html con la información de cada película
            let datos = `
                <div class="column is-one-quarter">
                    <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" alt="${movie.original_title}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${movie.original_title}</h1>
                    </div>
                </div>
            `;

            //agrega el contenido generado al contenedor principal
            divPeliculasArriba.append(datos);
        });
    },
    error: function (error) {
        console.error(error);
    }
});

//Cargar libros en el div de abajo
$.ajax({
    url: `https://www.googleapis.com/books/v1/volumes?q=*&orderBy=relevance&projection=lite&key=${googleAPI}&langRestrict=es-CR`,
    type: 'GET',
    success: function (response) {
        //seleccionar donde se escribirá, en este caso en el div con id libros
        let divLibros = $("#libros");

        //limitar los resultados a los primeros 5 libros
        response.items.slice(0, 4).forEach(book => {
            // Verificar si hay una imagen disponible
            let imagen = `https://books.google.com/books/publisher/content/images/frontcover/${book.id}?fife=w400-h600&source=gbs_api`;

            //crear html con la información de cada libro
            let datos = `
                <div class="column is-one-quarter">
                    <img src="${imagen}" alt="${book.volumeInfo.title}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${book.volumeInfo.title}</h1>
                    </div>
                </div>
            `;

            //agrega el contenido generado al contenedor principal
            divLibros.append(datos);
        });
    },
    error: function (error) {
        console.error(error);
    }
});

// Obtener géneros y cantidad de episodios de las películas
async function verEpisodios(idSerie) {
    try {
        const response = await $.ajax({
            url: `https://api.themoviedb.org/3/tv/${idSerie}?language=es-CR&page=1`,
            type: 'GET',
            headers: {
                accept: "application/json",
                Authorization: `Bearer ${tmdbAPI}`
            }
        });
        return response.number_of_episodes;
    } catch (error) {
        console.error(error);
    }
}

async function verGeneros(idSerie) {
    try {
        const response = await $.ajax({
            url: `https://api.themoviedb.org/3/tv/${idSerie}?language=es-CR&page=1`,
            type: 'GET',
            headers: {
                accept: "application/json",
                Authorization: `Bearer ${tmdbAPI}`
            }
        });
        const nombresGenero = response.genres.map(genre => genre.name);
        return nombresGenero.join(", ");
    } catch (error) {
        console.error(error);
    }
}

// Acortar la descripción si excede un límite de caracteres
function truncarTexto(texto) {
    return texto.length > 273 ? texto.substring(0, 273) + "..." : texto;
}

// Cargar series al final --> ratings más altos
$.ajax({
    url: 'https://api.themoviedb.org/3/tv/top_rated?language=es-CR&page=1',
    type: 'GET',
    headers: {
        accept: "application/json",
        Authorization: `Bearer ${tmdbAPI}`
    },
    success: async function (response) {  
        //seleccionar donde se escribirá, en este caso en el div con id RatingsAltos
        let divRatingsAltos = $("#RatingsAltos");

        // Limitar los resultados a las primeras 3 películas
        for (const serie of response.results.slice(0, 3)) {
            // Esperar a obtener runtime y géneros
            let episodiosCant = await verEpisodios(serie.id);
            let generos = await verGeneros(serie.id);
            let descripcion = truncarTexto(serie.overview);

            // Crear html con la información de cada película
            let datos = `
                <div class="movie_card" id="peliculaCard">
                    <div class="info_section">
                        <div class="movie_header">
                            <img class="locandina"
                                src="https://image.tmdb.org/t/p/w500${serie.poster_path}" />
                            <h1>${serie.name}</h1>
                            <h4>${serie.first_air_date}</h4>
                            <span class="episodios">${episodiosCant} episodios</span>
                            <p class="type">${generos}</p>
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
                    <div class="blur_back" style="background-image: url('https://image.tmdb.org/t/p/w500${serie.backdrop_path}');"></div>
                </div>
            `;

            // Agrega el contenido generado al contenedor principal
            divRatingsAltos.append(datos);
        }
    },
    error: function (error) {
        console.error(error);
    }
});
