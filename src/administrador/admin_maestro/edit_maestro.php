<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad XYZ</title>
    <!-- Linking Google font link for icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <!-- Link your external CSS file -->
    <link rel="stylesheet" href="index.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link href="/dist/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
        <div class="flex items-center space-x-3">
            <span id="menu-icon"
                class="material-symbols-outlined text-gray-600 text-lg cursor-pointer hover:text-gray-800">menu</span>
            <h1 class="text-white text-lg font-medium">Home</h1>
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
        <div class="text-white text-lg font-medium">Administrador</div>
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
                    <h4 class="py-2 px-4">Admin</h4>
                    <p>Administrador</p>
                </li>
           
            <li class="separator-horizontal"></li>
            <li>
                <h1 class="text-[#9c9fa1] w-[100%] flex justify-center font-semibold mb-4">MENU ADMINISTRACION</h1>
            </li>
            <li>
                <span class="material-symbols-outlined">person</span>
                <a href="#">Permiso</a>
            </li>
            <li>
                <span class="material-symbols-outlined">group</span>
                <a href="admin_maestro/crud_maestros.php">Maestros</a>
            </li>
            <li>
                <span class="material-symbols-outlined">ambient_screen</span>
                <a href="../admin_estudiantes/crud_alumnos.php">Alumnos</a>
            </li>
            <li>
                <span class="material-symbols-outlined">pacemaker</span>
                <a href="../clases/clases_vista.php">Clases</a>
            </li>
        </ul>
    </aside>
    <div class="main-content" style="margin-left: 20%; padding: 20px;">
        <div class="p-5 h-[80%] flex flex-col gap-6 mt-[70px]">
            <div class="flex justify-between">
                <h1 class="text-2xl font-medium text-gray-700">Lista de Alumnos</h1>

                <div class="flex gap-1">
                    <a href="./vAdmin.php">
                        <p class="text-blue-500">Home</p>
                    </a>/ <p>Alumno</p>
                </div>
            </div>

            <?php
            // Conectar a la base de datos (reemplaza con tus propios datos de conexión)
            include "../../config/conexiondatabs.php";

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Error de conexión a la base de datos: " . $conn->connect_error);
            }

            // Verificar si se ha proporcionado un ID de maestro válido a través de la URL
            if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
                $id_maestro = $_GET["id"];

                // Consulta SQL para obtener los datos del maestro con el ID proporcionado
                $sql = "SELECT id, nombre, email, direccion, fecha_nacimiento, clase_asignada FROM maestros WHERE id = ?";
                $stmt = $conn->prepare($sql);

                if ($stmt) {
                    // Vincular el parámetro con el valor del ID del maestro
                    $stmt->bind_param("i", $id_maestro);

                    // Ejecutar la consulta
                    $stmt->execute();

                    // Obtener el resultado de la consulta
                    $result = $stmt->get_result();

                    if ($result->num_rows == 1) {
                        // Obtener los datos del maestro
                        $row = $result->fetch_assoc();
                        $nombre = $row["nombre"];
                        $email = $row["email"];
                        $direccion = $row["direccion"];
                        $fecha_nacimiento = $row["fecha_nacimiento"];
                        $clase_asignada = $row["clase_asignada"];
                    } else {
                        echo "No se encontró el maestro con el ID proporcionado.";
                        exit();
                    }

                    // Cerrar la consulta preparada
                    $stmt->close();
                } else {
                    echo "Error en la preparación de la consulta: " . $conn->error;
                    exit();
                }
            } else {
                echo "ID de maestro no proporcionado.";
                exit();
            }
            ?>

            <body>


                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Editar Estudiante</title>
                </head>

                <body>
                    <h1>Editar Maestro</h1>

                    <form action="" method="POST">
                        <label for="nombre">Nombre y apellidos:</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required><br><br>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>

                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>"><br><br>

                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" required><br><br>

                        <label for="clase_asignada">Clase Asignada:</label>
                        <input type="text" id="clase_asignada" name="clase_asignada" value="<?php echo $clase_asignada; ?>"><br><br>

                        <input type="submit" value="Guardar Cambios">
                    </form>

                    <br>
                    <a href="crud_maestros.php">Volver a la Lista de Maestros</a>
                </body>

                <?php
                // Procesar el formulario de edición cuando se envía
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Obtener los datos del formulario
                    $nombre = $_POST["nombre"];
                    $email = $_POST["email"];
                    $direccion = $_POST["direccion"];
                    $fecha_nacimiento = $_POST["fecha_nacimiento"];
                    $clase_asignada = $_POST["clase_asignada"];

                    // Consulta SQL para actualizar los datos del maestro
                    $sql = "UPDATE maestros SET nombre = ?, email = ?, direccion = ?, fecha_nacimiento = ?, clase_asignada = ? WHERE id = ?";
                    $stmt = $conn->prepare($sql);

                    if ($stmt) {
                        // Vincular los parámetros con los nuevos valores
                        $stmt->bind_param("sssssi", $nombre, $email, $direccion, $fecha_nacimiento, $clase_asignada, $id_maestro);

                        // Ejecutar la consulta
                        if ($stmt->execute()) {
                            echo "Los datos del maestro se actualizaron correctamente.";
                            // Redirigir solo si la actualización fue exitosa

                            exit; // Asegúrate de terminar el script aquí para evitar ejecución adicional.
                        } else {
                            echo "Error al actualizar los datos del maestro: " . $stmt->error;
                        }

                        // Cerrar la consulta preparada
                        $stmt->close();
                    } else {
                        echo "Error en la preparación de la consulta: " . $conn->error;
                    }
                }
                // Cerrar la conexión a la base de datos
                $conn->close();


                ?>

        </div>
    </div>
    </div>
    </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>

</html>