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
    <script src="/js/main_menu.js" defer></script>
    <script src="/js/flecha.js" defer></script>
    <style>
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

    /* Estilo para el botón arriba de la tabla */
    .btn-container {
        text-align: center;
        margin-bottom: 20px;
    }

    /* Estilo para los botones de editar y eliminar */
    .edit-btn,
    .delete-btn {
        padding: 5px 10px;
        margin: 0 5px;
        background-color: #3498db;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .edit-btn:hover,
    .delete-btn:hover {
        background-color: #2980b9;
    }
    </style>
</head>

<body class="font-sans">
    <header class="flex items-center justify-between" style="background-color: #808080;">
        <!-- Barra de navegación izquierda -->
        <div class="flex items-center space-x-3">
            <span id="menu-icon"
                class="material-symbols-outlined text-gray-600 text-lg cursor-pointer hover:text-gray-800" href=".../maestros/vista_maestro" >menu</span>
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
                <span class="material-symbols-outlined">group</span>
                <a href="crud_maestros.php">Maestros</a>
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
                <h1 class="text-2xl font-medium text-gray-700">Lista de Maestros</h1>
                <div class="flex gap-1">
                    <a href="../vista_admin.php">
                        <p class="text-blue-500">Home</p>
                    </a>/ <p>Alumno</p>
                </div>
            </div>
            <div class="bg-white p-4 border border-gray-300 rounded-lg shadow-lg">
                <h2>Información de alumnos</h2>
                <div class="btn-container">
                    <button onclick="location.href='agregar_maestro.php'"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md shadow-md">
                        Agregar maestro
                    </button>
                </div>

                <body>
                    <?php
                    include "../../config/conexiondatabs.php";
                    $sql = "SELECT id, nombre, email, direccion, fecha_nacimiento, clase_asignada FROM maestros";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // Mostrar la tabla HTML con los datos de los maestros
                        echo "<table>";
                        echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Dirección</th><th>Fecha de Nacimiento</th><th>Clase Asignada</th><th>Acciones</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["nombre"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["direccion"] . "</td>";
                            echo "<td>" . $row["fecha_nacimiento"] . "</td>";
                            echo "<td>" . $row["clase_asignada"] . "</td>";
                            echo "<td>";
                            echo "<a href='edit_maestro.php?id=" . $row["id"] . "'>Editar</a> | ";
                            echo "<a href='eliminar_maestro.php?id=" . $row["id"] . "' onclick=\"return confirm('¿Estás seguro de que deseas eliminar a este maestro?');\">Eliminar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No se encontraron maestros en la base de datos.";
                    }
                    // Cerrar la conexión a la base de datos
                    $conn->close();
                    ?>
                </body>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>

</html>