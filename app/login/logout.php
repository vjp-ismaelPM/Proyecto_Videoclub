<?php
// Iniciamos sesión si no está iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Eliminamos las variables de sesión del usuario
unset($_SESSION['usuario']);
unset($_SESSION['password']);

// Redirigimos al inicio de la aplicación
header("Location: ../../public/index.php");
exit;
