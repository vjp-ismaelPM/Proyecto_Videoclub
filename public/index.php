<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Ismael Pablos Miguel">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videoclub - Login</title>
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.85)), url("../img/SalaDeCine3.png") no-repeat center 0 fixed;
            background-size: cover;
            color: #f0f0f0;
        }

        fieldset {
            border: none;
            background: rgba(0, 0, 0, 0.75);
            border-radius: 15px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.6);
            padding: 2rem;
            width: 320px;
            backdrop-filter: blur(6px);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        legend {
            font-size: 1.8rem;
            text-align: center;
            color: #FFD700;
            font-weight: bold;
            text-shadow: 0 0 6px #FFD700;
            margin-bottom: 0.5rem;
        }

        .fila {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        label {
            font-size: 1rem;
        }

        input[type="text"],
        input[type="password"] {
            padding: 0.6rem;
            border: 1px solid #444;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #1a1a1a;
            color: #f0f0f0;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #FFD700;
            outline: none;
            box-shadow: 0 0 5px #FFD700;
        }

        input[type="submit"] {
            padding: 0.7rem;
            background-color: #FFD700;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            color: #1a1a1a;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #ffcd00;
            transform: scale(1.03);
        }

        .error {
            color: #ff4d4f;
            background-color: rgba(255, 0, 0, 0.2);
            border: 1px solid #ff4d4f;
            padding: 0.5rem;
            border-radius: 6px;
            text-align: center;
            font-weight: bold;
        }

        @media (max-width: 480px) {
            fieldset {
                width: 90%;
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <form action="../app/login/login.php" method="post">
        <fieldset>
            <legend>Acceso al Videoclub</legend>

            <?php
            // Mostrar mensaje de error si existe
            if (isset($_SESSION['error'])) {
                echo '<div class="error">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>

            <div class="fila">
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" maxlength="50" />
            </div>

            <div class="fila">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" maxlength="50" />
            </div>

            <div class="fila">
                <input type="submit" name="enviar" value="Entrar" />
            </div>
        </fieldset>
    </form>

</body>

</html>
