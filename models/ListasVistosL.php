<?php

require_once '../config/Conexion.php'; // Ensure the Conexion class is included
use Dotenv\Dotenv;

class ListasVistosL extends Conexion
{
    private $coleccion;
    private $idUsuario;
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
        $this->coleccion = $this->conectarBaseMongo($datosmongo)->ListasVistosL;
    }


    //Funciones 

    /* Ver si exsite una lista asosiada con el id del usuario */
    public function existeUsuarioEnLista($idUsuario) {
        $filtro = ['IdUsuario' => $idUsuario];
        $resultado = $this->coleccion->findOne($filtro);
        return $resultado !== null;
    }

    /* Insertar la lista por primera vez */
    public function insertarListaFav($lista) {
        try {
            $resultado = $this->coleccion->insertOne($lista);
            return $resultado;
        } catch (Exception $e) {
            throw new Exception("Error al insertar en la base de datos: " . $e->getMessage());
        }
    }

     /* Actualizar la lista para insertar un libro */
    public function updatearListaFav($idUsuario, $idLibroObjectId) {
        try {
            $filtro = ['IdUsuario' => $idUsuario];
    
            $actualizacion = [
                '$set' => [
                    'FechaModificacion' => new MongoDB\BSON\UTCDateTime()
                ],
                '$push' => [
                    'IdContenidosAgregados' => $idLibroObjectId
                ]
            ];
    
            $resultado = $this->coleccion->updateOne($filtro, $actualizacion);
    
            return $resultado;
        } catch (Exception $e) {
            throw new Exception("Error al actualizar en la base de datos: " . $e->getMessage());
        }
    }

    /* Eliminar Libro de la Lista */
    public function eliminarLibroDeListaFav($idUsuario, $idLibroObjectId) {
        try {
            $filtro = ['IdUsuario' => $idUsuario];
            
            $actualizacion = [
                '$set' => [
                    'FechaModificacion' => new MongoDB\BSON\UTCDateTime()
                ],
                '$pull' => [
                    'IdContenidosAgregados' => $idLibroObjectId
                ]
            ];
            
            $resultado = $this->coleccion->updateOne($filtro, $actualizacion);
            
            return $resultado;
        } catch (Exception $e) {
            throw new Exception("Error al eliminar el libro de la lista: " . $e->getMessage());
        }
    }

    /* Lista de Todos los libros */
    public function obtenerLibrosPorUsuario($idUsuario) {
        try {
            $filtro = ['IdUsuario' => $idUsuario];
            $resultado = $this->coleccion->findOne($filtro);
    
            if ($resultado) {
                return $resultado['IdContenidosAgregados'];
            } else {
                throw new Exception("No se encontró la lista de favoritos para el usuario.");
            }
        } catch (Exception $e) {
            throw new Exception("Error al obtener la lista de libros: " . $e->getMessage());
        }
    }

}

?>