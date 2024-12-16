<?php

require_once '../config/Conexion.php'; // Ensure the Conexion class is included
use Dotenv\Dotenv;

class ListasFavoritosSM extends Conexion
{
    private $coleccion;
    private $idUsuario;
    private $IdContenidoAgregado;
    private $FechaDeCreacion;
    private $FechaDeModificacion;

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
        $this->coleccion = $this->conectarBaseMongo($datosmongo)->ListasFavoritosSM;
    }
    
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdContenidoAgregado()
    {
        return $this->IdContenidoAgregado;
    }

    public function setIdContenidoAgregado($IdContenidoAgregado)
    {
        $this->IdContenidoAgregado = $IdContenidoAgregado;
    }

    public function getFechaDeCreacion()
    {
        return $this->FechaDeCreacion;
    }

    public function setFechaDeCreacion($FechaDeCreacion)
    {
        $this->FechaDeCreacion = $FechaDeCreacion;
    }

    public function getFechaDeModificacion()
    {
        return $this->FechaDeModificacion;
    }

    public function setFechaDeModificacion($FechaDeModificacion)
    {
        $this->FechaDeModificacion = $FechaDeModificacion;
    }

    //Funciones 

    /* Ver si exsite una lista asosiada con el id del usuario */
    public function existeUsuarioEnLista() {
        $filtro = ['id_usuario' => $this->idUsuario];
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

     /* Actualizar la lista para insertar una pelicula */
    public function updatearListaFav($idUsuario, $idPeliculaObjectId) {
        try {
            $filtro = ['IdUsuario' => $idUsuario];
    
            $actualizacion = [
                '$set' => [
                    'FechaModificacion' => new MongoDB\BSON\UTCDateTime()
                ],
                '$push' => [
                    'IdContenidosAgregados' => $idPeliculaObjectId
                ]
            ];
    
            $resultado = $this->coleccion->updateOne($filtro, $actualizacion);
    
            return $resultado;
        } catch (Exception $e) {
            throw new Exception("Error al actualizar en la base de datos: " . $e->getMessage());
        }
    }
}

?>