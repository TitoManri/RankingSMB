<?php

require_once '../config/Conexion.php'; 
use Dotenv\Dotenv;
use MongoDB\BSON\ObjectId;

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

    public function obtenerDetallesPeliculas($idsPeliculas) {
        try {
            if (empty($idsPeliculas)) {
                throw new Exception("La lista de IDs de películas está vacía.");
            }
    
            // Iterar sobre el BSONArray directamente
            $objectIds = array_map(fn($id) => new MongoDB\BSON\ObjectId((string)$id), iterator_to_array($idsPeliculas));
    
            // Consulta en lote
            $peliculas = $this->coleccion->find(['_id' => ['$in' => $objectIds]]);
    
            $detallesPeliculas = [];
            foreach ($peliculas as $pelicula) {
                $detallesPeliculas[] = [
                    'idContenido' => (string) $pelicula['_id'],
                    'TituloTraducido' => $pelicula['TituloTraducido'] ?? 'Título no disponible',
                    'Poster' => $pelicula['Poster'] ?? 'Poster no disponible',
                    'Sinopsis' => $pelicula['Sinopsis'] ?? 'Sinopsis no disponible',
                    'Lanzamiento' => $pelicula['Lanzamiento'] ?? 'Lanzamiento no disponible',
                ];
            }
    
            return $detallesPeliculas;
        } catch (Exception $e) {
            throw new Exception("Error al obtener los detalles de las películas: " . $e->getMessage());
        }
    }
    
    
    
    
}