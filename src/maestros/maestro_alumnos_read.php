<?php
session_start();

// Verificar si la sesión existe y si hay un email almacenado en ella
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    // Aquí puedes utilizar el email para cualquier propósito necesario
    // Por ejemplo, mostrarlo en la página o realizar otras operaciones
} else {
    // Si no hay sesión o email en la sesión, puedes manejarlo de acuerdo a tus necesidades
    // Por ejemplo, redireccionar al usuario a una página de inicio de sesión
}

// ...

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
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/js/main_menu.js" defer></script>
    <script src="/js/flecha.js" defer></script>
    <style>
    
    

    .table-container {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
table {
    border-collapse: collapse;
    width: 80%;
    margin: 20px auto;
}

th,
td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

th {
    background-color: #f2f2f2;
}

.actions {
    text-align: center;
}
</style>


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
                    <p>Maestro</p>
                </li>
           
            <li class="separator-horizontal"></li>
            <li>
                <h1 class="text-[#9c9fa1] w-[100%] flex justify-center font-semibold mb-4">MENU MAESTRO</h1>
            </li>

            <li>
                <span class="material-symbols-outlined">ambient_screen</span>
                <a href="maestro_alumnos_read.php">Alumnos</a>
            </li>

        </ul>
    </aside>
    <div class="main-content" style="margin-left: 20%; padding: 20px;">
        <div class="p-5 h-[80%] flex flex-col gap-6 mt-[70px]">
            <div class="flex justify-between">
                <h1 class="text-2xl font-medium text-gray-700">Lista de Maestro</h1>

                <div class="flex gap-1">
                  <a href="vista_maestro.php">
                        <p class="text-blue-500">Home</p>
                        <li><a href="editar_perfil.php?email=<?php echo $email; ?>">Perfil</a></li>

                </div>
            </div>


            <div class="table-container">


                <body>
                    <h1>Tabla Clase Guarani</h1>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Alumno</th>
                            <th>Calificación</th>
                            <th>Mensajes</th>
                            <th>Acciones</th>
                        </tr>
                        <?php
                        // Conectar a la base de datos (reemplaza con tus propios datos de conexión)
                        include "../config/conexiondatabs.php";

                        if ($conn->connect_error) {
                            die("Error de conexión a la base de datos: " . $conn->connect_error);
                        }

                        // Consulta SQL para obtener los datos de la tabla "clase_guarani"
                        $sql = "SELECT * FROM clase_guarani";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["nombre_alumno"] . "</td>";
                                echo "<td>" . $row["calificacion"] . "</td>";
                                echo "<td>" . $row["mensajes"] . "</td>";
                                echo "<td class='actions'>";
                                echo "<a href='#'><i class='fas fa-edit'></i></a>";
                                echo "<a href='#'><i class='far fa-envelope'></i></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No se encontraron registros en la tabla.</td></tr>";
                        }

                        // Cerrar la conexión a la base de datos
                        $conn->close();
                        ?>
                    </table>
                </body>
            </div>
        </div>
    </div>
    </div>


</body>
<script src="https://cdn.tailwindcss.com"></script>

</html>