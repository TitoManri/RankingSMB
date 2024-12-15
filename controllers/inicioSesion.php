<?php
require_once '../models/Usuarios.php';

// Capturar valores enviados por el formulario
$correo = $_POST['correo'] ?? null;
$contrasenaVerificar = $_POST['contrasena'] ?? null;

$usuarioModel = new UsuarioModel();

try {
    // Verificar si el usuario ya existe por correo
    $usuario = $usuarioModel->obtenerUsuarioPorCorreo($correo);
    
    if ($usuario) {
        //Verificar si la contraseña es correcta con el hash
        if (password_verify($contrasenaVerificar, $usuario->Contraseña)) {
            // Obtener el usuario con el nivel
            $usuarioConNivel = $usuarioModel->obtenerUsuarioConNivel($usuario->_id);
            if ($usuarioConNivel && isset($usuarioConNivel['nivel'])) {
                $nivel = $usuarioConNivel['nivel']; // Access the 'nivel' object directly
                $nombreNivel = $nivel['Nombre']; // Ensure the correct field name is used

                // Iniciar sesión
                session_start();
                $_SESSION['id'] = (string) $usuario->_id;
                $_SESSION['nivel'] = $nombreNivel;
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
                $respuesta = ["exito" => false, "msg" => "No se pudo obtener el nivel del usuario"];
            }
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