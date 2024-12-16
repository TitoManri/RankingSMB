<?php
require_once '../models/ListasFavoritosSM.php';
require_once '../models/Peliculas.php';
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

$op = isset($_POST['op']) ? $_POST['op'] : '';
$idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : null;
$idPelicula = isset($_POST['idPeliculaSerie']) ? intval($_POST['idPeliculaSerie']) : null;

$fechadeCreacion = new UTCDateTime();
$fechaModificacion = new UTCDateTime();
$favoritosModel = new ListasFavoritosSM();
$pelicula = new Peliculas();

switch ($op){
    case 'AgregarAFavoritosPelicula':
        try {
            // Busca la película por el id del API
            $buscarPelicula = $pelicula->getPeliculaID($idPelicula);
        
            // Verifica si se encontró la película, si no, lanza una excepción
            if (!$buscarPelicula) {
                throw new Exception("Película no encontrada con el ID proporcionado." . $idPelicula);
            }
            
            $existeEnBaseDeDatos = $favoritosModel->existeUsuarioEnLista();
            // Verifica si el usuario ya tiene una lista de favoritos
            //Si no existe la lista de favoritos, se crea una nueva
            if (!$existeEnBaseDeDatos) {
                 // Agarra el id de la base de datos
                $idObjetoPelicula = $buscarPelicula->_id;
            
                // Lo convierte en ObjectId
                $idUsuarioObjectId = new ObjectId($idUsuario);
                $idPeliculaObjectId = new ObjectId($idObjetoPelicula);
            
                // Crear la estructura de la lista de favoritos
                $listaFav = [
                    'IdUsuario' => $idUsuarioObjectId,
                    'IdContenidosAgregados' => [$idPeliculaObjectId],
                    'FechaCreacion' => $fechadeCreacion,
                    'FechaModificacion' => $fechaModificacion,
                ];
            
            
                // Llamar al método insertarListaFav
                $resultado = $favoritosModel->insertarListaFav($listaFav);
            
                // Verifica si el resultado está vacío
                if (empty($resultado)) {
                    throw new Exception("Error al insertar la lista de favoritos.");
                }
                // Respuesta exitosa
                header('Content-Type: application/json');
                echo json_encode(["status" => "success", "message" => "Lista de favoritos agregada correctamente"]);
                exit; 
            }
            // 
            else {
                // Agarra el id de la base de datos
                $idObjetoPelicula = $buscarPelicula->_id;
            
                // Lo convierte en ObjectId
                $idUsuarioObjectId = new ObjectId($idUsuario);
                $idPeliculaObjectId = new ObjectId($idObjetoPelicula);

                $resultado = $favoritosModel->updatearListaFav($idUsuarioObjectId, $idPeliculaObjectId);
                // Respuesta exitosa
                header('Content-Type: application/json');
                echo json_encode(["status" => "success", "message" => "Lista de favoritos actualizada correctamente"]);
                exit;   
            }
               
        } catch (Exception $e) {
            // Manejo de excepciones
            error_log("Error: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }        
}
?>