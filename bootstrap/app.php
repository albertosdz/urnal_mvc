<?php
/**
 * Archivo de bootstrap principal.
 * 
 * Carga las dependencias y configura la conexión a la base de datos,
 * además de establecer la conexión en el modelo base ActiveRecord.
 */

require __DIR__ . '/../vendor/autoload.php';

// Cargar variables de entorno si el archivo .env existe
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
} else {
    // Si no existe .env, intentamos continuar si hay variables de entorno ya definidas (por ejemplo, desde Render)
    if (!getenv('DB_HOST')) {
        if (php_sapi_name() !== 'cli') {
            echo '<h2>Error de Configuración</h2>';
            echo '<p>El archivo <code>.env</code> no existe y no se han detectado variables de entorno.</p>';
            echo '<p>Consulta el README.md para más información.</p>';
            exit;
        } else {
            echo "Error: No se encontró .env ni variables de entorno definidas.\n";
            exit(1);
        }
    }
}

require 'database.php';

// Conectarnos a la base de datos
use App\Domain\Models\ActiveRecord;
ActiveRecord::setDB($db);