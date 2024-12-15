// Acortar la descripción si excede un límite de caracteres
function truncarTexto(texto) {
    return texto.length > 273 ? texto.substring(0, 273) + "..." : texto;
}

// Función para buscar detalles de una película
async function buscarDetallesPelícula(idPelicula) {
    try {
        const response = await $.ajax({
            url: `https://api.themoviedb.org/3/movie/${idPelicula}?language=es-CR`,
            type: 'GET',
            headers: {
                accept: "application/json",
                Authorization: `Bearer ${tmdbAPI}`
            }
        });
        return response;
    } catch (error) {
        console.error('Error al buscar detalles de la película:', error);
        throw error;
    }
}

// Función para buscar una película en la base de datos
async function BuscarPeliculaEnBD(idPelicula) {
    try {
        const response = await $.ajax({
            url: `../controllers/peliculasController.php?op=existePeliculaEnBD`,
            type: 'POST',
            data: { ID_Pelicula: idPelicula },
            dataType: 'json'
        });

        if (response.exito) {
            // Si existe la película en la BD, la devuelve
            return response.object;
        } else {
            // Si no existe, buscar los detalles y guardarla
            const detallesPelicula = await buscarDetallesPelícula(idPelicula);
            const nuevaPelicula = await guardarPeliculaEnBD(detallesPelicula, idPelicula);
            return nuevaPelicula;
        }
    } catch (error) {
        console.error('Error al buscar la película en BD:', error);
        throw error;
    }
}

// Función para guardar una película en la base de datos
async function guardarPeliculaEnBD(pelicula, id) {
    const generos = pelicula.genres;
    const estado =
        pelicula.status === "Released" ? "Lanzada" :
            pelicula.status === "In Production" ? "En producción" :
                "Estado desconocido";

    let nuevaPelicula = {
        ID_Pelicula: id,
        TituloOriginal: pelicula.original_title,
        TituloTraducido: pelicula.title,
        Generos: generos,
        Lanzamiento: pelicula.release_date,
        Sinopsis: pelicula.overview,
        Duracion: pelicula.runtime,
        Poster: `https://image.tmdb.org/t/p/original/${pelicula.poster_path}`,
        CostoPelicula: pelicula.budget,
        RecaudacionPelicula: pelicula.revenue,
        CalificacionGeneral: pelicula.vote_average,
        Estado: estado,
        Publico: pelicula.adult
    };

    try {
        const response = await $.ajax({
            url: `../controllers/peliculasController.php?op=SubirPelicula`,
            type: 'POST',
            data: nuevaPelicula,
            dataType: 'json'
        });
        return nuevaPelicula; 
    } catch (error) {
        console.error('Error al guardar la película en BD:', error);
        throw error;
    }
}

//cargar películas en el div
async function cargarPeliculas() {
    try {
        const response = await $.ajax({
            url: 'https://api.themoviedb.org/3/movie/popular?language=es-CR&page=1',
            type: 'GET',
            headers: {
                accept: "application/json",
                Authorization: `Bearer ${tmdbAPI}`
            }
        });

        //seleccionar el div donde se mostrarán las películas
        let divPeliculas = $("#peliculas");

        //limitar los resultados a las primeras 8 películas
        const peliculas = response.results;

        //agregar las primeras 4 películas al div superior
        for (const movie of peliculas.slice(0, 4)) {
            //verificar existencia en la base de datos
            const peliculaEnBD = await BuscarPeliculaEnBD(movie.id);
            const poster = peliculaEnBD ? peliculaEnBD.Poster : movie.poster_path;
            const titulo = peliculaEnBD ? peliculaEnBD.TituloTraducido : movie.title;

            //crear el HTML con la información de la película
            let datos = `
                <div class="column is-one-quarter">
                <a href="verResennasPelicula.php?id=${movie.id}">
                    <img src="https://image.tmdb.org/t/p/w500${poster}" alt="${titulo}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${titulo}</h1>
                    </div>
                    </a>
                </div>
            `;

            //agregar el contenido generado al contenedor principal
            divPeliculas.append(datos);
        }
    } catch (error) {
        console.error("Error al cargar las películas:", error);
    }
}
//----------------------------------------------------------------//----------------------------------------------------------------
//buscar detalles del libro
async function buscarDetallesLibro(idLibro) {
    try {
        const response = await $.ajax({
            url: `https://www.googleapis.com/books/v1/volumes/${idLibro}?key=${googleAPI}&langRestrict=es-CR`,
            type: 'GET'
        });
        return response;
    } catch (error) {
        console.error('Error al buscar detalles del libro:', error);
        throw error;
    }
}

