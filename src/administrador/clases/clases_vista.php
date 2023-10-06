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
                <a href="../permisos/permisos.php">Permisos</a>
            </li>
            <li>
                <span class="material-symbols-outlined">group</span>
                <a href="../admin_maestro/crud_maestros.php">Maestros</a>
            </li>
            <li>
                <span class="material-symbols-outlined">ambient_screen</span>
                <a href="../admin_estudiantes/crud_alumnos.php">Alumnos</a>
            </li>
            <li>
                <span class="material-symbols-outlined">pacemaker</span>
                <a href="clases_vista.php">Clases</a>
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


            <div class="table-container">



                <body>

                    <body>
                        <h1>Lista de Clases</h1>

                        <?php
                        // Conectar a la base de datos (reemplaza con tus propios datos de conexión)
                        include "../../config/conexiondatabs.php";

                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Error de conexión a la base de datos: " . $conn->connect_error);
                        }

                        // Consulta SQL para obtener los datos de la tabla "clases"
                        $sql = "SELECT id, clase, maestro, alumno_inscrito FROM clases";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Mostrar la tabla HTML con los datos de las clases
                            echo "<table>";
                            echo "<tr><th>ID</th><th>Clase</th><th>Maestro</th><th>Alumno Inscrito</th><th>Acciones</th></tr>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["clase"] . "</td>";
                                echo "<td>" . $row["maestro"] . "</td>";
                                echo "<td>" . $row["alumno_inscrito"] . "</td>";
                                echo "<td>";
                                echo "<a href='editar_clase.php?id=" . $row["id"] . "' class=edit-btn>Editar</a> | ";
                                echo "<a href='eliminar_clase.php?id=" . $row["id"] . "' class=delete-btn>Eliminar</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No se encontraron clases en la base de datos.";
                        }

                        // Cerrar la conexión a la base de datos
                        $conn->close();
                        ?>
                        <br><br>
                        <br>
                        <a href="agregar_clase.php"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Agregar
                            Clase</a>


                    </body>

                </body>
            </div>
        </div>
    </div>
    </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>

</html>