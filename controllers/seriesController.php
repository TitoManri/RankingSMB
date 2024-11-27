<?php
require_once '../models/Series.php';
require __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

$op = isset($_GET['op']) ? $_GET['op'] : null;
$serie = new Series();

switch ($op) {
    case 'existeSerieEnBD': {
            $ID_Serie = isset($_POST['ID_Serie']) ? $_POST['ID_Serie'] : null;
            if (!$ID_Serie) {
                $response = ["exito" => false, "msg" => "Hubo un error al conseguir la información de la serie."];
                echo json_encode($response);
                exit;
            }
            try {
                $ID_Serie = intval($ID_Serie);
                $buscarSerie = $serie->getSerieID($ID_Serie);
                if ($buscarSerie) {
                    $response = ["exito" => true, "msg" => "La serie existe en la base de datos.", "object" => $buscarSerie];
                } else {
                    $response = ["exito" => false, "msg" => "La serie no existe en la base de datos."];
                }
            } catch (Exception $e) {
                $response = ["exito" => false, "msg" => "Un error sucedió al buscar la serie: " . $e->getMessage()];
            }
            echo json_encode($response);
            break;
        }

    case 'SubirSerie': {
            $ID_Serie = isset($_POST['ID_Serie']) ? intval($_POST['ID_Serie']) : null;
            $TituloOriginal = isset($_POST['TituloOriginal']) ? $_POST['TituloOriginal'] : null;
            $TituloTraducido = isset($_POST['TituloTraducido']) ? $_POST['TituloTraducido'] : null;
            $GenerosOriginal = isset($_POST['Generos']) ? $_POST['Generos'] : null;
            $Lanzamiento = isset($_POST['Lanzamiento']) ? $_POST['Lanzamiento'] : null;
            $Sinopsis = isset($_POST['Sinopsis']) ? $_POST['Sinopsis'] : null;
            $Poster = isset($_POST['Poster']) ? $_POST['Poster'] : null;
            $CapitulosTotales = isset($_POST['CapitulosTotales']) ? intval($_POST['CapitulosTotales']) : null;
            $Temporadas = isset($_POST['Temporadas']) ? intval($_POST['Temporadas']) : null;
            $CalificacionGeneral = isset($_POST['CalificacionGeneral']) ? floatval($_POST['CalificacionGeneral']) : null;
            $Estado = isset($_POST['Estado']) ? $_POST['Estado'] : null;
            $Publico = isset($_POST['Publico']) ? $_POST['Publico'] : null;

            if (
                !$ID_Serie || !$TituloOriginal || !$TituloTraducido || !$GenerosOriginal || !$Lanzamiento ||
                !$Sinopsis || !$CapitulosTotales || !$Temporadas || !$CalificacionGeneral || !$Publico
            ) {
                $response = ["exito" => false, "msg" => "Hubo un error al conseguir la información de la serie."];
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
                $serieInsertar = [
                    'ID_Serie' => $ID_Serie,
                    'TituloOriginal' => $TituloOriginal,
                    'TituloTraducido' => $TituloTraducido,
                    'Generos' => $Generos,
                    'Lanzamiento' => new MongoDB\BSON\UTCDateTime((new DateTime($Lanzamiento))->getTimestamp() * 1000),
                    'Sinopsis' => $Sinopsis,
                    'Poster' => $Poster,
                    'Temporadas' => $Temporadas,
                    'CapitulosTotales' => $CapitulosTotales,
                    'CalificacionGeneral' => $CalificacionGeneral,
                    'Estado' => $Estado,
                    'Publico' => $Publico
                ];

                $confirmarInsertado = $serie->insertarSerie($serieInsertar);
                if ($confirmarInsertado) {
                    $response = ["exito" => true, "msg" => "Se subió la serie por primera vez."];
                } else {
                    $response = ["exito" => false, "msg" => "Sucedió algo mal al insertar la serie."];
                }
            } catch (Exception $e) {
                $response = //$serieInsertar;
                    ["exito" => false, "msg" => "Un error sucedió al subir la serie: " . $e->getMessage()];
            }
            echo json_encode($response);
            break;
        }
}
