<?php
// Cargamos el autoloader de Composer
require_once(__DIR__ . '/../../vendor/autoload.php');

use Dwes\ProyectoVideoclub\Model\Cliente;
use Dwes\ProyectoVideoclub\Model\Juego;
use Dwes\ProyectoVideoclub\Model\Dvd;
use Dwes\ProyectoVideoclub\Model\CintaVideo;

session_start();

// Credenciales de admin
$ADMIN_USER = "admin";
$ADMIN_PASS = "admin";

// Comprobamos que se envió el formulario de login
if (isset($_POST['enviar'])) {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validamos que los campos no estén vacíos
    if (empty($usuario) || empty($password)) {
        $_SESSION['error'] = "Debes introducir un usuario y contraseña";
        header("Location: ../../public/index.php");
        exit;
    }

    // Inicializamos los datos de soportes si no existen en sesión
    if (!isset($_SESSION['soportesData'])) {
        $_SESSION['soportesData'] = [
            ['tipo' => 'Juego', 'titulo' => 'God of War', 'numero' => 1, 'precio' => 19.99, 'consola' => 'PS4', 'min' => 1, 'max' => 4],
            ['tipo' => 'Juego', 'titulo' => 'The Last of Us Part II', 'numero' => 2, 'precio' => 49.99, 'consola' => 'PS4', 'min' => 1, 'max' => 4],
            ['tipo' => 'Dvd', 'titulo' => 'Torrente', 'numero' => 3, 'precio' => 4.5, 'idiomas' => 'es', 'formato' => '16:9'],
            ['tipo' => 'Dvd', 'titulo' => 'Origen', 'numero' => 4, 'precio' => 4.5, 'idiomas' => 'es,en,fr', 'formato' => '16:9'],
            ['tipo' => 'Dvd', 'titulo' => 'El Imperio Contraataca', 'numero' => 5, 'precio' => 3, 'idiomas' => 'es,en', 'formato' => '16:9'],
            ['tipo' => 'CintaVideo', 'titulo' => 'Los cazafantasmas', 'numero' => 6, 'precio' => 3.5, 'duracion' => 107],
            ['tipo' => 'CintaVideo', 'titulo' => 'El nombre de la Rosa', 'numero' => 7, 'precio' => 1.5, 'duracion' => 140],
        ];
    }

    // Inicializamos los datos de clientes si no existen en sesión
    if (!isset($_SESSION['clientesData'])) {
        $_SESSION['clientesData'] = [
            ['numero' => 0, 'nombre' => 'Amancio Ortega', 'usuario' => 'amancio', 'password' => '1234', 'max' => 2, 'alquileres' => [2, 3]],
            ['numero' => 1, 'nombre' => 'Pablo Picasso', 'usuario' => 'pablo', 'password' => 'abcd', 'max' => 2, 'alquileres' => []],
        ];
    }

    $soportesData = $_SESSION['soportesData'];
    $clientesData = $_SESSION['clientesData'];

    // Login admin: guardamos sesión y redirigimos al panel admin
    if ($usuario === $ADMIN_USER && $password === $ADMIN_PASS) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['soportesData'] = $soportesData;
        $_SESSION['clientesData'] = $clientesData;
        header("Location: mainAdmin.php");
        exit;
    }

    // Login cliente: buscamos coincidencia y redirigimos a panel cliente
    foreach ($clientesData as $c) {
        if ($c['usuario'] === $usuario && $c['password'] === $password) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['clienteData'] = $c;
            $_SESSION['soportesData'] = $soportesData;
            header("Location: mainCliente.php");
            exit;
        }
    }

    // Credenciales no válidas: guardamos error y redirigimos
    $_SESSION['error'] = "Usuario o contraseña no válidos";
    header("Location: ../../public/index.php");
    exit;
}
