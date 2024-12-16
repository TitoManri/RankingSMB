<?php
require_once '../models/resennasUsuarios.php';
require __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

//Utilizamos las clases
use MongoDB\BSON\ObjectId as MongoObjectId;
use MongoDB\BSON\UTCDateTime as MongoUTCDateTime;

$op = isset($_GET['op']) ? $_GET['op'] : null;
$resennas = new Resennas();

switch ($op) {
    case 'subirResenna':{
        $IdUsuario = isset($_POST['IdUsuario']) ? new MongoObjectId($_POST['IdUsuario']) : null;
        $IdContenido = isset($_POST['IdContenido']) ? new MongoObjectId($_POST['IdContenido']) : null;
        $Calificacion = isset($_POST['Calificacion']) ? intval($_POST['Calificacion']) : null;
        $TipoContenido = isset($_POST['TipoContenido']) ? intval($_POST['TipoContenido']) : null;
        $Opinion = isset($_POST['Opinion']) ? $_POST['Opinion'] : null;
        $FechaCreacion = new MongoUTCDateTime();
        $FechaModificacion = new MongoUTCDateTime();
        
        if (!$IdUsuario || !$IdContenido || !$Calificacion || !$FechaCreacion || !$FechaModificacion) {
            $response = ["exito" => false, "msg" => "Hubo un error al conseguir la información de la reseña."];
            echo json_encode($response);
            exit;
        }

        try {
            $data = [
                "IdUsuario" => $IdUsuario,
                "IdContenido" => $IdContenido,
                "Calificacion" => $Calificacion,
                "TipoContenido" => $TipoContenido,
                "FechaCreacion" => $FechaCreacion,
                "FechaModificacion" => $FechaModificacion
            ];
            if($Opinion){
                $data["Opinion"] = $Opinion;
            }
            $resultado = $resennas->insertarResennas($data);
            if ($resultado) {
                $response = ["exito" => true, "msg" => "Reseña subida con éxito."];
            } else {
                $response = ["exito" => false, "msg" => "Hubo un error al subir la reseña."];
            }
        } catch (Exception $e) {
            $response = ["exito" => false, "msg" => "Un error sucedió al subir la reseña: " . $e->getMessage()];
        }
        echo json_encode($response);
        break;
    }

    case 'conseguirResennasDeContenido':{
        $IdContenido = isset($_POST['IDContenido']) ? $_POST['IDContenido'] : null;
        if (!$IdContenido) {
            $response = ["exito" => false, "msg" => "Hubo un error al conseguir la información de la reseña."];
            echo json_encode($response);
            exit;
        }
        try {
            $resultado = $resennas->obtenerResennasDeContenido($IdContenido);
            if ($resultado) {
                $response = ["exito" => true, "msg" => "Reseñas obtenidas con éxito.", "object" => $resultado];
            }else if(empty($resultado)){
                $response = ["exito" => true, "msg" => "No hay reseñas para este contenido.", "object" => []];
            } else {
                $response = ["exito" => false, "msg" => "Hubo un error al obtener las reseñas."];
            }
        } catch (Exception $e) {
            $response = ["exito" => false, "msg" => "Un error sucedió al obtener las reseñas: " . $e->getMessage()];
        }
        echo json_encode($response);
        break;
    }

    case 'conseguirResennaPorID':{
        $IdResenna = isset($_POST['IDResenna']) ? $_POST['IDResenna'] : null;
        if (!$IdResenna) {
            $response = ["exito" => false, "msg" => "Hubo un error al conseguir la información de la reseña."];
            echo json_encode($response);
            exit;
        }
        try {
            $resultado = $resennas->obtenerResennaPorID($IdResenna);
            if ($resultado) {
                $response = ["exito" => true, "msg" => "Reseña obtenida con éxito.", "object" => $resultado];
            } else {
                $response = ["exito" => false, "msg" => "Hubo un error al obtener la reseña."];
            }
        } catch (Exception $e) {
            $response = ["exito" => false, "msg" => "Un error sucedió al obtener la reseña: " . $e->getMessage()];
        }
        echo json_encode($response);
        break;
    }
}