<?php

require_once '../config/Conexion.php'; 
use Dotenv\Dotenv;

class Peliculas extends Conexion{

    private $coleccion;
    private $id;
    private $NombrePelicula;
    private $PosterPath;
    private $calificacion;

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
        $this->coleccion = $this->conectarBaseMongo($datosmongo)->Peliculas;
    }

    public function getPeliculaID($id){
        // Log the ID being queried
        error_log("Buscando película con ID: " . $id);
        $resultado = $this->coleccion->findOne(['ID_Pelicula' => $id]);
        return $resultado;
    }

    public function insertarPelicula($data){
        $resultado = $this -> coleccion ->insertOne($data);
        return $resultado;
    }
}