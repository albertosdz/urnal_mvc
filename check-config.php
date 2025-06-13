#!/usr/bin/env php
<?php
/**
 * Script para verificar que la configuración del .env funciona correctamente
 */

require_once __DIR__ . '/bootstrap/app.php';

echo "\n🔍 Verificando configuración del proyecto Urnal...\n\n";

// Verificar que el archivo .env existe
if (!file_exists(__DIR__ . '/.env')) {
    echo "❌ Error: El archivo .env no existe.\n";
    echo "   Copia .env.example a .env y configura las variables.\n\n";
    exit(1);
}

echo "✅ Archivo .env encontrado\n";

// Verificar variables de entorno esenciales
$requiredVars = [
    'DB_HOST',
    'DB_DATABASE', 
    'DB_USERNAME',
    'MAIL_HOST',
    'MAIL_USERNAME',
    'APP_NAME',
    'APP_URL'
];

$missing = [];
foreach ($requiredVars as $var) {
    if (!isset($_ENV[$var]) || empty($_ENV[$var])) {
        $missing[] = $var;
    }
}

if (!empty($missing)) {
    echo "❌ Variables de entorno faltantes o vacías:\n";
    foreach ($missing as $var) {
        echo "   - $var\n";
    }
    echo "\n";
    exit(1);
}

echo "✅ Variables de entorno esenciales configuradas\n";

// Verificar configuración de base de datos
echo "\n💾 Verificando conexión a base de datos...\n";
try {
    $host = env('DB_HOST');
    $username = env('DB_USERNAME');
    $password = env('DB_PASSWORD', '');
    $database = env('DB_DATABASE');
    $port = env('DB_PORT', 3306);
    
    $connection = new mysqli($host, $username, $password, $database, $port);
    
    if ($connection->connect_error) {
        echo "❌ Error de conexión: " . $connection->connect_error . "\n";
        exit(1);
    }
    
    echo "✅ Conexión a base de datos exitosa\n";
    $connection->close();
    
} catch (Exception $e) {
    echo "❌ Error al conectar con la base de datos: " . $e->getMessage() . "\n";
    exit(1);
}

// Verificar configuración usando helpers
echo "\n⚙️ Verificando helpers de configuración...\n";

try {
    $appName = config('name');
    $dbHost = config('database.host');
    $mailHost = config('mail.host');
    
    echo "✅ Helper config() funciona correctamente\n";
    echo "   - App Name: $appName\n";
    echo "   - DB Host: $dbHost\n";
    echo "   - Mail Host: $mailHost\n";
    
} catch (Exception $e) {
    echo "❌ Error en helpers de configuración: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n🎉 ¡Configuración verificada exitosamente!\n";
echo "Tu aplicación Urnal está lista para funcionar.\n\n";

echo "Para iniciar el servidor de desarrollo ejecuta:\n";
echo "php -S localhost:3000 -t public\n\n";

