<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dwes\ProyectoVideoclub\Model\Videoclub;

// Clean log file
$logFile = __DIR__ . '/../logs/videoclub.log';
if (file_exists($logFile)) {
    file_put_contents($logFile, '');
}

$vc = new Videoclub("Videoclub Test");

echo "Adding products...\n";
$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1); 
$vc->incluirDvd("Torrente", 4.5, "es","16:9"); 

echo "Adding partners...\n";
$vc->incluirSocio("Amancio Ortega"); 
$vc->incluirSocio("Pablo Picasso", 2); 

echo "Listing products...\n";
$vc->listarProductos();

echo "Listing partners...\n";
$vc->listarSocios();

echo "Renting products...\n";
$vc->alquilarSocioProducto(0, 0); // Amancio rents God of War

echo "Renting same product again (should fail/log warning)...\n";
$vc->alquilarSocioProducto(0, 0); 

echo "Returning product...\n";
$vc->devolverSocioProducto(0, 0);

echo "Returning product not rented (should fail/log info)...\n";
$vc->devolverSocioProducto(0, 0);

echo "\n--- LOG CONTENT ---\n";
echo file_get_contents($logFile);
