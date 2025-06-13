<?php
/**
 * Configuración general de la aplicación.
 *
 * Este archivo contiene la configuración principal de la aplicación,
 * incluyendo parámetros como el entorno, la base de datos y el correo electrónico.
 * Utiliza variables de entorno para una configuración segura y flexible.
 *
 * @package Config
 */

return [
    'name' => getenv('APP_NAME') ?: 'Urnal',
    'env' => getenv('APP_ENV') ?: 'development',
    'debug' => filter_var(getenv('APP_DEBUG') ?: true, FILTER_VALIDATE_BOOLEAN),
    'url' => getenv('APP_URL') ?: 'http://localhost',
    'timezone' => getenv('APP_TIMEZONE') ?: 'Europe/Madrid',
    
    // Database configuration
    'database' => [
        'host' => getenv('DB_HOST') ?: 'localhost',
        'port' => getenv('DB_PORT') ?: '3306',
        'database' => getenv('DB_DATABASE') ?: 'urnal',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
        'charset' => 'utf8mb4',
    ],
    
    // Email configuration  
    'mail' => [
        'host' => getenv('MAIL_HOST') ?: 'smtp.gmail.com',
        'port' => getenv('MAIL_PORT') ?: 587,
        'username' => getenv('MAIL_USERNAME') ?: '',
        'password' => getenv('MAIL_PASSWORD') ?: '',
        'encryption' => 'tls',
    ],
];

