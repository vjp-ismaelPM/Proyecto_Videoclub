<?php
session_start();

// Solo admin puede eliminar
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: ../../public/index.php");
    exit;
}

// Comprobamos que se pase el usuario
if (!isset($_GET['usuario'])) {
    header("Location: mainAdmin.php");
    exit;
}

$usuario = $_GET['usuario'];

// Recorremos los clientes y eliminamos el correspondiente
if (isset($_SESSION['clientesData'])) {
    foreach ($_SESSION['clientesData'] as $key => $cliente) {
        if ($cliente['usuario'] === $usuario) {
            unset($_SESSION['clientesData'][$key]);
            // Reindexamos para evitar huecos
            $_SESSION['clientesData'] = array_values($_SESSION['clientesData']);
            break;
        }
    }
}

// Volvemos al listado de clientes
header("Location: mainAdmin.php");
exit;
?>
