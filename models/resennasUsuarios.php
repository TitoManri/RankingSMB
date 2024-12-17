<?php
require_once '../config/Conexion.php'; 
use Dotenv\Dotenv;

use MongoDB\BSON\ObjectId;

class Resennas extends Conexion{

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
        $this-> coleccion = $this->conectarBaseMongo($datosmongo)->reseñas;
    }
    
    public function insertarResennas($data){
        $resultado = $this -> coleccion ->insertOne($data);
        return $resultado;
    }

    public function obtenerResennasDeContenido($IdContenido){
            $objectId = new ObjectId($IdContenido);
            $pipeline = [
                [
                    '$match' => ['IdContenido' => $objectId]
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
                        'Calificacion' => 1,
                        'FechaCreacion' => 1,
                        'FechaModificacion' => 1,
                        'Opinion' => 1,
                        'usuarioInfo.NombredeUsuario' => 1,
                        'usuarioInfo.FotodePerfil' => 1,
                        //Aqui se puede agregar mas campos del usuario
                        //O mejor dicho, se proyectan los campos que se quieren mostrar
                        //Ojala el profe este orgulloso de mi :')
                    ]
                ]
            ];
            $resultado = $this->coleccion->aggregate($pipeline);
            
            //POR ESTA MINIMA LINEA NO SERVIA MI CODIGO POR 1 HORA. QUIERO LLORAR
            $resennasArray = iterator_to_array($resultado);
            return $resennasArray;
    }

    public function obtenerResennaPorID($IdResenna){
        $objectId = new ObjectId($IdResenna);
        $pipeline = [
            [
                '$match' => ['_id' => $objectId]
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
                    'Calificacion' => 1,
                    'FechaCreacion' => 1,
                    'FechaModificacion' => 1,
                    'Opinion' => 1,
                    'TipoContenido' => 1,
                    'IdContenido' => 1,
                    'usuarioInfo.NombredeUsuario' => 1,
                    'usuarioInfo.FotodePerfil' => 1,
                ]
            ]
        ];
        $resultado = $this->coleccion->aggregate($pipeline);
        
        $resenna = iterator_to_array($resultado);
        return !empty($resenna) ? $resenna[0] : null;
    }
}