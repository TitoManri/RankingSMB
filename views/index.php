<?php
require '../vendor/autoload.php'; // Asegúrate de tener Composer instalado y MongoDB cliente instalado

try {
    // Crear una conexión a MongoDB
    $client = new MongoDB\Client("mongodb://localhost:27017");
    echo "Conexión a MongoDB establecida con éxito.<br>";

    // Seleccionar la base de datos
    $database = $client->selectDatabase('HeladosMemphis');

    // Verificar las colecciones
    $collections = $database->listCollections();
    echo "Colecciones en 'HeladosMenphis':<br>";
    foreach ($collections as $collection) {
        echo $collection->getName() . "<br>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
