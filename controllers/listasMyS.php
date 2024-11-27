<?php
require_once '../models/listasMyS.php';
//Switch op

$op = isset($_POST['op']) ? $_POST['op'] : '';
//$cedula = isset($_POST["cedula"]) ? $_POST["cedula"] : "";

switch ($op){
    case 'listarFavoritosMyS':
    case 'listarPorVerMyS':
    case 'listarVistosMyS':
    case 'filtroGenero':
        //Llamamos la funcion de Genero
        //Le hacemos validacion por si algo sale mal 
        //Le devolvemos un json si fuera necesario (Kirby)
    case 'filtroAnio':
        //Llamamos la funcion de Genero
        //Le hacemos validacion por si algo sale mal 
        //Le devolvemos un json si fuera necesario (Kirby)
    case 'filtroNombre':
        //Llamamos la funcion de Genero
        //Le hacemos validacion por si algo sale mal 
        //Le devolvemos un json si fuera necesario (Kirby)
}

?>