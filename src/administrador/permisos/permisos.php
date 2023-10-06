<?php
session_start();

// Verificar si la sesión existe y si hay un email almacenado en ella
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    // Aquí puedes utilizar el email para cualquier propósito necesario
    // Por ejemplo, mostrarlo en la página o realizar otras operaciones
} else {
    // Si no hay sesión o email en la sesión, puedes manejarlo de acuerdo a tus necesidades
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

    /* Estilo para Administrador (fondo amarillo) */
    .permiso-administrador {
        background-color: yellow;
    }

    /* Estilo para Maestro (texto celeste) */
    .permiso-maestro {
        color: lightblue;
    }

    /* Estilo para Estudiante (texto gris) */
    .permiso-estudiante {
        color: gray;
    }
    </style>

</head>

<body class="font-sans">
    <header class="flex items-center justify-between" style="background-color: #808080;">
        <!-- Barra de navegación izquierda -->
        <div class="flex items-center space-x-3">
            <span id="menu-icon"
                class="material-symbols-outlined text-gray-600 text-lg cursor-pointer hover:text-gray-800" href="../vista_admin.php">menu</span>
            <h1 class="text-white text-lg font-medium" >Home</h1>
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
                <a href="../admin_maestro/crud_maestros.php">Maestros</a>
            </li>
            <li>
                <span class="material-symbols-outlined">ambient_screen</span>
                <a href="crud_alumnos.php">Alumnos</a>
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
                    <a href="../vista_admin.php">
                        <p class="text-blue-500">Home</p>
                    </a>/ <p>Alumno</p>
                </div>
            </div>


            <div class="table-container">

                <body>
                    <?php
                    // Conectar a la base de datos y realizar consultas en las tres tablas
                    include "../../config/conexiondatabs.php";

                    // Verificar la conexión
                    if ($conn->connect_error) {
                        die("Error de conexión a la base de datos: " . $conn->connect_error);
                    }

                    // Consulta SQL para obtener los administradores
                    $sql_administradores = "SELECT id_admin as id, email, 'Administrador' as permiso, estado FROM administrador";

                    // Consulta SQL para obtener los estudiantes
                    $sql_estudiantes = "SELECT id_estudiante as id, email, 'Estudiante' as permiso, estado FROM estudiantes";

                    // Consulta SQL para obtener los maestros
                    $sql_maestros = "SELECT id as id, email, 'Maestro' as permiso, estado FROM maestros";

                    // Combinar los resultados de las tres consultas en una sola tabla
                    $sql_union = "$sql_administradores UNION $sql_estudiantes UNION $sql_maestros";

                    $result = $conn->query($sql_union);
                    ?>
                    <h1>Listado de permisos</h1>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Email/Usuario</th>
                                <th>Permiso</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Determinar la clase CSS según el permiso
                                    $permisoClass = "";
                                    if ($row["permiso"] === "Administrador") {
                                        $permisoClass = "permiso-administrador";
                                    } elseif ($row["permiso"] === "Maestro") {
                                        $permisoClass = "permiso-maestro";
                                    } elseif ($row["permiso"] === "Estudiante") {
                                        $permisoClass = "permiso-estudiante";
                                    }

                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["email"] . "</td>";
                                    echo "<td><span class='" . $permisoClass . "'>" . $row["permiso"] . "</span></td>";
                                    echo "<td>" . ($row["estado"] == 1 ? "Activo" : "Inactivo") . "</td>";
                                    echo "<td><a href='editar_permiso.php?id=" . $row["id"] . "&email=" . $row["email"] . "&rol=" . $row["permiso"] . "'><i class='fas fa-edit'></i></a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No se encontraron usuarios.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </body>
            </div>
        </div>
    </div>
    </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>

</html>