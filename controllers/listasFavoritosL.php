<?php
require_once '../models/ListasFavoritosL.php';
require_once '../models/Libros.php';
require_once '../vendor/autoload.php';

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

$op = isset($_POST['op']) ? $_POST['op'] : '';
$idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : null;
$idLibro = isset($_POST['idLibro']) ? $_POST['idLibro'] : null;

$fechadeCreacion = new UTCDateTime();
$fechaModificacion = new UTCDateTime();
$favoritosModel = new ListasFavoritosL();
$libro = new Libros();

switch ($op){
    case 'AgregarAFavoritosLibro':
        try {
            // Busca el libro por el id del API
            $buscarLibro = $libro->getLibroID($idLibro);
        
            // Verifica si se encontró el libro, si no, lanza una excepción
            if (!$buscarLibro) {
                throw new Exception("Libro no encontrado con el ID proporcionado." . $idLibro);
            }
            $idUsuarioObjectId = new ObjectId($idUsuario);
            
            $existeEnBaseDeDatos = $favoritosModel->existeUsuarioEnLista($idUsuarioObjectId);
            // Verifica si el usuario ya tiene una lista de favoritos
            //Si no existe la lista de favoritos, se crea una nueva
            if (!$existeEnBaseDeDatos) {
                 // Agarra el id de la base de datos
                $idObjetoLibro = $buscarLibro->_id;
            
                // Lo convierte en ObjectId
                
                $idLibroObjectId = new ObjectId($idObjetoLibro);
            
                // Crear la estructura de la lista de favoritos
                $listaFav = [
                    'IdUsuario' => $idUsuarioObjectId,
                    'IdContenidosAgregados' => [$idLibroObjectId],
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
                $idObjetoLibro = $buscarLibro->_id;
            
                // Lo convierte en ObjectId
                $idUsuarioObjectId = new ObjectId($idUsuario);
                $idLibroObjectId = new ObjectId($idObjetoLibro);

                $resultado = $favoritosModel->updatearListaFav($idUsuarioObjectId, $idLibroObjectId);
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
            exit;
        }       
        
        case 'EliminarDeFavoritosLibro': 
            try {
                
                $resultado = $favoritosModel->eliminarLibroDeListaFav($idUsuario, $idLibroObjectId);
                if ($resultado->getModifiedCount() > 0) {
                    $response = ["exito" => true, "msg" => "Libro eliminado de la lista de favoritos"];
                    exit;
                } else {
                    $response = ["exito" => false, "msg" => "No se encontró el libro en la lista de favoritos"];
                    exit;
                }
            } catch (Exception $e) {
                $response = ["exito" => false, "msg" => $e->getMessage()];
                exit;
            }
        
        case 'ListarLibrosFavoritos':
            try {
                $idUsuarioObjectId = new ObjectId($idUsuario);
                $libros = $favoritosModel->obtenerLibrosPorUsuario($idUsuarioObjectId);
                $detallesLibros = $libro->obtenerDetallesLibros($libros);
                if (empty($detallesLibros)) {
                    throw new Exception("No se encontraron detalles de los libros.");
                }
                header('Content-Type: application/json');
                echo json_encode(["exito" => true, "data" => $detallesLibros]);
                exit;
            } catch (Exception $e) {
                header('Content-Type: application/json');
                echo json_encode(["exito" => false, "msg" => $e->getMessage()]);
                exit;
            }
}
?>
