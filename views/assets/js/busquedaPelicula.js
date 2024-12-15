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
    const generos = pelicula.genres || [{ name: "No disponible" }];
    const estado =
        pelicula.status === "Released" ? "Lanzada" :
            pelicula.status === "In Production" ? "En producción" :
                "Estado desconocido";

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
        return nuevaPelicula; 
    } catch (error) {
        console.error('Error al guardar la película en BD:', error);
        throw error;
    }
}

//búsqueda
async function busqueda(paramBusqueda) {
    try {
        const response = await $.ajax({
            url: `https://api.themoviedb.org/3/search/movie?query=${paramBusqueda}&include_adult=false&language=es-CR&page=1`,
            type: 'GET',
            headers: {
                accept: "application/json",
                Authorization: `Bearer ${tmdbAPI}`
            }
        });

        //seleccionar donde se escribirá, en este caso en el div con id 
        let divPeliculas1 = $("#peliculas1");
        let divPeliculas2 = $("#peliculas2");

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
            divPeliculas1.append(datos);
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

            divPeliculas2.append(datos);
        }

    } catch (error) {
        console.error("Error al cargar las películas:", error);
    }
}

// Ejecutar prueba al cargar la página
$(function () {
    //selecciona el input por su atributo 'name'
    const paramBusqueda = document.getElementById("busquedaParam").textContent;
    busqueda(paramBusqueda);
});