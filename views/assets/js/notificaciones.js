const dragAndDropItems = document.getElementById(
    'contenedor-externo'
);

new Sortable(dragAndDropItems, {
   animation: 350,
   chosenClass: "contenedor-interno-chosen",
   dragClass: "contenedor-interno-drag",
});

