<?php
require __DIR__ . '/../vendor/autoload.php'; 
// Cargar el archivo .env
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

class Conexion{

private $datosMongo;

function __construct() {
    // Acceder a las variables de entorno
    $this->datosMongo = [
        'host' => getenv('MONGO_HOST'),
        'port' => getenv('MONGO_PORT'),
        'basededatos' => getenv('MONGO_DB'),
        'usuario' => getenv('MONGO_USERNAME'),
        'contrasena' => getenv('MONGO_PASSWORD')
    ];
}

function conectarBaseMongo($datosMongo) {
    try {
        if (!empty($datosMongo['usuario']) && !empty($datosMongo['contrasena'])) {
            $uri = "mongodb://{$datosMongo['usuario']}:{$datosMongo['contrasena']}@{$datosMongo['host']}:{$datosMongo['port']}";
        } else {
            $uri = "mongodb://{$datosMongo['host']}:{$datosMongo['port']}";
        }

        $client = new MongoDB\Client($uri);
        $basededatos = $client->selectDatabase($datosMongo['basededatos']);
        
        return $basededatos;
    } catch (Exception $e) {
        die("Error al conectar con MongoDB: " . $e->getMessage());
    }
}
}

?>


