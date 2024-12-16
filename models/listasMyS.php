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
            if ($contenido['ID_Pelicula'] === $IdContenidoAgregado) { //Cambiar 'id' por el codigo de la pelicula
                return $contenido;
            }
        }
        return null;  
    }

    //----Eliminar Peliculass dentro del Array----// 
    // [No tengo muy bien pensado como se puede hacer] //
    public function eliminarPeliculaDeLista($idUsuario, $nombre)
    {
        if (!isset($this->listas[$idUsuario])) {
            return "La lista del usuario no existe.";
        }

        // Si no se encontró el contenido
        return "El contenido no se encontró en la lista.";
    }


    //------Filtros------//

    public function filtroDeGenero($idUsuario, $nombreLista, $genero)
    {
        $listaUsuario = null;

        // Obtener la lista correspondiente según el nombre
        if ($nombreLista === 'Favoritos') {
            $listaUsuario = $this->obtenerListaFavPorUsuario($idUsuario, $nombreLista);
        } elseif ($nombreLista === 'Por Ver') {
            $listaUsuario = $this->obtenerListaPorVerPorUsuario($idUsuario, $nombreLista);
        } elseif ($nombreLista === 'Vistos') {
            $listaUsuario = $this->obtenerListaVistosPorUsuario($idUsuario, $nombreLista);
        } else {
            throw new Exception("Nombre de lista no válido: '$nombreLista'");
        }

        // Validar si la lista se encontró
        if (!$listaUsuario || !isset($listaUsuario['contenidos'])) {
            throw new Exception("No se encontró la lista '$nombreLista' para el usuario con ID $idUsuario");
        }

        //filtra los contenidos por genero con el "array filter"
        $contenidoFiltrado = array_filter($listaUsuario['contenidos'], function ($contenido) use ($genero) {
            return in_array($genero, $contenido['generos']);
        });
    
        return $contenidoFiltrado;
    }


    public function filtroAnio($idUsuario, $nombreLista, $IdContenidoAgregado, $anio = null)
{
    $listaUsuario = null;

    // Obtener la lista correspondiente según el nombre
    if ($nombreLista === 'Favoritos') {
        $listaUsuario = $this->obtenerListaFavPorUsuario($idUsuario, $nombreLista);
    } elseif ($nombreLista === 'Por Ver') {
        $listaUsuario = $this->obtenerListaPorVerPorUsuario($idUsuario, $nombreLista);
    } elseif ($nombreLista === 'Vistos') {
        $listaUsuario = $this->obtenerListaVistosPorUsuario($idUsuario, $nombreLista);
    } else {
        throw new Exception("Nombre de lista no válido: '$nombreLista'");
    }

    // Filtrar por año si se proporciona un año válido
    if ($anio) {
        $listaFiltrada = array_filter($listaUsuario, function($contenido) use ($anio) {
            return isset($contenido['anio']) && $contenido['anio'] == $anio;
        });

        return $listaFiltrada;
    } else {
        // Si no se especifica un año, devolver toda la lista
        return $listaUsuario;
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