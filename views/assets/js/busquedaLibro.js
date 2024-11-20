//búsqueda

//selecciona el input por su atributo 'name'
const paramBusqueda = document.getElementById("busquedaParam").textContent;

$.ajax({
    url: `https://www.googleapis.com/books/v1/volumes?q=intitle:${encodeURIComponent(paramBusqueda)}&key=${googleAPI}`,
    type: 'GET',
    success: function (response) {
        let divlibros1 = $("#libros1");

        //limitar los resultados a las primeras 4 películas arriba
        response.items.slice(0, 4).forEach(book => {

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
            divlibros1.append(datos);
        });

        //seleccionar donde se escribirá, en este caso en el div con id 
        let divlibros2 = $("#libros2");

        //limitar los resultados a las segundas 4 películas abajo
        response.items.slice(4, 8).forEach(book => {

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
            divlibros2.append(datos);
        });

        //seleccionar donde se escribirá, en este caso en el div con id 
        let divLibros3 = $("#libros3");

        //limitar los resultados a las segundas 4 películas abajo
        response.items.slice(8, 12).forEach(book => {

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
            divLibros3.append(datos);
        });
    },
    error: function (error) {
        console.error(error);
    }
});
