<?php 

require __DIR__ . '/../vendor/autoload.php';
require 'database.php';

// Conectarnos a la base de datos
use App\Domain\Models\ActiveRecord;
ActiveRecord::setDB($db);
