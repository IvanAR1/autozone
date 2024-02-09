<?php


// Cargar la configuración desde el archivo .env
$dotenv = file_get_contents('./../.env');

// Convertir el contenido en un array asociativo
$dotenvArray = explode("\n", $dotenv);
$envConfig = [];
foreach ($dotenvArray as $line) {
    $line = trim($line);
    if ($line !== '' && strpos($line, '=') !== false) {
        list($key, $value) = explode('=', $line, 2);
        $envConfig[trim($key)] = trim($value);
    }
}

// Configuración de conexión a la base de datos
$connectionOptions = array(
    "Database" => $envConfig['DB_DATABASE'],
    "Uid" => $envConfig['DB_USERNAME'],
    "PWD" => $envConfig['DB_PASSWORD']
);