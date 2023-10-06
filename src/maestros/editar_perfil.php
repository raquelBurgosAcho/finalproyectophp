<?php
include "../config/conexiondatabs.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["email"])) {
    // Obtener el email del maestro desde la URL
    $email_maestro = $_GET["email"];

    // Conectar a la base de datos (reemplaza con tus propios datos de conexión)

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Verificar si se ha proporcionado un email de maestro válido a través de la URL
    if (isset($_GET["email"])) {
        $email_maestro = $_GET["email"];

        // Consulta SQL para obtener los datos del maestro con el email proporcionado
        $sql = "SELECT id, email, contrasena, nombre, direccion, fecha_nacimiento FROM maestros WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Vincular el parámetro con el valor del email del maestro
            $stmt->bind_param("s", $email_maestro);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener el resultado de la consulta
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // Obtener los datos del maestro
                $row = $result->fetch_assoc();
                $id_maestro = $row["id"];
                $email = $row["email"];
                $contrasena = $row["contrasena"];
                $nombre = $row["nombre"];
                $direccion = $row["direccion"];
                $fecha_nacimiento = $row["fecha_nacimiento"];
            } else {
                echo "No se encontró el maestro con el email proporcionado.";
                exit();
            }

            // Cerrar la consulta preparada
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
            exit();
        }
    } else {
        echo "Email de maestro no proporcionado.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad XYZ</title>
    <!-- Linking Google font link for icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <!-- Link your external CSS file -->
    <link rel="stylesheet" href="index.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link href="/dist/output.css" rel="stylesheet">
    <script src="/js/main_menu.js" defer></script>
    <script src="/js/flecha.js" defer></script>
    
    <style>
    

    .table-container {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    
    form {
        width: 70%;
        margin: 0 auto;
        padding: 10px;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: #3498db;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #2980b9;
    }
    </style>

</head>

<body class="font-sans">
<header class="flex items-center justify-between" style="background-color: #808080;">
        <!-- Barra de navegación izquierda -->
        <div    class="flex items-center space-x-3">
            <span  id="menu-icon"
                class="material-symbols-outlined text-gray-600 text-lg cursor-pointer hover:text-gray-800" href="../maestros/vista_maestro.php"> Menu</span>
            <h1 class="text-white text-lg font-medium" > Home</h1>
        </div>
        <div class="flex space-x-2 items-center ml-auto mr-4">
            <span id="flecha" class="material-symbols-outlined cursor-pointer">chevron_right</span>
            <div id="modal" class="absolute top-12 right-4 bg-white shadow-md rounded-md hidden">
                <form action="/actions/cerrar_sesion.php">
                    <div class="flex items-center space-x-3 px-4 py-3 text-red-500">
                        <span class="material-symbols-outlined cursor-none">door_open</span>
                        <button type="submit">
                            <p>Logout</p>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-white text-lg font-medium"> Maestro </div>
    </header>
    </header>
    <aside class="w-1/5 bg-gray-900 text-white fixed h-full overflow-auto">
    <div class="py-8 text-center">
                <!-- Aplicar estilos a la imagen -->
                <img src="/img/logo.jpg" alt="logo" class="circular-image w-20 h-20 mx-auto rounded-full">
                <!-- Aplicar estilos al texto de la Universidad -->
                <p class="universidad-text mt-2 text-lg font-bold text-silver">Universidad</p>
            </div>
            <ul class="mt-6 space-y-4">
                <li class="border-t border-b border-gray-700 py-4">
                    <h4 class="py-2 px-4">Maestro</h4>
                </li>
           
            <li class="separator-horizontal"></li>
            <li>
                <h1 class="text-[#9c9fa1] w-[100%] flex justify-center font-semibold mb-4">MENU MAESTRO</h1>
            </li>


            <li>
                <span class="material-symbols-outlined">group</span>
                <a >Maestros</a>
            </li>

        </ul>
    </aside>
    <div class="main-content" style="margin-left: 20%; padding: 20px;">
        <div class="p-5 h-[80%] flex flex-col gap-6 mt-[70px]">
            <div class="flex justify-between">



            </div>



            <body>


                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Editar Estudiante</title>
                </head>

                <body>
                    <h1>Editar Perfil de Maestro</h1>
                    <form action="edit_profile_maestro.php" method="POST">
                        <input type="hidden" name="id_maestro" value="<?php echo $id_maestro; ?>">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required><br>

                        <label for="contrasena">Contraseña:</label>
                        <input type="password" name="contrasena" id="contrasena" value="<?php echo $contrasena; ?>"
                            required><br>

                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required><br>

                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" value="<?php echo $direccion; ?>"><br>

                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                            value="<?php echo $fecha_nacimiento; ?>"><br>

                        <input type="submit" value="Guardar Cambios">
                    </form>
                </body>

        </div>
    </div>
    </div>
    </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>

</html>