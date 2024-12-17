<?php
//Modelos
require_once '../models/Usuarios.php';

//Variables que llegan del Ajax
$correo = $_POST['correo'] ?? null;
$contrasenaVerificar = $_POST['contrasena'] ?? null;

//Clases que se utilizan
$usuarioModel = new UsuarioModel();

try {
    //Obtiene el usuario por correo
    $usuario = $usuarioModel->obtenerUsuarioPorCorreo($correo);
    
    //Si si encontro al usuario, verifica la contraseña que ingreso con la que esta en la base de datos
    if ($usuario) {
        if (password_verify($contrasenaVerificar, $usuario->Contraseña)) {
            //Obtiene el usuario con el nivel
            $usuarioConNivel = $usuarioModel->obtenerUsuarioConNivel($usuario->_id);
            //Si el usuario tiene nivel pasa y envia a la vista todos los datos e inicia la sesion
            if ($usuarioConNivel && isset($usuarioConNivel['nivel'])) {
                $nivel = $usuarioConNivel['nivel']; 
                $nombreNivel = $nivel['Nombre']; 
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