<?php
/**
 * Metodo para cargar automáticamente las clases ubicadas en la carpeta /app.
 */
spl_autoload_register(function ($nombreClase) {
    $nombreClase = str_replace('Dwes\\ProyectoVideoclub\\', '', $nombreClase);

    $ruta = __DIR__ . '/app/' . $nombreClase . '.php';

    if (file_exists($ruta)) {
        include_once $ruta;
    } else {
        echo "No se encontró el archivo: $ruta<br>";
    }
});
?>

