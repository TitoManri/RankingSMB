<?php
require_once '../models/Peliculas.php';
require __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

$op = isset($_GET['op']) ? $_GET['op'] : null;
$pelicula = new Peliculas();

switch ($op) {
    case 'existePeliculaEnBD': {
            $ID_Pelicula = isset($_POST['ID_Pelicula']) ? $_POST['ID_Pelicula'] : null;
            if (!$ID_Pelicula) {
                $response = ["exito" => false, "msg" => "Hubo un error al conseguir la información de la película."];
                echo json_encode($response);
                exit;
            }
            try{
                $ID_Pelicula = intval($ID_Pelicula);
                $buscarPelicula = $pelicula -> getPeliculaID($ID_Pelicula);
                if($buscarPelicula){
                    $response = ["exito" => true, "msg" => "La película existe en la base de datos.", "object" => $buscarPelicula];
                }else{
                    $response = ["exito" => false, "msg" => "La película no existe en la base de datos."];
                }
            }catch(Exception $e){
                $response = ["exito" => false, "msg" => "Un error sucedió al buscar la película: " . $e->getMessage()];
            }
            echo json_encode($response);
            break;
        }

    case 'SubirPelicula': {
            $ID_Pelicula = isset($_POST['ID_Pelicula']) ? intval($_POST['ID_Pelicula']) : null;
            $TituloOriginal = isset($_POST['TituloOriginal']) ? $_POST['TituloOriginal'] : null;
            $TituloTraducido = isset($_POST['TituloTraducido']) ? $_POST['TituloTraducido'] : null;
            $GenerosOriginal = isset($_POST['Generos']) ? $_POST['Generos'] : null;
            $Lanzamiento = isset($_POST['Lanzamiento']) ? $_POST['Lanzamiento'] : null;
            $Duracion = isset($_POST['Duracion']) ? intval($_POST['Duracion']) : null;
            $Sinopsis = isset($_POST['Sinopsis']) ? $_POST['Sinopsis'] : null;
            $Poster = isset($_POST['Poster']) ? $_POST['Poster'] : null;
            $CostoPelicula = isset($_POST['CostoPelicula']) ? intval($_POST['CostoPelicula']) : null;
            $RecaudacionPelicula = isset($_POST['RecaudacionPelicula']) ? intval($_POST['RecaudacionPelicula']) : null;
            $CalificacionGeneral = isset($_POST['CalificacionGeneral']) ? floatval($_POST['CalificacionGeneral']) : null;
            $Estado = isset($_POST['Estado']) ? $_POST['Estado'] : null;
            $Publico = isset($_POST['Publico']) ? $_POST['Publico'] : null;

            if (
                !$ID_Pelicula || !$TituloOriginal || !$TituloTraducido || !$GenerosOriginal || !$Lanzamiento ||
                !$Sinopsis || !$CostoPelicula || !$RecaudacionPelicula || !$CalificacionGeneral || !$Publico
            ) {
                $response = ["exito" => false, "msg" => "Hubo un error al conseguir la información de la película."];
                echo json_encode($response);
                exit;
            }

            try {
                $Generos = [];
                foreach ($GenerosOriginal as $genero) {
                    $Generos[] = [
                        "id" => (int) $genero["id"],
                        "name" => $genero["name"]
                    ];
                }
                $peliculaInsertar = [
                    'ID_Pelicula' => $ID_Pelicula,
                    'TituloOriginal' => $TituloOriginal,
                    'TituloTraducido' => $TituloTraducido,
                    'Generos' => $Generos,
                    'Lanzamiento' => new MongoDB\BSON\UTCDateTime((new DateTime($Lanzamiento))->getTimestamp() * 1000),
                    'Duracion' => $Duracion,
                    'Sinopsis' => $Sinopsis,
                    'Poster' => $Poster,
                    'CostoPelicula' => $CostoPelicula,
                    'RecaudacionPelicula' => $RecaudacionPelicula,
                    'CalificacionGeneral' => $CalificacionGeneral,
                    'Estado' => $Estado,
                    'Publico' => $Publico,
                ];

                $confirmarInsertado = $pelicula->insertarPelicula($peliculaInsertar);
                if ($confirmarInsertado) {
                    $response = ["exito" => true, "msg" => "Se subió la película por primera vez."];
                } else {
                    $response = ["exito" => false, "msg" => "Sucedió algo mal al insertar la película."];
                }
            } catch (Exception $e) {
                $response = //$peliculaInsertar;
                ["exito" => false, "msg" => "Un error sucedió al subir la película: " . $e->getMessage()];
            }
            echo json_encode($response);
            break;
        }
}
