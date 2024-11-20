<?php

require_once '../config/Conexion.php'; 
use Dotenv\Dotenv;

class UsuarioModel extends Conexion
{
    private $coleccion;
    private $correo;
    private $contrasena;

    public function __construct()
    {
        $datosmongo = [
            'host' => getenv('MONGO_HOST'),
            'port' => getenv('MONGO_PORT'),
            'basededatos' => getenv('MONGO_DB'),
            'usuario' => getenv('MONGO_USERNAME'),
            'contrasena' => getenv('MONGO_PASSWORD')
        ];
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        $this->coleccion = $this->conectarBaseMongo($datosmongo)->usuarios;
    }

    // Getters
    public function getCorreo()
    {
        return $this->correo;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }

    // Setters
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    //Crear Usuario
    public function crearUsuario($usuario)
    {
        $resultado = $this->coleccion->insertOne($usuario);
        return $resultado->getInsertedId();
    }
    //Obtener Usuario por Correo
    public function obtenerUsuariosPorEmail($correo)
    {
        $resultado = $this->coleccion->findOne(['Correo' => $correo]);
        return $resultado;
    }
    public function obtenerUsuariosPorNombreDeUsuario($NombreDeUsuario)
    {
        $resultado = $this->coleccion->findOne(['NombredeUsuario' => $NombreDeUsuario]);
        return $resultado;
    }
    //Obtener el Usuario por medio del id
    public function obtenerUsuario($usuario)
    {
        $resultado = $this->coleccion->findOne($usuario);
        return $resultado;
    }
    //Actualizar los datos del Usuario
    public function actualizarUsuario($usuario, $nuevosDatos)
    {
        $resultado = $this->coleccion->updateOne($usuario, ['$set' => $nuevosDatos]);
        return $resultado->getModifiedCount();
    }
}
?>