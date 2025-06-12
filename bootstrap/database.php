<?php
/**
 * Este archivo se encarga de establecer la conexión con la base de datos MySQL usando mysqli.
 * Muestra errores de conexión y detiene la ejecución si no se conecta correctamente.
 */

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = mysqli_connect('localhost', 'root', '', 'urnal_mvc');

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
