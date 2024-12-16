<?php
require_once '../models/Comentarios.php';
require __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

$op = isset($_GET['op']) ? $_GET['op'] : null;
$comentario = new Comentarios();

//Utilizamos las clases
use MongoDB\BSON\ObjectId as MongoObjectId;
use MongoDB\BSON\UTCDateTime as MongoUTCDateTime;

switch ($op) {
    case 'ListarComentarios': {
            $IdResenna = isset($_POST['IdReseña']) ? $_POST['IdReseña'] : null;
            if (!$IdResenna) {
                $response = ["exito" => false, "msg" => "Hubo un error al conseguir la información de la reseña."];
                echo json_encode($response);
                exit;
            }
            try {
                $buscarComentarios = $comentario-> conseguirComentarios($IdResenna);
                if ($buscarComentarios) {
                    $response = ["exito" => true, "msg" => "Los comentarios existen en la base de datos.", "object" => $buscarComentarios];
                } else {
                    $response = ["exito" => false, "msg" => "Los comentarios no existen en la base de datos."];
                }
            } catch (Exception $e) {
                $response = ["exito" => false, "msg" => "Un error sucedió al buscar los comentarios: " . $e->getMessage()];
            }
            echo json_encode($response);
            break;
        }

    case 'SubirComentario': {
            $IdReseña = isset($_POST['IdReseña']) ? new MongoObjectId($_POST['IdReseña']) : null;
            $IdUsuario = isset($_POST['IdUsuario']) ? new MongoObjectId($_POST['IdUsuario']) : null;
            $TextoComentario = isset($_POST['TextoComentario']) ? $_POST['TextoComentario'] : null;
            $Fecha = new MongoUTCDateTime();

            if (!$IdReseña || !$IdUsuario || !$TextoComentario || !$Fecha) {
                $response = ["exito" => false, "msg" => "Hubo un error al conseguir la información del comentario."];
                echo json_encode($response);
                exit;
            }

            try {
                $comentarioInsertar = [
                    'IdUsuario' => $IdUsuario,
                    'IdReseña' => $IdReseña,
                    'TextoComentario' => $TextoComentario,
                    'Fecha' => $Fecha
                ];
                $insertarComentario = $comentario->insertarComentaio($comentarioInsertar);
                if ($insertarComentario) {
                    $response = ["exito" => true, "msg" => "El comentario se ha subido correctamente."];
                } else {
                    $response = ["exito" => false, "msg" => "El comentario no se ha subido correctamente."];
                }
            } catch (Exception $e) {
                $response = ["exito" => false, "msg" => "Un error sucedió al subir el comentario: " . $e->getMessage()];
            }
            echo json_encode($response);
            break;
        }
}
