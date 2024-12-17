<?php
require_once '../models/Libros.php';
require __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

$op = isset($_GET['op']) ? $_GET['op'] : null;
$libro = new Libros();

switch ($op) {
    case 'existeLibroEnBD': {
            $ID_Libro = isset($_POST['ID_Libro']) ? $_POST['ID_Libro'] : null;
            if (!$ID_Libro) {
                $response = ["exito" => false, "msg" => "Hubo un error al conseguir la información del libro."];
                echo json_encode($response);
                exit;
            }
            try {
                $buscarLibro = $libro->getLibroID($ID_Libro);
                if ($buscarLibro) {
                    $response = ["exito" => true, "msg" => "La película existe en la base de datos.", "object" => $buscarLibro];
                } else {
                    $response = ["exito" => false, "msg" => "La película no existe en la base de datos."];
                }
            } catch (Exception $e) {
                $response = ["exito" => false, "msg" => "Un error sucedió al buscar el libro: " . $e->getMessage()];
            }
            echo json_encode($response);
            break;
        }

    case 'SubirLibro': {
            $ID_Libro = isset($_POST['ID_Libro']) ? $_POST['ID_Libro'] : null;
            $Titulo = isset($_POST['Titulo']) ? ($_POST['Titulo']) : null;
            $Publicante = isset($_POST['Publicante']) ? ($_POST['Publicante']) : null;
            $Autor = isset($_POST['Autor']) ? ($_POST['Autor']) : null;
            $Lanzamiento = isset($_POST['Lanzamiento']) ? ($_POST['Lanzamiento']) : null;
            $Publico = isset($_POST['Publico']) ? ($_POST['Publico']) : null;
            $Sinopsis = isset($_POST['Sinopsis']) ? ($_POST['Sinopsis']) : null;
            $Poster = isset($_POST['Poster']) ? ($_POST['Poster']) : null;
            $TotalPaginas = isset($_POST['TotalPaginas']) ? intval($_POST['TotalPaginas']) : null;
            $LinkCompraGoogle = isset($_POST['LinkCompraGoogle']) ? ($_POST['LinkCompraGoogle']) : null;

            if (
                !$ID_Libro || !$Titulo || !$Publicante || !$Autor 
                || !$Lanzamiento || !$Publico || !$Poster || !$LinkCompraGoogle
            ) {
                $response = ["exito" => false, "msg" => "Hubo un error al conseguir la información del libro."];
                echo json_encode($response);
                exit;
            }

            try {
                $libroInsertar = [
                    'ID_Libro' => $ID_Libro,
                    'Titulo' => $Titulo,
                    'Publicante' => $Publicante,
                    'Autor' => $Autor,
                    'Lanzamiento' => new MongoDB\BSON\UTCDateTime((new DateTime($Lanzamiento))->getTimestamp() * 1000),
                    'Publico' => $Publico,
                    'Sinopsis' => $Sinopsis,
                    'Poster' => $Poster,
                    'TotalPaginas' => $TotalPaginas,
                    'LinkCompraGoogle' => $LinkCompraGoogle
                ];

                $confirmarInsertado = $libro->insertarLibro($libroInsertar);
                if ($confirmarInsertado) {
                    $response = ["exito" => true, "msg" => "Se subió el libro por primera vez.", "object" => $confirmarInsertado];
                } else {
                    $response = ["exito" => false, "msg" => "Sucedió algo mal al insertar el libro."];
                }
            } catch (Exception $e) {
                $response = //$libroInsertar;
                    ["exito" => false, "msg" => "Un error sucedió al subir el libro: " . $e->getMessage()];
            }
            echo json_encode($response);
            break;
        }
    case 'obtenerLibroDeOID': {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            if (!$id) {
                $response = ["exito" => false, "msg" => "Hubo un error al conseguir la información del libro."];
                echo json_encode($response);
                exit;
            }
            try {
                $buscarLibro = $libro->obtenerLibroDeOID($id);
                if ($buscarLibro) {
                    $response = ["exito" => true, "msg" => "La película existe en la base de datos.", "object" => $buscarLibro];
                } else {
                    $response = ["exito" => false, "msg" => "La película no existe en la base de datos."];
                }
            } catch (Exception $e) {
                $response = ["exito" => false, "msg" => "Un error sucedió al buscar el libro: " . $e->getMessage()];
            }
            echo json_encode($response);
            break;
        }
}
