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

//búsqueda
async function busquedaLibro(paramBusqueda) {
    try {
        const response = await $.ajax({
            url: `https://www.googleapis.com/books/v1/volumes?q=*&orderBy=relevance&projection=lite&key=${googleAPI}&langRestrict=es-CR`,
            type: 'GET'
        });

        //seleccionar donde se escribirá, en este caso en el div con id 
        let divlibros1 = $("#libros1");
        let divlibros2 = $("#libros2");

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
                    <img src="${imagen}" alt="${titulo}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${titulo}</h1>
                    </div>
                </div>
            `;

            //agrega el contenido generado al contenedor principal
            divlibros1.append(datos);
        }

        //agregar las últimas 4 películas al div inferior
        for (const book of libros.slice(4, 8)) {
            //verificar existencia en la base de datos
            const libroEnBD = await BuscarLibroEnBD(book.id);
            const imagen = libroEnBD ? libroEnBD.Poster : `https://books.google.com/books/publisher/content/images/frontcover/${book.id}?fife=w400-h600&source=gbs_api`;
            const titulo = libroEnBD ? libroEnBD.Titulo : book.volumeInfo.title;

            //crear el HTML con la información del libro
            let datos = `
                <div class="column is-one-quarter">
                    <img src="${imagen}" alt="${titulo}" class="img-ajustada">
                    <br>
                    <div class="column is-full">
                        <h1 class="has-text-white">${titulo}</h1>
                    </div>
                </div>
            `;

            //agrega el contenido generado al contenedor principal
            divlibros2.append(datos);
        }

    } catch (error) {
        console.error(error);
    }
}

// Ejecutar prueba al cargar la página
$(function () {
    //selecciona el input por su atributo 'name'
    const paramBusqueda = document.getElementById("busquedaParam").textContent;
    busquedaLibro(paramBusqueda);
});
