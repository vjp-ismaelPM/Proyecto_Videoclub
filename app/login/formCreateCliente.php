<?php
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
body { font-family: sans-serif; background:#222; color:#f0f0f0; display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:100vh; }
h1 { color:#FFD700; margin-bottom:1rem; }
form { background:#333; padding:2rem; border-radius:8px; display:flex; flex-direction:column; gap:1rem; width:300px; }
input[type="text"], input[type="password"], input[type="number"] { padding:0.5rem; border-radius:4px; border:none; }
input[type="submit"] { background:#FFD700; color:#222; padding:0.5rem; border:none; border-radius:8px; cursor:pointer; }
input[type="submit"]:hover { background:#ffcd00; }
a { text-decoration:none; color:#222; background:#FFD700; padding:0.5rem 1rem; border-radius:8px; margin-top:1rem; display:inline-block;}
a:hover { background:#ffcd00; }
</style>
</head>
<body>

<h1>Crear Nuevo Cliente</h1>
<form action="createCliente.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="usuario" placeholder="Usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <input type="number" name="max" placeholder="Máx alquileres concurrentes" min="1" value="3" required>
    <input type="submit" value="Crear Cliente">
</form>

<a href="mainAdmin.php">Volver al panel</a>

</body>
</html>
