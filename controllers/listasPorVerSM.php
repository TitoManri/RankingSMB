<?php
require_once '../models/ListaPorVerSM.php';
require_once '../models/Peliculas.php';
require_once '../vendor/autoload.php';

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

$op = isset($_POST['op']) ? $_POST['op'] : '';
$idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : null;
$idPelicula = isset($_POST['idPeliculaSerie']) ? intval($_POST['idPeliculaSerie']) : null;

$fechadeCreacion = new UTCDateTime();
$fechaModificacion = new UTCDateTime();
$porVerModel = new ListasPorVerSM();
$pelicula = new Peliculas();

switch ($op){
    case 'AgregarAPorVerPelicula':
        try {
            // Busca la película por el id del API
            $buscarPelicula = $pelicula->getPeliculaID($idPelicula);
        
            // Verifica si se encontró la película, si no, lanza una excepción
            if (!$buscarPelicula) {
                throw new Exception("Película no encontrada con el ID proporcionado." . $idPelicula);
            }
            
            $existeEnBaseDeDatos = $porVerModel->existeUsuarioEnLista();
            // Verifica si el usuario ya tiene una lista de por ver
            // Si no existe la lista de por ver, se crea una nueva
            if (!$existeEnBaseDeDatos) {
                // Agarra el id de la base de datos
                $idObjetoPelicula = $buscarPelicula->_id;
            
                // Lo convierte en ObjectId
                $idUsuarioObjectId = new ObjectId($idUsuario);
                $idPeliculaObjectId = new ObjectId($idObjetoPelicula);
            
                // Crear la estructura de la lista de por ver
                $listaPorVer = [
                    'IdUsuario' => $idUsuarioObjectId,
                    'IdContenidosAgregados' => [$idPeliculaObjectId],
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
                $idObjetoPelicula = $buscarPelicula->_id;
            
                // Lo convierte en ObjectId
                $idUsuarioObjectId = new ObjectId($idUsuario);
                $idPeliculaObjectId = new ObjectId($idObjetoPelicula);

                $resultado = $porVerModel->updatearListaFav($idUsuarioObjectId, $idPeliculaObjectId);
                // Respuesta exitosa
                header('Content-Type: application/json');
                echo json_encode(["status" => "success", "message" => "Lista de por ver actualizada correctamente"]);
                exit;   
            }
               
        } catch (Exception $e) {
            // Manejo de excepciones
            header('Content-Type: application/json');
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            exit;
        }       
        
        case 'EliminarDePorVerPelicula': 
            try {
                
                $resultado = $porVerModel->eliminarPeliculaDeListaFav($idUsuario, $idPeliculaObjectId);
                if ($resultado->getModifiedCount() > 0) {
                    $response = ["exito" => true, "msg" => "Película eliminada de la lista de por ver"];
                    exit;
                } else {
                    $response = ["exito" => false, "msg" => "No se encontró la película en la lista de por ver"];
                    exit;
                }
            } catch (Exception $e) {
                $response = ["exito" => false, "msg" => $e->getMessage()];
                exit;
            }
        
        case 'ListarPeliculasPorVer':
            try {
                $idUsuarioObjectId = new ObjectId($idUsuario);
                $peliculas = $porVerModel->obtenerPeliculasPorUsuario($idUsuarioObjectId);
                $detallesPeliculas = $pelicula->obtenerDetallesPeliculas($peliculas);
                if (empty($detallesPeliculas)) {
                    throw new Exception("No se encontraron detalles de las películas.");
                }
                header('Content-Type: application/json');
                echo json_encode(["exito" => true, "data" => $detallesPeliculas]);
                exit;
            } catch (Exception $e) {
                header('Content-Type: application/json');
                echo json_encode(["exito" => false, "msg" => $e->getMessage()]);
                exit;
            }
}
?>
