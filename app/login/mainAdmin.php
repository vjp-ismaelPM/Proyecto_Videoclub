<?php
session_start();

// Comprobar si es admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: ../../public/index.php");
    exit;
}

$soportes = $_SESSION['soportes'] ?? [];
$clientes = $_SESSION['clientes'] ?? [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Videoclub - Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.85)), url("../../public/img/SalaDeCine3.png") no-repeat center fixed;
            background-size: cover;
            color: #f0f0f0;
            padding: 2rem;
        }

        h1 {
            color: #FFD700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 0.5rem;
            text-align: left;
        }

        th {
            background-color: #333;
        }

        tr:nth-child(even) {
            background-color: #222;
        }

        a {
            text-decoration: none;
            color: #1a1a1a;
            background: #FFD700;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: bold;
        }

        a:hover {
            background: #ffcd00;
        }
    </style>
</head>

<body>

    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>

    <h2>Listado de Clientes</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Alquileres Máx</th>
        </tr>
        <?php foreach ($clientes as $c): ?>
            <tr>
                <td><?= $c['id']; ?></td>
                <td><?= htmlspecialchars($c['nombre']); ?></td>
                <td><?= htmlspecialchars($c['usuario']); ?></td>
                <td><?= $c['alquileresMax']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


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
                <td><?php echo $s['id']; ?></td>
                <td><?php echo htmlspecialchars($s['nombre']); ?></td>
                <td><?php echo $s['precio']; ?> €</td>
                <td>
                    <?php
                    if (isset($s['plataforma'])) echo $s['plataforma'];
                    elseif (isset($s['idiomas'])) echo "Idiomas: {$s['idiomas']}, Formato: {$s['formato']}";
                    elseif (isset($s['duracion'])) echo "Duración: {$s['duracion']} min";
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="logout.php">Cerrar sesión</a>

</body>

</html>