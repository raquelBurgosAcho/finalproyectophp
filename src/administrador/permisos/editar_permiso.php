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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <!-- Link your external CSS file -->
    <link rel="stylesheet" href="index.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
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
            <span id="menu-icon" class="material-symbols-outlined text-gray-600 text-lg cursor-pointer hover:text-gray-800">menu</span>
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
                <a href="#">Permisos</a>
            </li>
            <li>
                <span class="material-symbols-outlined">group</span>
                <a href="../admin_maestro/crud_maestros.php">Maestros</a>
            </li>
            <li>
                <span class="material-symbols-outlined">ambient_screen</span>
                <a href="admin_estudiantes/crud_permisos.php">permisos</a>
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
                <h1 class="text-2xl font-medium text-gray-700">Lista de permisos</h1>

                <div class="flex gap-1">
                    <a href="./vAdmin.php">
                        <p class="text-blue-500">Home</p>
                    </a>/ <p>permiso</p>
                </div>
            </div>
            <?php
            if (isset($_GET['id']) && isset($_GET['email']) && isset($_GET['rol'])) {
                $userId = $_GET['id'];
                $userEmail = $_GET['email'];
                $userRol = $_GET['rol'];
            }
            ?>

            <div class="table-container">
                <h2>Registrar permiso</h2>
            </div>

            <body>
                <h1>Editar Permiso de Usuario</h1>
                <form class="" action="procesar_permiso.php" method="POST">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="<?php echo $userEmail; ?>" readonly><br><br>

                    <label for="rol">Rol:</label>
                    <input type="text" id="rol" name="rol" value="<?php echo $userRol; ?>" readonly><br><br>

                    <label for="estado">Estado:</label>
                    <input type="checkbox" id="estado" name="estado" value="activo"> Activo<br><br>

                    <input type="submit" value="Guardar Cambios">
                </form>
            </body>
            </table>
        </div>
    </div>
    </div>
    </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>

</html>