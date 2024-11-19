<?php
require_once '../models/Usuarios.php';


$correo = $_POST['correo'] ?? null;
$contrasena = $_POST['contrasena'] ?? null;

$usuarioModel = new UsuarioModel();
$usuarioModel->setCorreo($correo);

try {
    $usuario = $usuarioModel->obtenerUsuario($usuarioModel);
    if ($usuario) {
        if (password_verify($contrasena, $usuario->contrasena)) {
            $respuesta = array("exito" => true, "msg" => "Inicio de sesión exitoso");
        } else {
            $respuesta = array("exito" => false, "msg" => "Usuario o contraseña incorrectos");
        }
    } else {
        $respuesta = array("exito" => false, "msg" => "Usuario o contraseña incorrectos");
    }
} catch (Exception $e) {
    $respuesta = array("exito" => false, "msg" => "Error al intentar iniciar sesión: " . $e->getMessage());
}

echo json_encode($respuesta);
?>
