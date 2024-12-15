<?php
session_start();
require_once '../models/Usuarios.php';

$Nombre = isset($_POST['Nombre']) ? $_POST['Nombre'] : null;
$PrimerApellido = isset($_POST['PrimerApellido']) ? $_POST['PrimerApellido'] : null;
$SegundoApellido = isset($_POST['SegundoApellido']) ? $_POST['SegundoApellido'] : null;
$Correo = isset($_POST['Correo']) ? filter_var($_POST['Correo'], FILTER_VALIDATE_EMAIL) : null;
$Telefono = isset($_POST['Telefono']) ? intval($_POST['Telefono']) : null;
$FotodePerfil = isset($_POST['FotodePerfil']) ? filter_var($_POST['FotodePerfil'], FILTER_SANITIZE_URL) : null;
if ($FotodePerfil && !filter_var($FotodePerfil, FILTER_VALIDATE_URL)) {
    $response = ["success" => false, "message" => "La URL de la foto de perfil no es válida"];
    header('Content-Type: application/json');
    echo json_encode($response);
    return;
}

switch($_GET['op']){

    case 'perfil':{
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->obtenerUsuarioPorId($_SESSION['id']);
        echo json_encode($usuario);
        break;
    }

    case 'actualizarPerfil':{
        $usuarioModel = new UsuarioModel();

        $datosNuevos = [
            'Nombre' => $Nombre,
            'PrimerApellido' => $PrimerApellido,
            'SegundoApellido' => $SegundoApellido,
            'Correo' => $Correo,
            'Telefono' => $Telefono,
            'FotodePerfil'=> $FotodePerfil,
        ];
        
        try {
            $actualizarDatos = $usuarioModel->actualizarUsuario($_SESSION['nombreUsuario'], $datosNuevos);


                // Obtener usuario actualizado desde la base de datos
                $usuarioActualizado = $usuarioModel->obtenerUsuarioPorNombreDeUsuario($_SESSION['nombreUsuario']);
                
                if ($usuarioActualizado) {
                    // Actualizar datos en la sesión
                    $_SESSION['nombre'] = $usuarioActualizado['Nombre'];
                    $_SESSION['primerApellido'] = $usuarioActualizado['PrimerApellido'];
                    $_SESSION['segundoApellido'] = $usuarioActualizado['SegundoApellido'];
                    $_SESSION['correo'] = $usuarioActualizado['Correo'];
                    $_SESSION['telefono'] = $usuarioActualizado['Telefono'];
                    $_SESSION['fotoPerfil'] = $usuarioActualizado['FotodePerfil'];

                    session_commit();
                    $response = ["success" => true, "message" => "Datos actualizados correctamente"];
                } else {
                    $response = ["success" => false, "message" => "Error al cargar los datos actualizados"];
                }
            } 
         catch (Exception $e) {
            $response = ["success" => false, "message" => "Error al actualizar el usuario: " . $e->getMessage()];
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        break;
    }
}
?>