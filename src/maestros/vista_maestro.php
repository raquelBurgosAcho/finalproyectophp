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
    <script src="/js/main_menu.js" defer></script>
    <script src="/js/flecha.js" defer></script>
    <link href="/dist/output.css" rel="stylesheet">
    
    <style>
        .circular-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto; 
        }

        .universidad-text {
            text-align: center; 
            font-size: 20px; 
            font-weight: bold;
            color: silver; 
        }
        #menu1 {
            display: none;
        }
    </style>
</head>

<body class="font-sans">
    <main class="flex">
    <aside id="menu1" class="h-screen w-1/5 bg-gray-800 text-white">
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
                <li class="py-2 px-4">
                <h1 class="text-[#9c9fa1] w-[100%] flex justify-center font-semibold mb-4">MENU MAESTROS</h1>

                  <span class="material-symbols-outlined">ambient_screen</span>;
                <a href="maestro_alumnos_read.php">Alumnos</a>
            </li>

        </ul>
    </aside>
    <section id="menu2" class="w-4/5 bg-gray-100">
            <nav id="nav" class="bg-white flex justify-between items-center px-4 py-3 shadow-md fixed w-full">
                <!-- ... Tu barra de navegación ... -->
                <div class="flex items-center space-x-3">
                    <span id="menu-icon" class="material-symbols-outlined text-gray-600 text-lg cursor-pointer hover:text-gray-800">menu</span>
                    <h1 class="text-gray-600 font-medium">Home</h1>
                </div>
                <div class="flex space-x-2 items-center">
                    <p> Maestro </p>
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
            </nav>
            <div class="p-5 h-[80%] flex flex-col gap-6 mt-[70px] ">
                <div class="flex justify-between">
                    <h1 class=" text-2xl font-medium text-gray-700">Dashboard</h1>
                    <div class="flex gap-1">
                    <a href="vista_maestro.php">
                        <p class="text-blue-500">Home</p>
                        <li><a href="editar_perfil.php?email=<?php echo $email; ?>"class="text-blue-500">Perfil</a></li>

                </div>
            </div>


            <div class="bg-white shadow-md rounded p-5 mt-4">
                    <p class="text-gray-600 text-sm">Bienvenido</p>
                    <p class="text-gray-600 text-sm">Selecciona la acción que quieras realizar en la pestaña del menú de la izquierda</p>
                </div>
        </div>
    </div>
    </div>
</body>
<script src="https://cdn.tailwindcss.com"></script>

</html>