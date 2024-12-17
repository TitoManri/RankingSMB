<?php
require_once '../models/listasMyS.php';
//Switch op

$op = isset($_POST['op']) ? $_POST['op'] : '';
$idUsuario = $_POST['ID_Usuario'] ? $_POST['idUsuario'] : null;
$idPelicula = $_POST['idPeliculaSerie'] ? $_POST['idPeliculaSerie'] : null;

switch ($op){
    case 'listarFavoritosMyS':
        try {
            $favoritosModel = new ListasMySModel();
    
            // Llamamos a la función para obtener los favoritos del usuario
            $resultado = $favoritosModel->obtenerListaFavPorUsuario($idUsuario,$nombre);
            if (empty($resultado)) {
                echo json_encode(["status" => "error", "message" => "No se encontraron favoritos."]);
            } else {
                echo json_encode(["status" => "success", "data" => $resultado]);
            }
        } catch (Exception $e) {
            // Capturamos errores en caso de que algo salga mal
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }

    //----Verifica si la pelicula ya esta en la lista, si esta la elimina y si no la agrega----//
    case 'gestionarFavorito':
        try {
            if (!$idUsuario || !$idPelicula) {
                echo json_encode(["status" => "error", "message" => "Datos insuficientes."]);
                break;
            }

            // Usamos el modelo para verificar, obtener o eliminar el favorito
            $favoritosModel = new ListasMySModel();
            if ($favoritosModel->verificarFavorito($idUsuario, $idPelicula)) {
                $favoritosModel->eliminarDeListaFavoritos($idUsuario, $idPelicula);
                echo json_encode(["status" => "success", "action" => "removed"]);
            } else {
                $favoritosModel->obtenerListaFavPorUsuario($idUsuario, $idPelicula);
                echo json_encode(["status" => "success", "action" => "added"]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }

    case 'listarPorVerMyS':
    case 'listarVistosMyS':
    case 'filtroGenero':
        try {
            $FiltrarGenero = new ListasMySModel();
    
            // Llamamos a la función filtroDeGenero con los parámetros necesarios
            $filtrarGenero = $FiltrarGenero->filtroDeGenero($idUsuario, $nombreLista, $genero);
    
            // Validamos si el resultado es vacío o nulo
            if (!$filtrarGenero) {
                echo json_encode(["status" => "error", "message" => "No se encontraron resultados para el filtro de género."]);
            } else {
                // Si se encontraron resultados, los devolvemos en formato JSON
                echo json_encode(["status" => "success", "data" => $filtrarGenero]);
            }
        } catch (Exception $e) {
            // Si ocurre una excepción, la capturamos y devolvemos el mensaje de error
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }

    case 'filtroAnio':
        //Llamamos la funcion de Genero
        //Le hacemos validacion por si algo sale mal 
        //Le devolvemos un json si fuera necesario
    case 'filtroNombre':
        //Llamamos la funcion de Genero
        //Le hacemos validacion por si algo sale mal 
        //Le devolvemos un json si fuera necesario
}

?>