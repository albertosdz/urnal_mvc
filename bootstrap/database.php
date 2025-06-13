<?php
/**
 * Este archivo se encarga de establecer la conexión con la base de datos MySQL usando mysqli.
 * Muestra errores de conexión y detiene la ejecución si no se conecta correctamente.
 * Utiliza variables de entorno para la configuración de la base de datos.
 */

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Obtener configuración de base de datos desde variables de entorno
$host = $_ENV['DB_HOST'] ?? 'localhost';
$username = $_ENV['DB_USERNAME'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '';
$database = $_ENV['DB_DATABASE'] ?? 'urnal_mvc';
$port = $_ENV['DB_PORT'] ?? 3306;

$db = mysqli_connect($host, $username, $password, $database, $port);

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
