<?php

require_once '../config/Conexion.php'; 
use Dotenv\Dotenv;

use MongoDB\BSON\ObjectId;

class Series extends Conexion{

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
        $this-> coleccion = $this->conectarBaseMongo($datosmongo)->Series;
    }

    public function getSerieID($id){
        $resultado = $this->coleccion->findOne(['ID_Serie' => $id]);
        return $resultado;
    }

    public function insertarSerie($data){
        $resultado = $this -> coleccion ->insertOne($data);
        return $resultado->getInsertedId();
    }

    public function obtenerSerieDeOID($id){
        $objectId = new ObjectId($id);
        $resultado = $this->coleccion->findOne(['_id' => $objectId]);
        return $resultado;
    }
}