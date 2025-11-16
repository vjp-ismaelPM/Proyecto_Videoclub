<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: mainAdmin.php");
    exit;
}

$usuarioOriginal = $_POST['usuario_original'] ?? '';
$nombre = trim($_POST['nombre'] ?? '');
$usuario = trim($_POST['usuario'] ?? '');
$password = trim($_POST['password'] ?? '');
$max = intval($_POST['max'] ?? 3);

// Validación básica
if ($nombre === '' || $usuario === '' || $password === '' || $max < 1) {
    header("Location: formUpdateCliente.php?usuario=" . urlencode($usuarioOriginal));
    exit;
}

// Buscar y actualizar cliente en la sesión
foreach ($_SESSION['clientesData'] as &$c) {
    if ($c['usuario'] === $usuarioOriginal) {
        $c['nombre'] = $nombre;
        $c['usuario'] = $usuario;
        $c['password'] = $password;
        $c['max'] = $max;
        break;
    }
}
unset($c);

header("Location: mainAdmin.php");
exit;
