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
    // Si no existe .env, mostrar mensaje de error útil
    if (php_sapi_name() !== 'cli') {
        echo '<h2>Error de Configuración</h2>';
        echo '<p>El archivo <code>.env</code> no existe. Para configurar la aplicación:</p>';
        echo '<ol>';
        echo '<li>Copia el archivo <code>.env.example</code> y renómbralo a <code>.env</code></li>';
        echo '<li>Configura las variables de entorno según tu ambiente</li>';
        echo '<li>Recarga la página</li>';
        echo '</ol>';
        echo '<p>Consulta el README.md para más información.</p>';
        exit;
    } else {
        echo "Error: El archivo .env no existe. Copia .env.example a .env y configura las variables.\n";
        exit(1);
    }
}

require 'database.php';

// Conectarnos a la base de datos
use App\Domain\Models\ActiveRecord;
ActiveRecord::setDB($db);