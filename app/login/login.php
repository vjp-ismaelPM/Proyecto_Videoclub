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

    if ($usuario == ADMIN_USER && $password == ADMIN_PASS) {
        // Usuario admin: cargamos arrays de prueba
        $_SESSION["usuario"] = $usuario;

        $_SESSION['soportes'] = [
            ['id'=>1,'nombre'=>'God of War','precio'=>19.99,'plataforma'=>'PS4'],
            ['id'=>2,'nombre'=>'The Last of Us Part II','precio'=>49.99,'plataforma'=>'PS4'],
            ['id'=>3,'nombre'=>'Torrente','precio'=>4.5,'idiomas'=>'es','formato'=>'16:9'],
            ['id'=>4,'nombre'=>'Origen','precio'=>4.5,'idiomas'=>'es,en,fr','formato'=>'16:9'],
            ['id'=>5,'nombre'=>'El Imperio Contraataca','precio'=>3,'idiomas'=>'es,en','formato'=>'16:9'],
            ['id'=>6,'nombre'=>'Los cazafantasmas','precio'=>3.5,'duracion'=>107],
            ['id'=>7,'nombre'=>'El nombre de la Rosa','precio'=>1.5,'duracion'=>140]
        ];

        $_SESSION['clientes'] = [
            ['id'=>1,'nombre'=>'Amancio Ortega','alquileresMax'=>2],
            ['id'=>2,'nombre'=>'Pablo Picasso','alquileresMax'=>2]
        ];

        header("Location: mainAdmin.php");
        exit;

    } elseif ($usuario == USUARIO_USER && $password == USUARIO_PASS) {
        // Usuario normal
        $_SESSION["usuario"] = $usuario;
        header("Location: main.php");
        exit;
    } else {
        $_SESSION['error'] = "Usuario o contraseña no válidos";
        header("Location: ../../public/index.php");
        exit;
    }
}
?>