<?php
session_start();

// Solo admin puede acceder
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: ../../public/index.php");
    exit;
}

// Comprobamos si vienen los datos por POST
$nombre = trim($_POST['nombre'] ?? '');
$usuario = trim($_POST['usuario'] ?? '');
$password = trim($_POST['password'] ?? '');
$maxAlquileres = intval($_POST['maxAlquileres'] ?? 3);

// Validación básica
if ($nombre === '' || $usuario === '' || $password === '' || $maxAlquileres < 1) {
    $_SESSION['error'] = "Todos los campos son obligatorios y el máximo de alquileres debe ser al menos 1.";
    header("Location: formCreateCliente.php");
    exit;
}

// Recuperamos los clientes desde la sesión
$clientesData = $_SESSION['clientesData'] ?? [];

// Comprobamos que el usuario no exista ya
foreach ($clientesData as $c) {
    if ($c['usuario'] === $usuario) {
        $_SESSION['error'] = "El usuario ya existe, elige otro.";
        header("Location: formCreateCliente.php");
        exit;
    }
}

// Generamos el nuevo ID del cliente
$numero = count($clientesData);

// Creamos el cliente
$nuevoCliente = [
    'nombre' => $nombre,
    'usuario' => $usuario,
    'password' => $password,
    'max' => $maxAlquileres,
    'alquileres' => []
];

// Añadimos a la sesión
$clientesData[] = $nuevoCliente;
$_SESSION['clientesData'] = $clientesData;

// Redirigimos al panel admin
header("Location: mainAdmin.php");
exit;
