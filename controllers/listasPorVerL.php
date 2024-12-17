<?php
require_once '../models/ListasPorVerL.php';
require_once '../models/Libros.php';
require_once '../vendor/autoload.php';

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

$op = isset($_POST['op']) ? $_POST['op'] : '';
$idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : null;
$idLibro = isset($_POST['idLibro']) ? $_POST['idLibro'] : null;

$fechadeCreacion = new UTCDateTime();
$fechaModificacion = new UTCDateTime();
$porVerModel = new ListasPorVerL();
$libro = new Libros();

switch ($op){
    case 'AgregarAPorVerLibro':
        try {
            // Busca el libro por el id del API
            $buscarLibro = $libro->getLibroID($idLibro);
        
            // Verifica si se encontró el libro, si no, lanza una excepción
            if (!$buscarLibro) {
                throw new Exception("Libro no encontrado con el ID proporcionado." . $idLibro);
            }
            $idUsuarioObjectId = new ObjectId($idUsuario);
            
            $existeEnBaseDeDatos = $porVerModel->existeUsuarioEnLista($idUsuarioObjectId);
            // Verifica si el usuario ya tiene una lista de por ver
            // Si no existe la lista de por ver, se crea una nueva
            if (!$existeEnBaseDeDatos) {
                // Agarra el id de la base de datos
                $idObjetoLibro = $buscarLibro->_id;
            
                // Lo convierte en ObjectId
                $idLibroObjectId = new ObjectId($idObjetoLibro);
            
                // Crear la estructura de la lista de por ver
                $listaPorVer = [
                    'IdUsuario' => $idUsuarioObjectId,
                    'IdContenidosAgregados' => [$idLibroObjectId],
                    'FechaCreacion' => $fechadeCreacion,
                    'FechaModificacion' => $fechaModificacion,
                ];
            
                // Llamar al método insertarListaFav
                $resultado = $porVerModel->insertarListaFav($listaPorVer);
            
                // Verifica si el resultado está vacío
                if (empty($resultado)) {
                    throw new Exception("Error al insertar la lista de por ver.");
                }
                // Respuesta exitosa
                header('Content-Type: application/json');
                echo json_encode(["status" => "success", "message" => "Lista de por ver agregada correctamente"]);
                exit; 
            }
            // 
            else {
                // Agarra el id de la base de datos
                $idObjetoLibro = $buscarLibro->_id;
            
                // Lo convierte en ObjectId
                $idLibroObjectId = new ObjectId($idObjetoLibro);

                if ($porVerModel->existeLibroEnArray($idUsuarioObjectId, $idLibroObjectId)) {
                    throw new Exception("El libro ya se encuentra en la lista de favoritos.");
                }

                $resultado = $porVerModel->updatearListaFav($idUsuarioObjectId, $idLibroObjectId);
                // Respuesta exitosa
                header('Content-Type: application/json');
                echo json_encode(["status" => "success", "message" => "Lista de por ver actualizada correctamente"]);
                exit;   
            }
               
        } catch (Exception $e) {
            // Manejo de excepciones
            error_log("Error: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            exit;
        }       
        
        case 'ListarLibrosPorVer':
            try {
                $idUsuarioObjectId = new ObjectId($idUsuario);
                $libros = $porVerModel->obtenerLibrosPorUsuario($idUsuarioObjectId);
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
