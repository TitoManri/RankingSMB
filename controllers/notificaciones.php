<?php
header('Content-Type: application/json');

//Incluimos el modelo
require_once '../models/notificaciones.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();
//Libreria para el ObjectId de mongo
use MongoDB\BSON\ObjectId;

//Opcion que va a tirar el AJAX
$op = isset($_POST['op']) ? $_POST['op'] : ''; // Find Notificaciones: cargarNotificaciones 
//Lo convierte en un ObjectId
$idUsuario = isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) ? new ObjectId($_POST['idUsuario']) : null;
$idNotificacion = isset($_POST['idNotificacion']) && !empty($_POST['idNotificacion']) ? new ObjectId($_POST['idNotificacion']) : null;

/*Switch
1. CargarNotificaciones = Listar todas las notificaciones relacionadas al usuario
2. LeerNotificaciones = 
*/
switch ($op){
    case 'cargarNotificaciones': {
        try {
        // Crear objeto de notificaciones
            $Notificaciones = new Notificaciones();
            
            // Llamar a la función para recuperar las notificaciones
            $notificacion = $Notificaciones->obtenerNotificacionesPorUsuario($idUsuario);
    
            // Devolver el resultado en formato JSON
            echo json_encode(["success" => true,"notificaciones" => $notificacion]);
        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
        break;
    }
    
    case 'leerNotificacion': {
        try {        
            $Notificaciones = new Notificaciones();
        
            $resultado = $Notificaciones->leerNotificacionesPorUsuario($idNotificacion);
        
            echo json_encode(["success" => true, "message" => "Notificación marcada como leída.", "resultado" => $resultado]);
            
        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => 'Error: ' . $e->getMessage()
            ]);
        }
        break;
    }
    
}

?>