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
    'name' => 'Urnal',
    'env' => 'development',
    'debug' => true,
    'url' => 'http://localhost',
    'timezone' => 'Europe/Madrid',
    
    // Database configuration
    'database' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'port' => $_ENV['DB_PORT'] ?? '3306',
        'database' => $_ENV['DB_DATABASE'] ?? 'urnal',
        'username' => $_ENV['DB_USERNAME'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? '',
        'charset' => 'utf8mb4',
    ],
    
    // Email configuration  
    'mail' => [
        'host' => $_ENV['MAIL_HOST'] ?? 'smtp.gmail.com',
        'port' => $_ENV['MAIL_PORT'] ?? 587,
        'username' => $_ENV['MAIL_USERNAME'] ?? '',
        'password' => $_ENV['MAIL_PASSWORD'] ?? '',
        'encryption' => 'tls',
    ],
];

