function verInfoMedio() {
    $.ajax({
        url: 'https://www.omdbapi.com/?i=tt2861424&plot=full&apikey=59f26e30',
        type: 'GET',
        success: function (responseInfo) {
            console.log(responseInfo)
            let escribir = $("#infoPeli");
            datos = `
            
                <h4 class="text-center">${responseInfo.Title}</h4>
                <div class="d-flex justify-content-center">
                    <img src="${responseInfo.Poster}" alt="Poster" width="275px">
                </div>
                <br>
                <p class="text-center">${responseInfo.Plot}</p>
            
            `
            escribir.append(datos);
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}

$(function () {
    verInfoMedio();
});