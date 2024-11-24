<?php

require_once '../config/Conexion.php'; // Ensure the Conexion class is included
use Dotenv\Dotenv;

class ListasMySModel extends Conexion
{
    private $coleccion;
    private $idUsuario;
    private $nombre;
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
        $this->coleccion = $this->conectarBaseMongo($datosmongo)->ListasSM;
    }
    
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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

    //------Obtener Listas por idUsuario y nombre------//
    //----Lista Favorita de Usuario X----//
    public function obtenerListaFavPorUsuario($idUsuario,$nombre)
    {
        $resultado = $this->coleccion->findOne(['IdUsuario' => $idUsuario, 'Nombre' => $nombre]);
        return $resultado;
    }

    //----Lista Por Ver de Usuario X----//
    public function obtenerListaPorVerPorUsuario($idUsuario,$nombre)
    {
        $resultado = $this->coleccion->findOne(['IdUsuario' => $idUsuario, 'Nombre' => $nombre]);
        return $resultado;
    }
    //----Lista Vista de Usuario X----//
    public function obtenerListaVistosPorUsuario($idUsuario,$nombre)
    {
        $resultado = $this->coleccion->findOne(['IdUsuario' => $idUsuario, 'Nombre' => $nombre]);
        return $resultado;
    }

    //------Buscar Peliculas y Series dentro del Array------//
    public function obtenerPeliculasySeries($listaUsuario,$IdContenidoAgregado)
    {
        foreach ($listaUsuario as $contenido) {
            if ($contenido['id'] === $IdContenidoAgregado) { //Cambiar 'id' por el codigo de la pelicula
                return $contenido;
            }
        }
        return null;  
    }

    //----Eliminar Peliculass dentro del Array----//
    public function eliminarPeliculaDeLista($idUsuario,$nombre)
    {
        //Buscamos la lista 
        //Eliminamos la lista
    }

    //------Filtros------//

    public function filtroDeGenero($idUsuario,$nombre,$IdContenidoAgregado,$genero)
    {
        //Conseguir la lista de usuario
        $listaUsuario = $this->obtenerListaPorVerPorUsuario($idUsuario,$nombre);
        //Conseguimos la lista de peliculas y series 
        //Si en el array de $listaUsuario se encuentra que nombre es Favorito o PorVer o Visto
        if($listaUsuario){//Favorito
            $listaMyS = $this->obtenerListaFavPorUsuario($listaUsuario,$IdContenidoAgregado);
            //Filtramos el find por el genero seleccionado
            return 0; //Devolvemos el find filtrado
        }else if($listaUsuario){ // Por Ver
            $listaMyS = $this->obtenerListaPorVerPorUsuario($listaUsuario,$IdContenidoAgregado);
            //Filtramos el find por el genero seleccionado
            return 0; //Devolvemos el find filtrado
        }else if ($listaUsuario){ // Vistos
            $listaMyS = $this->obtenerListaVistosPorUsuario($listaUsuario,$IdContenidoAgregado);
            //Filtramos el find por el genero seleccionado
            return 0;//Devolvemos el find filtrado
        }else{
            //Mande un Error
            return 0; //Devolvemos el error
        }
    }

    public function filtroAnio($idUsuario,$nombre,$IdContenidoAgregado,$anio)
    {
        //Conseguir la lista de usuario
        $listaUsuario = $this->obtenerListaPorVerPorUsuario($idUsuario,$nombre);
        //Conseguimos la lista de peliculas y series 
        //Si en el array de $listaUsuario se encuentra que nombre es Favorito o PorVer o Visto
        if($listaUsuario){//Favorito
            $listaMyS = $this->obtenerListaFavPorUsuario($listaUsuario,$IdContenidoAgregado);
            //Filtramos el find por el genero seleccionado
            return 0; //Devolvemos el find filtrado
        }else if($listaUsuario){ // Por Ver
            $listaMyS = $this->obtenerListaPorVerPorUsuario($listaUsuario,$IdContenidoAgregado);
            //Filtramos el find por el genero seleccionado
            return 0; //Devolvemos el find filtrado
        }else if ($listaUsuario){ // Vistos
            $listaMyS = $this->obtenerListaVistosPorUsuario($listaUsuario,$IdContenidoAgregado);
            //Filtramos el find por el genero seleccionado
            return 0;//Devolvemos el find filtrado
        }else{
            //Mande un Error
            return 0; //Devolvemos el error
        }
    }

    public function filtroPorNombre($IdContenidoAgregado,$anio)
    {
        //Hacemos un if por si es ASC/DESC
        //Si es ASC filtramos el find por el nombre de la pelicula ASC
            //Pasos
                //Paso 1: Conseguimos la lista de peliculas y series
                //Paso 2: Filtramos el find por el nombre en ASC
                //Paso 3: Devolvemos el find ASC
        //Si es DESC filtramos el find por el nombre de la pelicula DESC
            //Pasos
                //Paso 1: Conseguimos la lista de peliculas y series
                //Paso 2: Filtramos el find por el nombre en DESC
                //Paso 3: Devolvemos el find DESC
    }
}

?>