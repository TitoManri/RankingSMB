<?php

require_once '../config/Conexion.php'; 
use Dotenv\Dotenv;

class UsuarioModel extends Conexion
{
    private $coleccion;
    private $id;
    private $id_nivel;
    private $nombre;
    private $primer_apellido;
    private $segundo_apellido;
    private $nombre_usuario;
    private $email;
    private $telefono;
    private $foto_perfil;
    private $fecha_creacion;
    private $fecha_modificacion;

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
    public function getId()
    {
        return $this->id;
    }

    public function getIdNivel()
    {
        return $this->id_nivel;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPrimerApellido()
    {
        return $this->primer_apellido;
    }

    public function getSegundoApellido()
    {
        return $this->segundo_apellido;
    }

    public function getNombreUsuario()
    {
        return $this->nombre_usuario;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getFotoPerfil()
    {
        return $this->foto_perfil;
    }

    public function getFechaCreacion()
    {
        return $this->fecha_creacion;
    }

    public function getFechaModificacion()
    {
        return $this->fecha_modificacion;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdNivel($id_nivel)
    {
        $this->id_nivel = $id_nivel;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setPrimerApellido($primer_apellido)
    {
        $this->primer_apellido = $primer_apellido;
    }

    public function setSegundoApellido($segundo_apellido)
    {
        $this->segundo_apellido = $segundo_apellido;
    }

    public function setNombreUsuario($nombre_usuario)
    {
        $this->nombre_usuario = $nombre_usuario;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setFotoPerfil($foto_perfil)
    {
        $this->foto_perfil = $foto_perfil;
    }

    public function setFechaCreacion($fecha_creacion)
    {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function setFechaModificacion($fecha_modificacion)
    {
        $this->fecha_modificacion = $fecha_modificacion;
    }

    //Crear Usuario
    public function crearUsuario($usuario)
    {
        $resultado = $this->coleccion->insertOne($usuario);
        return $resultado->getInsertedId();
    }
    public function obtenerUsuarioPorId($id)
    {
        $resultado = $this->coleccion->findOne(['_id' => $id]);
        return $resultado;
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
    //Obtener el Usuario por medio del correo y la contraseña
    public function obtenerUsuarioPorCorreo($correo)
    {
        $resultado = $this->coleccion->findOne(['Correo' => $correo]);
        return $resultado;
    }

    //Actualizar los datos del Usuario
    public function actualizarUsuario($usuario, $nuevosDatos)
    {
        $resultado = $this->coleccion->updateOne($usuario, ['$set' => $nuevosDatos]);
        return $resultado->getModifiedCount();
    }
}
