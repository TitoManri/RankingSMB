//búsqueda

//selecciona el input 
const paramBusqueda = document.getElementById("busquedaParam").textContent;

$.ajax({
    url: `https://api.themoviedb.org/3/search/tv?query=${paramBusqueda}&include_adult=true&language=es-CR&page=1`,
    type: 'GET',
    headers: {
        accept: "application/json",
        Authorization: `Bearer ${tmdbAPI}`
    },
    success: function (response) {
        let divPeliculas1 = $("#series1");

        //limitar los resultados a las primeras 4 películas arriba
        response.results.slice(0, 4).forEach(serie => {

            let imagen = serie.poster_path ? `https://image.tmdb.org/t/p/w500${serie.poster_path}` : 'https://static.wikia.nocookie.net/cityofdevils/images/3/30/Image-not-available.jpg/revision/latest?cb=20200325180534';

            //crear html con la información de cada película
            let datos = `
                <div class="column is-one-quarter">
                    <img src="https://image.tmdb.org/t/p/w500${imagen}" alt="${serie.name}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${serie.name}</h1>
                    </div>
                </div>
            `;

            //agrega el contenido generado al contenedor principal
            divPeliculas1.append(datos);
        });

        //seleccionar donde se escribirá, en este caso en el div con id 
        let divPeliculas2 = $("#series2");

        //limitar los resultados a las segundas 4 películas abajo
        response.results.slice(4, 8).forEach(serie => {

            let imagen = serie.poster_path ? `https://image.tmdb.org/t/p/w500${serie.poster_path}` : 'https://static.wikia.nocookie.net/cityofdevils/images/3/30/Image-not-available.jpg/revision/latest?cb=20200325180534';

            //crear html con la información de cada película
            let datos = `
                <div class="column is-one-quarter">
                    <img src="https://image.tmdb.org/t/p/w500${imagen}" alt="${serie.name}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${serie.name}</h1>
                    </div>
                </div>
            `;

            //agrega el contenido generado al contenedor principal
            divPeliculas2.append(datos);
        });

        //seleccionar donde se escribirá, en este caso en el div con id 
        let divPeliculas3 = $("#series3");

        //limitar los resultados a las segundas 4 películas abajo
        response.results.slice(8, 12).forEach(serie => {

            let imagen = serie.poster_path ? `https://image.tmdb.org/t/p/w500${serie.poster_path}` : 'https://static.wikia.nocookie.net/cityofdevils/images/3/30/Image-not-available.jpg/revision/latest?cb=20200325180534';

            //crear html con la información de cada película
            let datos = `
                <div class="column is-one-quarter">
                    <img src="https://image.tmdb.org/t/p/w500${imagen}" alt="${serie.name}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${serie.name}</h1>
                    </div>
                </div>
            `;

            //agrega el contenido generado al contenedor principal
            divPeliculas3.append(datos);
        });
    },
    error: function (error) {
        console.error(error);
    }
});
