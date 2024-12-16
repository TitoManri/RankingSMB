$(document).ready(function() {
    //inicializa Select2 en cada filtro
    $("#genero").select2({
        tags: true,
        placeholder: "Género",
        allowClear: true,
        width: 'resolve' 
    });
    $("#calificacion").select2({
        tags: true,
        placeholder: "Calificación",
        allowClear: true,
        width: 'resolve'
    });
    $("#año").select2({
        tags: true,
        placeholder: "Año",
        allowClear: true,
        width: 'resolve'
    });
    
    //eventos para capturar las opciones seleccionadas 
    $('#genero').on('change', function() {
        const valoresGenero = $(this).val();
        console.log("Géneros seleccionados:", valoresGenero);
    });

    $('#calificacion').on('change', function() {
        const valoresCalificacion = $(this).val();
        console.log("Calificaciones seleccionadas:", valoresCalificacion);
    });

    $('#año').on('change', function() {
        const valoresAño = $(this).val();
        console.log("Años seleccionados:", valoresAño);
    });
});