<?php
// Iniciamos la sesión y comprobamos que solo el admin puede acceder
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: ../../public/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Cliente - Videoclub</title>
    <link rel="stylesheet" href="css/createCliente.css">
</head>

<body>

    <!-- Título principal -->
    <h1>Crear Nuevo Cliente</h1>

    <!-- Formulario de creación de cliente -->
    <form action="createCliente.php" method="POST">
        <!-- Campos de entrada para nombre, usuario, contraseña y máximo de alquileres -->
        <label>Nombre:
            <input type="text" name="nombre" placeholder="Nombre" required>
        </label>

        <label>Usuario:
            <input type="text" name="usuario" placeholder="Usuario" required>
        </label>

        <label>Contraseña:
            <input type="password" name="password" placeholder="Contraseña" required>
        </label>

        <label>Máx Alquileres Concurrentes:
            <input type="number" name="max" placeholder="Máx alquileres concurrentes" min="1" value="3" required>
        </label>

        <!-- Botón para enviar el formulario -->
        <input type="submit" value="Crear Cliente">
    </form>

    <!-- Enlace para volver al panel de administración -->
    <a href="mainAdmin.php">Volver al panel</a>

</body>

</html>