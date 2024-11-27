<?php

require_once '../config/Conexion.php';
use Dotenv\Dotenv;

class notificaciones extends Conexion
{
    private $coleccion;
    private $idUsuario;
    private $TipoNotificacion;
    private $Leido;
    private $FechaDeCreacion;
    
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
        $this->coleccion = $this->conectarBaseMongo($datosmongo)->ListasSM;
    }

    public function obtenerNotificacionesPorUsuario($idUsuario){
        
        if (!$idUsuario) {
            return ['error' => 'El usuario no se encontro.']; 
        }
        
        $query = "SELECT * FROM notificaciones WHERE id_usuario = :idUsuario ORDER BY fecha_creacion DESC";
        $notificacion = $this->conectarBaseMongo($query);
        $notificacion->

    }

}

?>