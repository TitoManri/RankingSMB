<?php

require_once '../config/Conexion.php'; 
use Dotenv\Dotenv;

use MongoDB\BSON\ObjectId;

class Libros extends Conexion{

    private $coleccion;
    private $id;
    private $NombreLibro;
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
        $this-> coleccion = $this->conectarBaseMongo($datosmongo)->Libros;
    }

    public function getLibroID($id){
        $resultado = $this->coleccion->findOne(['ID_Libro' => $id]);
        return $resultado;
    }

    public function insertarLibro($data){
        $resultado = $this -> coleccion ->insertOne($data);
        return $resultado->getInsertedId();
    }

    public function obtenerLibroDeOID($id){
        $objectId = new ObjectId($id);
        $resultado = $this->coleccion->findOne(['_id' => $objectId]);
        return $resultado;
    }
}