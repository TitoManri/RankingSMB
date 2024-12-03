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

//búsqueda
async function busquedaLibro(paramBusqueda) {
    try {
        const response = await $.ajax({
            url: `https://api.themoviedb.org/3/search/tv?query=${paramBusqueda}&include_adult=false&language=es-CR&page=1`,
            type: 'GET',
            headers: {
                accept: "application/json",
                Authorization: `Bearer ${tmdbAPI}`
            }
        });

        //seleccionar donde se escribirá, en este caso en el div con id 
        let divSeries1 = $("#series1");
        let divSeries2 = $("#series2");

        //limitar los resultados a las primeras 8 películas
        const series = response.results;

        //agregar las primeras 4 películas al div superior
        for (const serie of series.slice(0, 4)) {
            //verificar existencia en la base de datos
            const serieEnBD = await BuscarSerieEnBD(serie.id);

            //crear el HTML con la información de la película
            let datos = `
                <div class="column is-one-quarter">
                    <img src="https://image.tmdb.org/t/p/w500${serieEnBD.Poster}" alt="${serieEnBD.TituloTraducido}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${serieEnBD.TituloTraducido}</h1>
                    </div>
                </div>
            `;

            //agregar el contenido generado al contenedor principal
            divSeries1.append(datos);
        }

        //agregar las primeras 4 películas al div superior
        for (const serie of series.slice(4, 8)) {
            //verificar existencia en la base de datos
            const serieEnBD = await BuscarSerieEnBD(serie.id);

            let datos = `
                <div class="column is-one-quarter">
                    <img src="https://image.tmdb.org/t/p/w500${serieEnBD.Poster}" alt="${serieEnBD.TituloTraducido}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${serieEnBD.TituloTraducido}</h1>
                    </div>
                </div>
            `;

            divSeries2.append(datos);
        }

    } catch (error) {
        console.error("Error al cargar las series:", error);
    }
}

// Ejecutar prueba al cargar la página
$(function () {
    //selecciona el input 
    const paramBusqueda = document.getElementById("busquedaParam").textContent;
    busquedaLibro(paramBusqueda);
});