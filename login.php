<?php

//Lo primero que hacemos es crear unas constantes para los usuarios
const ADMIN_USER = "admin";
const ADMIN_PASS = "admin";

const USUARIO_USER = "usuario";
const USUARIO_PASS = "usuario";

//Ahora comprobamos que se ha enviado el formulario
if (isset($_POST["enviar"])) {

    //Asignamos a unas variables los datos que se han introducudo en el form
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    //Ahora comprobamos que recibimos ambos parámetros
    if (empty($usuario) || empty($password)) {

        $error = "Debes introducir un usuario y contraseña";
        include "index.php";

    } else {

        //Y ahora comprobamso que los datos que se han introducido coinciden con las constantes
        if (($usuario == ADMIN_USER && $password == ADMIN_PASS) || ($usuario == USUARIO_USER && $password == USUARIO_PASS)) {

            //Creamos la session y almacenamos el usuario en la sesión
            session_start();
            $_SESSION["usuario"] = $usuario;

            //Y cargamos la página principal
            include "main.php";

        } else {

            // i las credenciales no son válidas, se vuelven a pedir
            $error = "Usuario o contraseña no válidos!";
            include "index.php";
        }
    }
}
