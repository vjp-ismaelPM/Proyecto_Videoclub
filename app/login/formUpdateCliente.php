<?php
// Iniciamos sesión y cargamos el autoloader de Composer
session_start();
require_once(__DIR__ . '/../../vendor/autoload.php');

use Dwes\ProyectoVideoclub\Model\Cliente;

// Comprobamos que se reciba un usuario por GET, si no, redirigimos al panel admin
if (!isset($_GET['usuario'])) {
    header("Location: mainAdmin.php");
    exit;
}

$usuario = $_GET['usuario'];

// Buscamos el cliente correspondiente en los datos almacenados en sesión
$cliente = null;
foreach ($_SESSION['clientesData'] as $c) {
    if ($c['usuario'] === $usuario) {
        $cliente = $c;
        break;
    }
}

// Si no se encuentra el cliente, mostramos mensaje y detenemos ejecución
if (!$cliente) {
    echo "<p>Cliente no encontrado</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar Cliente</title>
    <link rel="stylesheet" href="css/updateCliente.css">
</head>

<body>

    <!-- Título principal -->
    <h1>Actualizar Cliente</h1>

    <!-- Formulario para editar los datos de un cliente existente -->
    <form action="updateCliente.php" method="post">
        <!-- Campo oculto para pasar el usuario original y localizar el registro -->
        <input type="hidden" name="usuario_original" value="<?= htmlspecialchars($cliente['usuario']); ?>">

        <!-- Campos de entrada con los datos actuales del cliente -->
        <label>Nombre:
            <input type="text" name="nombre" value="<?= htmlspecialchars($cliente['nombre']); ?>" required>
        </label>

        <label>Usuario:
            <input type="text" name="usuario" value="<?= htmlspecialchars($cliente['usuario']); ?>" required>
        </label>

        <label>Contraseña:
            <input type="password" name="password" value="<?= htmlspecialchars($cliente['password']); ?>" required>
        </label>

        <label>Máx Alquileres Concurrentes:
            <input type="number" name="max" value="<?= htmlspecialchars($cliente['max']); ?>" min="1" required>
        </label>

        <!-- Botón para enviar los cambios -->
        <input type="submit" value="Actualizar Cliente">
    </form>

    <!-- Enlace para volver al panel admin -->
    <a href="mainAdmin.php">Volver</a>

</body>

</html>