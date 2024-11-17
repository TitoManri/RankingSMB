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
        response.results.slice(0, 5).forEach(movie => {
            //crear html con la información de cada película
            let datos = `
                <div class="column is-one-quarter">
                    <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" alt="${movie.original_title}">
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

//Cargar libros en el el div de abajo
$.ajax({
    url: `https://www.googleapis.com/books/v1/volumes?q=*&orderBy=relevance&projection=lite&key=${googleAPI}&langRestrict=es-CR`,
    type: 'GET',
    success: function (response) {
        //seleccionar donde se escribirá, en este caso en el div con id libros
        let divLibros = $("#libros");
        
        //limitar los resultados a los primeros 5 libros
        response.results.slice(0, 5).forEach(book => {
            //crear html con la información de cada libro
            let datos = `
                <div class="column is-one-quarter">
                    <img src="https://image.tmdb.org/t/p/w500${book.volumeInfo.imageLinks.smallThumbnail}" alt="${book.volumeInfo.title}">
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