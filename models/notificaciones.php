<?php

//Trae la conexion de mongodb (Base de Datos)
require_once '../config/Conexion.php';

//Libreria para el .env
use Dotenv\Dotenv;

//Abre la clase y se extiende de conexion
class notificaciones extends Conexion
{
    //Las variables que estan en la coleccion y la variable collecion para traer todos los docs
    private $coleccion;
    private $idUsuario;
    private $TipoNotificacion;
    private $Leido;
    private $FechaDeCreacion;
    
    //Establecer la conexion de la base de datos y identificar la collecion y guardarlo en una variable
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
        $this->coleccion = $this->conectarBaseMongo($datosmongo)->notificaciones;
    }

    //Obtener Notificaciones por Usuario
    public function obtenerNotificacionesPorUsuario($idUsuario) { //Id Usuario - ObjectId
        try {
            //Consulta de las notificaciones
            $resultado = $this->coleccion->find(['IdUsuario' => $idUsuario], 
            ['sort' => ['FechadeCreacion' => 1]]
            );
            
            $notificaciones = iterator_to_array($resultado); //Convierte en un arreglo

            // Convertir ObjectId a string
            foreach ($notificaciones as &$notificacion) {
                if (isset($notificacion['_id']) && $notificacion['_id'] instanceof MongoDB\BSON\ObjectId) {
                    $notificacion['_id'] = (string) $notificacion['_id']; // Convertir ObjectId a string
                }
            }
            return $notificaciones; //Respuesta / Array[notificaciones]
        } catch (Exception $e) {
            return ['error' => 'Error al recuperar notificaciones: ' . $e->getMessage()];
        }
    }

    //Leer notificaciones [Update]
    public function leerNotificacionesPorUsuario($idNotificacion){
        try{
            $resultado = $this->coleccion->updateOne(
                ['_id' => $idNotificacion], //Filtro para que solo se actualice la notificacion con el ID correspondiente
                ['$set' => ['Leido' => true]] //Cambia el estado de leido de false a true
            );

            //$leido = iterator_to_array($resultado);
            return $resultado;
        }catch (Exception $e){
            return ['error' => 'Error al marcar la notificación como leída: ' . $e->getMessage()];
        }
    }

}

?>