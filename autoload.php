<?php
/**
 * Metodo para cargar automáticamente las clases ubicadas en la carpeta /app.
 */
spl_autoload_register(function ($nombreClase) {
    // Quitamos el namespace base
    $nombreClase = str_replace('Dwes\\ProyectoVideoclub\\', '', $nombreClase);

    // Convertimos namespace a ruta
    $rutaRelativa = str_replace('\\', '/', $nombreClase) . '.php';

    // Construimos la ruta completa (buscando en /app/)
    $ruta = __DIR__ . '/app/' . $rutaRelativa;

    if (file_exists($ruta)) {
        include_once $ruta;
    } else {
        echo "No se encontró el archivo: $ruta<br>";
    }
});
?>

