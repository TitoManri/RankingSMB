<?php
require_once '../models/notificaciones.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

$op = isset($_POST['op']) ? $_POST['op'] : '';
//$cedula = isset($_POST["cedula"]) ? $_POST["cedula"] : "";

switch ($op){
    case 'cargarNotificaciones':
        $idUsuario = isset($_POST['idUsuario']) ? intval($_POST['idUsuario']) : 0;

        if ($idUsuario > 0) {
            $Notificaciones = new notificaciones();
            $notificacion = $Notificaciones->obtenerNotificacionesPorUsuario($idUsuario);

            echo json_encode($notificaciones);
        } else {
            echo json_encode(['error' => 'ID de usuario no válido.']);
        }
}

?>