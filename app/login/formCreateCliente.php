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
    <style>
        /* Estilos generales para el formulario y la página */
        body {
            font-family: sans-serif;
            background: #222;
            color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h1,
        h2 {
            color: #FFD700;
        }

        form {
            background: #333;
            padding: 2rem;
            border-radius: 8px;
            width: 300px;
        }

        label {
            display: block;
            margin-top: 1rem;
        }

        input[type=text],
        input[type=password],
        input[type=number] {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.3rem;
            border-radius: 4px;
            border: none;
        }

        input[type=submit],
        a {
            margin-top: 1rem;
            text-decoration: none;
            color: #222;
            background: #FFD700;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            display: inline-block;
        }

        input[type=submit]:hover,
        a:hover {
            background: #ffcd00;
        }
    </style>
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