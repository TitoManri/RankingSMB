<?php
require_once '../models/Usuarios.php';

header('Content-Type: application/json');

$nombreUsuario = $_POST['nombreUsuario'];
$contrasena = $_POST['contrasena'];

$usuarioModel = new UsuarioModel();
$usuarioModel->setNombreUsuario($nombreUsuario);
$usuarioModel->setContrasena($contrasena);

try {
    $usuario = $usuarioModel->obtenerUsuario($usuarioModel);
    if ($usuario) {
        if ( $usuario->contrasena == $contrasena ) {
            $response = array("exito" => true, "msg" => "Inicio de sesión exitoso");
        } else {
            $response = array("exito" => false, "msg" => "Usuario o contraseña incorrectos");
        }
    } else {
        $response = array("exito" => false, "msg" => "Usuario o contraseña incorrectos");
    }
} catch (Exception $e) {
    $response = array("exito" => false, "msg" => "Error al intentar iniciar sesión: " . $e->getMessage());
}

echo json_encode($response);
?>
