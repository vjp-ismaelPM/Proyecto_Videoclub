<?php
session_start();

// Comprobar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../public/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videoclub - Principal</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.85)), url("../../public/img/SalaDeCine3.png") no-repeat center fixed;
            background-size: cover;
            color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h1 {
            font-size: 2rem;
            color: #FFD700;
            text-shadow: 0 0 6px #FFD700;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        a {
            text-decoration: none;
            color: #1a1a1a;
            background-color: #FFD700;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        a:hover {
            background-color: #ffcd00;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>
    <p>Has iniciado sesión correctamente en el Videoclub.</p>
    <a href="logout.php">Cerrar sesión</a>

</body>

</html>
