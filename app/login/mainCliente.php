<?php
// Incluimos las clases necesarias
require_once(__DIR__ . '/../model/Cliente.php');
require_once(__DIR__ . '/../model/Juego.php');
require_once(__DIR__ . '/../model/Dvd.php');
require_once(__DIR__ . '/../model/CintaVideo.php');

use Dwes\ProyectoVideoclub\Model\Cliente;
use Dwes\ProyectoVideoclub\Model\Juego;
use Dwes\ProyectoVideoclub\Model\Dvd;
use Dwes\ProyectoVideoclub\Model\CintaVideo;

session_start();

// Comprobamos que el cliente haya iniciado sesión
if (!isset($_SESSION['clienteData'])) {
    header("Location: ../../public/index.php");
    exit;
}

// Reconstruimos los objetos Soporte desde la sesión
$soportes = [];
foreach ($_SESSION['soportesData'] as $s) {
    switch ($s['tipo']) {
        case 'Juego':
            $soportes[] = new Juego($s['titulo'], $s['numero'], $s['precio'], $s['consola'], $s['min'], $s['max']);
            break;
        case 'Dvd':
            $soportes[] = new Dvd($s['titulo'], $s['numero'], $s['precio'], $s['idiomas'], $s['formato']);
            break;
        case 'CintaVideo':
            $soportes[] = new CintaVideo($s['titulo'], $s['numero'], $s['precio'], $s['duracion']);
            break;
    }
}

// Reconstruimos el objeto Cliente con sus alquileres
$cData = $_SESSION['clienteData'];
$alquileres = [];
foreach ($cData['alquileres'] as $id) {
    foreach ($soportes as $s) {
        if ($s->getNumero() === $id) $alquileres[] = $s;
    }
}
$cliente = new Cliente($cData['nombre'], $cData['usuario'], $cData['password'], 0, $alquileres, count($alquileres), $cData['max']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Videoclub - Cliente</title>
    <style>
        /* Estilos básicos para tablas, enlaces y cuerpo */
    </style>
</head>

<body>
    <!-- Cabecera con saludo -->
    <h1>Bienvenido, <?= htmlspecialchars($cliente->getNombre()); ?>!</h1>

    <!-- Sección de alquileres del cliente -->
    <h2>Mis Alquileres</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Plataforma / Info</th>
        </tr>
        <?php foreach ($cliente->getSoportesAlquilados() as $s): ?>
            <tr>
                <td><?= $s->getNumero(); ?></td>
                <td><?= htmlspecialchars($s->getTitulo()); ?></td>
                <td><?= $s->getPrecio(); ?> €</td>
                <td>
                    <!-- Información según tipo de soporte -->
                    <?php
                    if ($s instanceof Juego) echo "Consola: " . $s->getConsola() . " (" . $s->getMinJugadores() . "-" . $s->getMaxJugadores() . " jugadores)";
                    elseif ($s instanceof Dvd) echo "Idiomas: " . $s->getIdiomas() . ", Formato: " . $s->getFormato();
                    elseif ($s instanceof CintaVideo) echo "Duración: " . $s->getDuracion() . " min";
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Enlace de cierre de sesión -->
    <a href="logout.php">Cerrar sesión</a>
</body>

</html>