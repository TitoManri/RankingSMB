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
    //Valida los datos antes del insert
    const generos = pelicula.genres || [{ name: "No disponible" }];
    const estado =
        pelicula.status === "Released" ? "Lanzada" :
            pelicula.status === "In Production" ? "En producción" :
                "Estado desconocido";

    //guarda los datos en un objeto
    let nuevaPelicula = {
        ID_Pelicula: id,
        TituloOriginal: pelicula.original_title || "No disponible",
        TituloTraducido: pelicula.title || "No disponible",
        Generos: generos,
        Lanzamiento: pelicula.release_date || "No disponible",
        Sinopsis: pelicula.overview || "No disponible",
        Duracion: pelicula.runtime || "No disponible",
        Poster: pelicula.poster_path ? `https://image.tmdb.org/t/p/original/${pelicula.poster_path}` : "No disponible",
        CostoPelicula: pelicula.budget || "No disponible",
        RecaudacionPelicula: pelicula.revenue || "No disponible",
        CalificacionGeneral: pelicula.vote_average || "No disponible",
        Estado: estado,
        Publico: pelicula.adult !== undefined ? pelicula.adult : "No disponible"
    };

    try {
        const response = await $.ajax({
            url: `../controllers/peliculasController.php?op=SubirPelicula`,
            type: 'POST',
            data: nuevaPelicula,
            dataType: 'json'
        });
        //devueñve la película guardada
        return nuevaPelicula; 
    } catch (error) {
        console.error('Error al guardar la película en BD:', error);
        throw error;
    }
}

//cargar películas en los divs de arriba y abajo --> más populares
async function cargarPelículasArriba() {
    try {
        const response = await $.ajax({
            url: 'https://api.themoviedb.org/3/movie/popular?language=es-CR&page=1',
            type: 'GET',
            headers: {
                accept: "application/json",
                Authorization: `Bearer ${tmdbAPI}`
            }
        });

        //seleccionar los divs donde se mostrarán las películas
        let divPeliculasArriba = $("#peliculas1");
        let divPeliculasAbajo = $("#peliculas2");

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
            divPeliculasArriba.append(datos);
        }

        //agregar las siguientes 4 películas al div inferior
        for (const movie of peliculas.slice(4, 8)) {
            const peliculaEnBD = await BuscarPeliculaEnBD(movie.id);
            const poster = peliculaEnBD ? peliculaEnBD.Poster : movie.poster_path;
            const titulo = peliculaEnBD ? peliculaEnBD.TituloTraducido : movie.title;

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

            divPeliculasAbajo.append(datos);
        }
    } catch (error) {
        console.error("Error al cargar las películas:", error);
    }
}

// Cargar películas al final --> ratings más altos
async function cargarPeliculasAbajo() {
    try {
        const response = await $.ajax({
            url: 'https://api.themoviedb.org/3/movie/top_rated?language=es-CR&page=1',
            type: 'GET',
            headers: {
                accept: "application/json",
                Authorization: `Bearer ${tmdbAPI}`
            }
        });

        // Seleccionar donde se escribirá, en este caso en el div con id RatingsAltos
        let divRatingsAltos = $("#RatingsAltos");

        // Limitar los resultados a las primeras 3 películas
        const peliculas = response.results.slice(0, 3);

        for (const movie of peliculas) {
            // Verificar existencia en la base de datos
            const peliculaEnBD = await BuscarPeliculaEnBD(movie.id);
            const generos = peliculaEnBD.Generos.map(genero => genero.name).join(", ");
            const sinopsisTruncada = truncarTexto(peliculaEnBD.Sinopsis);
            let timestamp = peliculaEnBD.Lanzamiento.$date.$numberLong;
            let fechaLanzamiento = new Date(parseInt(timestamp));
            let fechaFormateada = fechaLanzamiento.toLocaleDateString('es-CR', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Crear HTML con la información de cada película
            let datos = `
                <div class="movie_card" id="peliculaCard">
                <a href="verResennasPelicula.php?id=${movie.id}">
                    <div class="info_section">
                        <div class="movie_header">
                            <img class="locandina"
                                src="https://image.tmdb.org/t/p/w500${peliculaEnBD.Poster}" alt="${peliculaEnBD.TituloTraducido}" />
                            <h1>${peliculaEnBD.TituloTraducido}</h1>
                            <h4>${fechaFormateada}</h4>
                            <span class="episodios">${peliculaEnBD.Duracion} min</span>
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
                                <li><i class="material-icons">favorite</i></li>
                                <li><i class="material-icons">chat_bubble</i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="blur_back" style="background-image: url('https://image.tmdb.org/t/p/w500${movie.backdrop_path}');"></div>
                </a>
                    </div>
            `;

            // Agregar el contenido generado al contenedor principal
            divRatingsAltos.append(datos);
        }
    } catch (error) {
        console.error("Error al cargar las películas:", error);
    }
}


// Ejecutar prueba al cargar la página
$(function () {
    //refresca la página
    let refreshCount = localStorage.getItem('refreshCount') || 0;
    if (refreshCount < 3) {
        localStorage.setItem('refreshCount', ++refreshCount);
        location.reload();
    } else {
        //después de refrescar carga las películas y series
        localStorage.removeItem('refreshCount');
        cargarPelículasArriba();
        cargarPeliculasAbajo();
    }
});
