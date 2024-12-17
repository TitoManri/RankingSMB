<?php

require_once '../config/Conexion.php'; 
use Dotenv\Dotenv;

use MongoDB\BSON\ObjectId;

class Comentarios extends Conexion{

    private $coleccion;

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
        $this-> coleccion = $this->conectarBaseMongo($datosmongo)->comentarios;
    }

    public function insertarComentaio($data){
        $this->coleccion->insertOne($data);
        return true;
    }

    public function conseguirComentarios($IdContenido){
        $objectId = new ObjectId($IdContenido);
        $pipeline = [
            [
                '$match' => ['IdReseña' => $objectId]
            ],
            [
                '$lookup' => [
                    'from' => 'usuarios',
                    'localField' => 'IdUsuario',
                    'foreignField' => '_id',
                    'as' => 'usuarioInfo'
                ]
            ],
            [
                '$unwind' => '$usuarioInfo'
            ],
            [
                '$project' => [
                    'TextoComentario' => 1,
                    'Fecha' => 1,
                    'usuarioInfo.NombredeUsuario' => 1,
                    'usuarioInfo.FotodePerfil' => 1,
                ]
            ]
        ];
        $resultado = $this->coleccion->aggregate($pipeline);
        
        $resennasArray = iterator_to_array($resultado);
        return $resennasArray;
}
}