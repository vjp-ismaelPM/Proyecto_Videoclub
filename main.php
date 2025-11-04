<?php

if (!isset($_SESSION)) {
    session_start();
}

// Si no hay sesión, redirigimos al login
if (!isset($_SESSION["usuario"])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}

$usuario = $_SESSION["usuario"];
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido - Videoclub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #101820;
            color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        a {
            color: #FFD700;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1> ¡Bienvenido, <?php echo htmlspecialchars($usuario); ?>!</h1>
    <p>Has accedido correctamente al sistema del Videoclub.</p>
    <a href="logout.php">Cerrar sesión</a>

</body>
</html>