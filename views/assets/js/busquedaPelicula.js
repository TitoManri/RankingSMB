//búsqueda

//selecciona el input por su atributo 'name'
const paramBusqueda = document.getElementById("busquedaParam").textContent;

$.ajax({
    url: `https://api.themoviedb.org/3/search/movie?query=${paramBusqueda}&include_adult=true&language=es-CR&page=1`,
    type: 'GET',
    headers: {
        accept: "application/json",
        Authorization: `Bearer ${tmdbAPI}`
    },
    success: function (response) {
        let divPeliculas1 = $("#peliculas1");

        //limitar los resultados a las primeras 4 películas arriba
        response.results.slice(0, 4).forEach(movie => {

            let imagen = movie.poster_path ? `https://image.tmdb.org/t/p/w500${movie.poster_path}` : 'https://static.wikia.nocookie.net/cityofdevils/images/3/30/Image-not-available.jpg/revision/latest?cb=20200325180534';

            //crear html con la información de cada película
            let datos = `
                <div class="column is-one-quarter">
                    <img src="https://image.tmdb.org/t/p/w500${imagen}" alt="${movie.original_title}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${movie.original_title}</h1>
                    </div>
                </div>
            `;

            //agrega el contenido generado al contenedor principal
            divPeliculas1.append(datos);
        });

        //seleccionar donde se escribirá, en este caso en el div con id 
        let divPeliculas2 = $("#peliculas2");

        //limitar los resultados a las segundas 4 películas abajo
        response.results.slice(4, 8).forEach(movie => {

            let imagen = movie.poster_path ? `https://image.tmdb.org/t/p/w500${movie.poster_path}` : 'https://static.wikia.nocookie.net/cityofdevils/images/3/30/Image-not-available.jpg/revision/latest?cb=20200325180534';

            //crear html con la información de cada película
            let datos = `
                <div class="column is-one-quarter">
                    <img src="https://image.tmdb.org/t/p/w500${imagen}" alt="${movie.original_title}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${movie.original_title}</h1>
                    </div>
                </div>
            `;

            //agrega el contenido generado al contenedor principal
            divPeliculas2.append(datos);
        });

        //seleccionar donde se escribirá, en este caso en el div con id 
        let divPeliculas3 = $("#peliculas2");

        //limitar los resultados a las segundas 4 películas abajo
        response.results.slice(8, 12).forEach(movie => {

            let imagen = movie.poster_path ? `https://image.tmdb.org/t/p/w500${movie.poster_path}` : 'https://static.wikia.nocookie.net/cityofdevils/images/3/30/Image-not-available.jpg/revision/latest?cb=20200325180534';

            //crear html con la información de cada película
            let datos = `
                <div class="column is-one-quarter">
                    <img src="https://image.tmdb.org/t/p/w500${imagen}" alt="${movie.original_title}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${movie.original_title}</h1>
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
