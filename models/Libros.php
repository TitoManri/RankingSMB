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

    public function obtenerDetallesLibros($idsLibros) {
        try {
            if (empty($idsLibros)) {
                throw new Exception("La lista de IDs de libros está vacía.");
            }
    
            // Iterar sobre el BSONArray directamente
            $objectIds = array_map(fn($id) => new MongoDB\BSON\ObjectId((string)$id), iterator_to_array($idsLibros));
    
            // Consulta en lote
            $libros = $this->coleccion->find(['_id' => ['$in' => $objectIds]]);
    
            $detallesLibros = [];
            foreach ($libros as $libro) {
                $detallesLibros[] = [
                    'idContenido' => (string) $libro['_id'],
                    'Titulo' => $libro['Titulo'] ?? 'Título no disponible',
                    'Autor' => $libro['Autor'] ?? 'Autor no disponible',
                    'Poster' => $libro['Poster'] ?? 'Poster no disponible',
                    'Sinopsis' => $libro['Sinopsis'] ?? 'Sinopsis no disponible',
                ];
            }
    
            return $detallesLibros;
        } catch (Exception $e) {
            throw new Exception("Error al obtener los detalles de los libros: " . $e->getMessage());
        }
    }
}