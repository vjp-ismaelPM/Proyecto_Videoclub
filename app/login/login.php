<?php
session_start();

// Constantes de usuario
const ADMIN_USER = "admin";
const ADMIN_PASS = "admin";
const USUARIO_USER = "usuario";
const USUARIO_PASS = "usuario";

if (isset($_POST["enviar"])) {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    if (empty($usuario) || empty($password)) {
        $_SESSION['error'] = "Debes introducir un usuario y contraseña";
        header("Location: ../../public/index.php");
        exit;
    }

    if (
        ($usuario == ADMIN_USER && $password == ADMIN_PASS) ||
        ($usuario == USUARIO_USER && $password == USUARIO_PASS)
    ) {
        $_SESSION["usuario"] = $usuario;
        header("Location: main.php");
        exit;
    } else {
        $_SESSION['error'] = "Usuario o contraseña no válidos";
        header("Location: ../../public/index.php");
        exit;
    }
}
