<?php
require_once '../models/Usuarios.php';

// Capturar valores enviados por el formulario
$correo = $_POST['correo'] ?? null;
$contrasenaVerificar = $_POST['contrasena'] ?? null;
$contrasenaHashed = password_hash($contrasenaVerificar, PASSWORD_DEFAULT);

$usuarioModel = new UsuarioModel();

try {
    $usuario = $usuarioModel->obtenerUsuarioPorCorreo($correo);
    
    if ($usuario) {
        if (password_verify($contrasenaVerificar, $usuario->Contraseña)) {
            session_start();
            $_SESSION['id'] = $usuario->_id;
            $_SESSION['idNivel'] = $usuario->id_nivel ?? null;
            $_SESSION['nombre'] = $usuario->Nombre;
            $_SESSION['primerApellido'] = $usuario->PrimerApellido;
            $_SESSION['segundoApellido'] = $usuario->SegundoApellido;
            $_SESSION['nombreUsuario'] = $usuario->NombredeUsuario;
            $_SESSION['correo'] = $usuario->Correo;
            $_SESSION['telefono'] = $usuario->Telefono;
            $_SESSION['fotoPerfil'] = $usuario->FotodePerfil;
            $_SESSION['fechaCreacion'] = $usuario->FechadeCreacion;
            $respuesta = ["exito" => true, "msg" => "Inicio de sesión exitoso"];
        } else {
            $respuesta = ["exito" => false, "msg" => "Usuario o contraseña incorrectos"];
        }
    } else {
        $respuesta = ["exito" => false, "msg" => "Usuario o contraseña incorrectos"];
    }
} catch (Exception $e) {
    $respuesta = ["exito" => false, "msg" => "Error al intentar iniciar sesión: " . $e->getMessage()];
}

echo json_encode($respuesta);
?>
