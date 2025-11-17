<?php
// Iniciamos sesión y cargamos la clase Cliente
session_start();
require_once(__DIR__ . '/../model/Cliente.php');

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
    <style>
        /* Estilos generales para formulario y página */
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