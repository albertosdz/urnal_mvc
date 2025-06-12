<?php
/**
 * Archivo de bootstrap principal.
 * 
 * Carga las dependencias y configura la conexión a la base de datos,
 * además de establecer la conexión en el modelo base ActiveRecord.
 */

require __DIR__ . '/../vendor/autoload.php';
require 'database.php';

// Conectarnos a la base de datos
use App\Domain\Models\ActiveRecord;
ActiveRecord::setDB($db);