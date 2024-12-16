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

    //------

    //------Obtener Listas por idUsuario y nombre------//
    //----Lista Favorita de Usuario X----//
    
        public function insertarListaFav($lista) {
            try {
                $resultado = $this->coleccion->insertOne($lista);
                return $resultado;
            } catch (Exception $e) {
                throw new Exception("Error al insertar en la base de datos: " . $e->getMessage());
            }
        }
        
        public function obtenerListaFavPorUsuario($idUsuario,$idPelicula){
            $documento = [ 'idUsuario' => $idUsuario, 'idPelicula' => $idPelicula, 'Estado' => 'favorita'];
            return $this->coleccion->insertOne($documento);
        }

        //----Elimina de la Lista de Favoritos----//
        public function eliminarDeListaFavoritos($idUsuario, $idPelicula) {
            $filtro = ['idUsuario' => $idUsuario, 'idPelicula' => $idPelicula, 'Estado' => 'favorita'];
            return $this->coleccion->deleteOne($filtro);
        }

        //----Verifica si existe la pelicula en la lista de favoritos
        public function verificarFavorito($idUsuario, $idPelicula) {
            $filtro = ['idUsuario' => $idUsuario, 'idPelicula' => $idPelicula, 'Estado' => 'favorita'];
            return $this->coleccion->findOne($filtro) !== null;
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

    public function filtroPorNombre($idUsuario, $nombreLista, $orden)
    {
        // Paso 1: Conseguimos la lista de películas y series según el nombre de la lista
        if ($nombreLista === 'Favoritos') {
            $contenido = $this->obtenerListaFavPorUsuario($idUsuario, $nombreLista);
        } elseif ($nombreLista === 'Por Ver') {
            $contenido = $this->obtenerListaPorVerPorUsuario($idUsuario, $nombreLista);
        } elseif ($nombreLista === 'Vistos') {
            $contenido = $this->obtenerListaVistosPorUsuario($idUsuario, $nombreLista);
        } else {
            throw new Exception("Nombre de lista no válido: '$nombreLista'");
        }

        // Validamos si el orden es ASC o DESC
        if (strtoupper($orden) === 'ASC') {
            // Paso 2: Filtramos el contenido por el nombre en ASC
            usort($contenido, function ($a, $b) {
                return strcmp($a['nombre'], $b['nombre']);
            });
        } elseif (strtoupper($orden) === 'DESC') {
            // Paso 2: Filtramos el contenido por el nombre en DESC
            usort($contenido, function ($a, $b) {
                return strcmp($b['nombre'], $a['nombre']);
            });
        } else {
            // Si el orden no es válido, lanzamos una excepción
            throw new InvalidArgumentException("El orden debe ser 'ASC' o 'DESC'.");
        }

        // Paso 3: Devolvemos el contenido ordenado
        return $contenido;
    }

}

?>