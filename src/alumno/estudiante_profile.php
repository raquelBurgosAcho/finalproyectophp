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
        $sql = "SELECT id_estudiante, nombre, apellido, email, contrasena, direccion, fecha_nacimiento, DNI FROM estudiantes WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Vincular el parámetro con el valor del email del estudiante
            $stmt->bind_param("s", $email_maestro); // Corrección aquí

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener el resultado de la consulta
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // Obtener los datos del estudiante
                $row = $result->fetch_assoc();
                $id_estudiante = $row["id_estudiante"];
                $nombre = $row["nombre"];
                $apellido = $row["apellido"];
                $email = $row["email"];
                $contrasena = $row["contrasena"];
                $direccion = $row["direccion"];
                $fecha_nacimiento = $row["fecha_nacimiento"];
                $DNI = $row["DNI"];
            } else {
                echo "No se encontró el estudiante con el email proporcionado.";
                exit();
            }

            // Cerrar la consulta preparada

        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
            exit();
        }
    } else {
        echo "Email de estudiante no proporcionado.";
        exit();
    }
} else {
    echo "Error en la preparación de la consulta: " . $conn->error;
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="/dist/output.css" rel="stylesheet">
    <script src="/js/flecha.js" defer></script>
    <script src="/js/main_menu.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Alumno</title>
</head>
<style>
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

<body>
    <main class="flex">
        <section class="h-[100vh] bg-[#34393f] w-[20%] fixed">
            <img src="/imgs/logo2.jpg" alt="logo" class="w-[100%] ">
            <hr class=" border-[#51575e]">
            <div class="p-[20px] flex flex-col gap-2">
                <h2 class="text-[#9c9fa1] font-medium">Alumno</h2>
                <div class="text-[#9c9fa1] font-medium flex">
                    <div class="flex gap-1">

                    </div>
                </div>
            </div>
            <hr class="w-[230px] ml-[14px] border-[#4d5359]">
            <div class="p-[20px] pt-6 flex flex-col gap-4">
                <h1 class="text-[#9c9fa1] w-[100%] flex justify-center font-semibold">MENU ALUMNOS</h1>
                <a href="#" class="flex gap-3">
                    <span class="material-symbols-outlined text-[#9c9fa1]">task</span>
                    <h2 class="text-[#9c9fa1] font-medium">Ver Calificaciones</h2>
                </a>
                <a href="cursos.php" class="flex gap-3">
                    <span class="material-symbols-outlined text-[#9c9fa1]">tv_gen</span>
                    <h2 class="text-[#9c9fa1] font-medium">Administra tus Clases</h2>
                </a>
            </div>
        </section>
        <section class="w-[80%] h-[100vh] bg-[#f5f6fa] ml-[272px]">
            <nav
                class="bg-white w-[80%] h-[10%] flex justify-between items-center gap-3 px-3 shadow-sm shadow-gray-400 fixed">
                <div class="flex gap-3">
                    <span class="material-symbols-outlined text-[#b6beb3] text-lg">menu</span>
                    <h1 class="text-[#b6beb3] font-medium">Perfil</h1>
                </div>
                <div class="flex gap-2">
                    <div class="flex gap-1">

                    </div>
                    <span id="flecha" class="material-symbols-outlined cursor-pointer">chevron_right</span>
                    <div id="modal"
                        class=" absolute top-[68px] right-[20px] bg-white shadow-sm shadow-gray-400 rounded-md hidden">
                        <a href="vista_estudiante.php">
                            <div class="flex gap-3 pl-4 py-3 pr-[4rem]">
                                <span class="material-symbols-outlined">home</span>
                                <p>Home</p>
                            </div>
                        </a>
                        <hr>
                        <form action="/actions/cerrar_sesion.php">
                            <div class="flex gap-3 px-4 py-3 text-red-500">
                                <span class="material-symbols-outlined cursor-none">door_open</span>
                                <button type="submit">
                                    <p>Logout</p>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </nav>
            <div class="p-5 h-[80%] flex flex-col gap-6 mt-[70px] ">
                <div class="flex justify-between">
                    <h1 class=" text-2xl font-medium text-gray-700">Editar datos del perfil</h1>
                    <div class="flex gap-1">
                        <a href="vista_estudiante.php">
                            <p class="text-blue-500">Home</p>
                        </a>/ <p>Perfil</p>
                    </div>
                </div>
                <div class="bg-white shadow-sm shadow-gray-400 w-[100%] rounded-sm  flex flex-col justify-center gap-1">
                    <div class="flex items-center p-3 pl-6">
                        <h2>Informacion de Usuario</h2>
                    </div>
                    <hr>

                    <body>
                        <form method="POST" action="editar_perfil_estudiante.php">
                            <input type="hidden" name="id_estudiante" value="<?php echo $id_estudiante; ?>">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>"><br><br>

                            <label for="apellido">Apellido:</label>
                            <input type="text" name="apellido" id="apellido" value="<?php echo $apellido; ?>"><br><br>

                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" value="<?php echo $email; ?>"><br><br>

                            <label for="contrasena">Contraseña:</label>
                            <input type="password" name="contrasena" id="contrasena"
                                value="<?php echo $contrasena; ?>"><br><br>

                            <label for="direccion">Dirección:</label>
                            <input type="text" name="direccion" id="direccion"
                                value="<?php echo $direccion; ?>"><br><br>

                            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                value="<?php echo $fecha_nacimiento; ?>"><br><br>

                            <label for="DNI">DNI:</label>
                            <input type="text" name="DNI" id="DNI" value="<?php echo $DNI; ?>"><br><br>

                            <input type="submit" value="Guardar Cambios">
                        </form>

                    </body>
                </div>
            </div>
        </section>
    </main>
</body>

</html>