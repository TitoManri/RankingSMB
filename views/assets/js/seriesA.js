// Acortar la descripción si excede un límite de caracteres
function truncarTexto(texto) {
    return texto.length > 273 ? texto.substring(0, 273) + "..." : texto;
}

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
    //valida los datos antes del insert
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

    //Guarda los datos en un objeto
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
        //devuelve los datos guardados
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

//Cargar series en el div de arriba
async function cargarSeriesArriba() {
    try {
        const response = await $.ajax({
            url: 'https://api.themoviedb.org/3/tv/popular?language=es-CR&page=1',
            type: 'GET',
            headers: {
                accept: "application/json",
                Authorization: `Bearer ${tmdbAPI}`
            }
        });

        //seleccionar donde se escribirán los resultados
        let divSeriesArriba = $("#series1");
        let divSeriesAbajo = $("#series2");

        //guarda el resultado de la respuesta
        const series = response.results;

        //agregar las primeras 4 series al div superior
        for (const serie of series.slice(0, 4)) {
            //verificar existencia en la base de datos
            const serieEnBD = await BuscarSerieEnBD(serie.id);

            //crear el HTML con la información de la serie
            let datos = `
                <div class="column is-one-quarter">
                <a href="verResennasSeries.php?id=${serie.id}">
                    <img src="https://image.tmdb.org/t/p/w500${serieEnBD.Poster}" alt="${serieEnBD.TituloTraducido}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${serieEnBD.TituloTraducido}</h1>
                    </div>
                    </a>
                </div>
            `;

            //agregar el contenido generado al contenedor principal
            divSeriesArriba.append(datos);
        }

        //agregar las segundas 4 series al div superior
        for (const serie of series.slice(4, 8)) {
            //verificar existencia en la base de datos
            const serieEnBD = await BuscarSerieEnBD(serie.id);

            let datos = `
                <div class="column is-one-quarter">
                <a href="verResennasSeries.php?id=${serie.id}">
                    <img src="https://image.tmdb.org/t/p/w500${serieEnBD.Poster}" alt="${serieEnBD.TituloTraducido}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${serieEnBD.TituloTraducido}</h1>
                    </div>
                    </a>
                </div>
            `;

            divSeriesAbajo.append(datos);
        }
    } catch (error) {
        console.error("Error al cargar las series:", error);
    }
}

// Cargar series al final --> ratings más altos
async function cargarSeriesAbajo() {
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
        let divRatingsAltos = $("#RatingsAltos");

        // Limitar los resultados a las primeras 3 series
        const series = response.results.slice(0, 3);

        for (const serie of series) {
            // Verificar existencia en la base de datos
            const serieEnBD = await BuscarSerieEnBD(serie.id);
            //muestra los géneros en texto
            const generos = serieEnBD.Generos.map(genero => genero.name).join(", ");
            //trunca la sinopsis si excede un límite de caracteres
            const sinopsisTruncada = truncarTexto(serieEnBD.Sinopsis);
            //devuelve la fecha de lanzamiento en formato legible
            let timestamp = serieEnBD.Lanzamiento.$date.$numberLong;
            let fechaLanzamiento = new Date(parseInt(timestamp));
            let fechaFormateada = fechaLanzamiento.toLocaleDateString('es-CR', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Crear HTML con la información de cada serie
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
    cargarSeriesArriba();
    cargarSeriesAbajo();
});