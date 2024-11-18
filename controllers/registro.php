<?php
//LLamamos a la clases
require_once '../models/Usuarios.php';
require __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

//Utilizamos las clases
use MongoDB\BSON\ObjectId as MongoObjectId;
use MongoDB\BSON\UTCDateTime as MongoUTCDateTime;

header('Content-Type: application/json');

//Obtenemos los datos del formulario con la llamada de ajax
$Nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$PrimerApellido = isset($_POST['primerApellido']) ? $_POST['primerApellido'] : null;
$SegundoApellido = isset($_POST['segundoApellido']) ? $_POST['segundoApellido'] : null;
$NombredeUsuario = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : null;
$Correo = isset($_POST['correo']) ? filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL) : null;
$Telefono = isset($_POST['telefono']) ? intval($_POST['telefono']) : null;
$Contraseña = isset($_POST['contrasena']) ? password_hash($_POST['contrasena'], PASSWORD_BCRYPT) : null;
$fechadeCreacion = new MongoUTCDateTime();
$fechaModificacion = new MongoUTCDateTime();

//Hacemos una validacion para que ningun campo este vacio (Los necesarios == Not Null)
if (!$Nombre || !$PrimerApellido || !$SegundoApellido || !$NombredeUsuario || !$Correo || !$Telefono || !$Contraseña) {
    $response = ["exito" => false, "msg" => "Todos los campos son obligatorios y el correo debe ser válido"];
    echo json_encode($response);
    exit;
}

//Agregamos el nivel noob 1 al usuario
$id_nivel = new MongoObjectId('67358c5f4d4777c9edc955e3');

//Llamamos al modelo
$usuarioModel = new UsuarioModel();

try {
    // Verificar si el usuario ya existe por correo
    $usuarioExistente = $usuarioModel->obtenerUsuariosPorEmail($Correo);
    if ($usuarioExistente) {
        $response = ["exito" => false, "msg" => "El correo electrónico ya está registrado"];
    } else {
        //Arreglo con los datos del Usuario
        $usuario = [
            'id_nivel' => $id_nivel,
            'Nombre' => $Nombre,
            'PrimerApellido' => $PrimerApellido,
            'SegundoApellido' => $SegundoApellido,
            'NombredeUsuario' => $NombredeUsuario,
            'Correo' => $Correo,
            'Telefono' => $Telefono,
            'Contraseña' => $Contraseña,
            'FotodePerfil' => 'default.jpg', 
            'FechadeCreacion' => $fechadeCreacion,
            'fecha_modificacion' => $fechaModificacion
        ];

        // Crear el usuario en la base de datos
        $usuarioId = $usuarioModel->crearUsuario($usuario);
        if ($usuarioId) {
            $response = ["exito" => true, "msg" => "Registro exitoso"];
        } else {
            $response = ["exito" => false, "msg" => "Error al registrar el usuario"];
        }
    }
} catch (Exception $e) {
    $response = ["exito" => false, "msg" => "Error al intentar registrar: " . $e->getMessage()];
}

echo json_encode($response);