//buscar libros en la base de datos
async function BuscarLibroEnBD(id) {
    try {
        const response = await $.ajax({
            url: `../controllers/librosController.php?op=existeLibroEnBD`,
            type: 'POST',
            data: {
                ID_Libro: id
            }
        });

        if (response.exito) {
            //si existe el libro en la bd, lo devuelve
            return response.object;
        } else {
            //si no existe, buscar los detalles y guardarlo
            const detallesLibro = await buscarDetallesLibro(id);
            const nuevoLibro = await guardarLibroEnBD(detallesLibro, id);
            return nuevoLibro;
        }

    } catch (error) {
        console.error('Error al buscar el libro en BD:', error);
        throw error;
    }
}

//guardar libro en la bd
async function guardarLibroEnBD(libro, id) {
    let adulto = "Error";
    if (libro.volumeInfo.maturityRating == "NOT_MATURE") adulto = "Para todo mundo"
    else adulto = "Para mayores de edad";
    let sinopsis = libro.volumeInfo?.description || "No disponible";
    let autor = libro.volumeInfo?.authors?.[0] || "No disponible";
    let linkCompraGoogle = libro.saleInfo?.buyLink || "No disponible";
    let paginas = libro.volumeInfo.pageCount || 1;
    let publicacion = libro.volumeInfo.publishedDate || "2024-01-01";
    let publicante = libro.volumeInfo.publisher || "No disponible";
    let titulo = libro.volumeInfo.title || "No disponible";

    let libroNuevo = {
        ID_Libro: id,
        Titulo: titulo,
        Publicante: publicante,
        Autor: autor,
        Lanzamiento: publicacion,
        Publico: adulto,
        Sinopsis: sinopsis,
        Poster: `https://books.google.com/books/publisher/content/images/frontcover/${id}?fife=w400-h600&source=gbs_api`,
        TotalPaginas: paginas,
        LinkCompraGoogle: linkCompraGoogle
    };

    try {
        const response = await $.ajax({
            url: `../controllers/librosController.php?op=SubirLibro`,
            type: 'POST',
            data: libroNuevo,
            dataType: 'json'
        });
        return libroNuevo;
    } catch (error) {
        console.error('Error al guardar el libro en BD:', error);
        throw error;
    }
}

//Cargar libros en el div 
async function cargarLibros() {
    try {
        const response = await $.ajax({
            url: `https://www.googleapis.com/books/v1/volumes?q=*&orderBy=relevance&projection=lite&key=${googleAPI}&langRestrict=es-CR`,
            type: 'GET'
        });

        //seleccionar donde se escribirá, en este caso en el div
        let divLibros = $("#libros");
        //limitar los resultados a los primeros 8 libros
        const libros = response.items;

        //agregar las primeras 4 películas al div superior
        for (const book of libros.slice(0, 4)) {
            //verificar existencia en la base de datos
            const libroEnBD = await BuscarLibroEnBD(book.id);
            const imagen = libroEnBD ? libroEnBD.Poster : `https://books.google.com/books/publisher/content/images/frontcover/${book.id}?fife=w400-h600&source=gbs_api`;
            const titulo = libroEnBD ? libroEnBD.Titulo : book.volumeInfo.title;

            //crear el HTML con la información del libro
            let datos = `
                <div class="column is-one-quarter">
                <a href="verResennasLibros.php?id=${book.id}">
                    <img src="${imagen}" alt="${titulo}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${titulo}</h1>
                    </div>
                    </a>
                </div>
            `;

            //agrega el contenido generado al contenedor principal
            divLibros.append(datos);
        }
    } catch (error) {
        console.error(error);
    }
}
//----------------------------------------------------------------//----------------------------------------------------------------
// Función para buscar detalles de una serie
async function buscarDetallesSerie(idSerie) {
    try {
        const response = await $.ajax({
            url: `https://api.themoviedb.org/3/tv/${idSerie}?language=es-CR`,
            type: 'GET',
            headers: {
                accept: "application/json",
                Authorization: `Bearer ${tmdbAPI}`
            }
        });
        return response;
    } catch (error) {
        console.error('Error al buscar detalles de la serie:', error);
        throw error;
    }
}

