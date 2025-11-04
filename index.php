<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Ismael Pablos Miguel">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videoclub - Login</title>
    <style>
        /* Estilo general */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.85)), url("img/SalaDeCine3.png") no-repeat center 0px fixed;
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
        }

        legend {
            font-size: 1.8rem;
            text-align: center;
            color: #FFD700;
            font-weight: bold;
            text-shadow: 0 0 6px #FFD700;
            margin-bottom: 1rem;
        }

        .login-container::before {
            font-size: 3rem;
            display: block;
            text-align: center;
            margin-bottom: 0.5rem;
            animation: pulse 2s infinite ease-in-out;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.8;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.1);
            }
        }

        .fila {
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            font-size: 1rem;
            margin-bottom: 0.4rem;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
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
            width: 100%;
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

        /* Responsivo */
        @media (max-width: 480px) {
            fieldset {
                width: 90%;
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <form action="login.php" method="post">
            <fieldset>
                <legend>Acceso al Videoclub</legend>

                <div class="fila">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" maxlength="50" required />
                </div>

                <div class="fila">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" maxlength="50" required />
                </div>

                <div class="fila">
                    <input type="submit" name="enviar" value="Entrar" />
                </div>

            </fieldset>
        </form>
    </div>

</body>

</html>