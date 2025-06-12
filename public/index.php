<?php
/**
 * Punto de entrada principal para la aplicación web.
 * 
 * Carga la configuración inicial (bootstrap) y las rutas de la aplicación.
 */
require_once __DIR__ . '/../bootstrap/app.php';

// Cargar las rutas
require_once __DIR__ . '/../routes/web.php';