// Función para guardar detalles de una serie en la base de datos
async function guardarSerieEnBD(serie, id) {
    let generos = serie.genres ?? [];
    let estado = "";
    if (serie.status == "Returning Series") estado = "Serie de regreso";
    else if (serie.status == "Ended") estado = "Finalizada";
    else if (serie.status == "Canceled") estado = "Cancelada";
    else estado = "Estado desconocido";
    let sipnosis = "";
    if(serie.overview == ""){
        sipnosis = "No disponible";
    } else {
        sipnosis = serie.overview;
    }

    let nuevaSerie = {
        ID_Serie: id,
        TituloOriginal: serie.original_name ?? "No encontrado",
        TituloTraducido: serie.name ?? "No encontrado",
        Generos: generos,
        Lanzamiento: serie.first_air_date,
        Sinopsis: sipnosis,
        Poster: serie.poster_path ? `https://image.tmdb.org/t/p/original/${serie.poster_path}` : "No encontrado",
        CapitulosTotales: serie.number_of_episodes,
        Temporadas: serie.number_of_seasons,
        CalificacionGeneral: serie.vote_average,
        Estado: estado,
        Publico: serie.adult ?? false
    };

    try {
        const response = await $.ajax({
            url: `../controllers/seriesController.php?op=SubirSerie`,
            type: 'POST',
            data: nuevaSerie, 
            dataType: 'json'
        });
        return nuevaSerie;

    } catch (error) {
        console.error('Error al guardar la serie en BD:', error);
        throw error;
    }
}


// Función para buscar una serie en la base de datos
async function BuscarSerieEnBD(idSerie) {
    try {
        const response = await $.ajax({
            url: `../controllers/seriesController.php?op=existeSerieEnBD`,
            type: 'POST',
            data: {
                ID_Serie: idSerie
            },
            dataType: 'json'
        });

        if (response.exito) {
            // Si existe la serie en la BD, la devuelve
            return response.object;
        } else {
            // Si no existe, busca los detalles y la guarda
            const detallesSerie = await buscarDetallesSerie(idSerie);
            const nuevaSerie = await guardarSerieEnBD(detallesSerie, idSerie);
            return nuevaSerie;
        }
    } catch (error) {
        console.error('Error al buscar la serie en BD:', error);
        throw error;
    }
}

// Cargar series al final --> ratings más altos
async function cargarSeries() {
    try {
        const response = await $.ajax({
            url: 'https://api.themoviedb.org/3/tv/top_rated?language=es-CR&page=1',
            type: 'GET',
            headers: {
                accept: "application/json",
                Authorization: `Bearer ${tmdbAPI}`
            }
        });

        // Seleccionar donde se escribirá, en este caso en el div con id RatingsAltos
        let divRatingsAltos = $("#series");

        // Limitar los resultados a las primeras 3 series
        const series = response.results.slice(0, 3);

        for (const serie of series) {
            // Verificar existencia en la base de datos
            const serieEnBD = await BuscarSerieEnBD(serie.id);
            const generos = serieEnBD.Generos.map(genero => genero.name).join(", ");
            const sinopsisTruncada = truncarTexto(serieEnBD.Sinopsis);
            let timestamp = serieEnBD.Lanzamiento.$date.$numberLong;
            let fechaLanzamiento = new Date(parseInt(timestamp));
            let fechaFormateada = fechaLanzamiento.toLocaleDateString('es-CR', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Crear HTML con la información de cada película
            let datos = `
                    <div class="movie_card" id="peliculaCard">
                    <a href="verResennasSeries.php?id=${serie.id}">
                        <div class="info_section">
                            <div class="movie_header">
                                <img class="locandina"
                                    src="https://image.tmdb.org/t/p/w500${serieEnBD.Poster}" />
                                <h1>${serieEnBD.TituloTraducido}</h1>
                                <h4>${fechaFormateada}</h4>
                                <span class="episodios">${serieEnBD.CapitulosTotales} episodios</span>
                                <p class="type">${generos}</p>
                            </div>
                            <div class="movie_desc">
                                <p class="text">
                                    ${sinopsisTruncada}
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
                    </a>
                        </div>
                `;

            // Agregar el contenido generado al contenedor principal
            divRatingsAltos.append(datos);
        }
    } catch (error) {
        console.error("Error al cargar las serie:", error);
    }
}


// Ejecutar prueba al cargar la página
$(function () {
    cargarPeliculas();
    cargarLibros();
    cargarSeries();
});