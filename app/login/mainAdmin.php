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

// Verificación de acceso: solo admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: ../../public/index.php");
    exit;
}

// Reconstrucción de objetos Soporte desde datos en sesión
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

// Reconstrucción de objetos Cliente y sus alquileres
$clientes = [];
foreach ($_SESSION['clientesData'] as $c) {
    $alquileres = [];
    foreach ($c['alquileres'] as $id) {
        foreach ($soportes as $s) {
            if ($s->getNumero() === $id) $alquileres[] = $s;
        }
    }
    $clientes[] = new Cliente($c['nombre'], $c['usuario'], $c['password'], 0, $alquileres, count($alquileres), $c['max']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Videoclub - Admin</title>
    <style>
        /* Estilos básicos para tablas, enlaces y cuerpo */
    </style>
</head>

<body>
    <!-- Cabecera con saludo -->
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']); ?>!</h1>

    <!-- Sección de clientes -->
    <h2>Listado de Clientes</h2>
    <a href="formCreateCliente.php">Añadir Nuevo Cliente</a>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Núm Soportes Alq</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($clientes as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c->getNombre()); ?></td>
                <td><?= htmlspecialchars($c->getUsuario()); ?></td>
                <td><?= $c->getNumSoportesAlquilados(); ?></td>
                <td>
                    <!-- Acciones de edición y eliminación -->
                    <a href="formUpdateCliente.php?usuario=<?= urlencode($c->getUsuario()); ?>">Editar</a>
                    <a href="removeCliente.php?usuario=<?= urlencode($c->getUsuario()); ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Sección de soportes -->
    <h2>Listado de Soportes</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Plataforma / Info</th>
        </tr>
        <?php foreach ($soportes as $s): ?>
            <tr>
                <td><?= $s->getNumero(); ?></td>
                <td><?= htmlspecialchars($s->getTitulo()); ?></td>
                <td><?= $s->getPrecio(); ?> €</td>
                <td>
                    <!-- Información específica según tipo de soporte -->
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