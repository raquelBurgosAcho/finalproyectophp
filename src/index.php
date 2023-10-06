<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Alegreya:ital@1&family=Asap+Condensed&family=Open+Sans:wght@300;400;700&display=swap"
        rel="stylesheet">
    <link href="/dist/output.css" rel="stylesheet">
   
</head>

<body class="bg-indigo-900 flex items-center justify-center h-screen bg-cover bg-center bg-no-repeat bg-fixed"
    style="background-image: url('../img/universidadLima.jpg');">
    <div class="w-full max-w-md p-6 bg-white bg-opacity-80 rounded-lg shadow-md relative">
        <img class="w-[300px] mx-auto mb-4" src="../img/logo.jpg" alt="logo">
        <h2 class="text-2xl mb-4 text-center font-semibold">Welcome, login with your account</h2>
        <form action="/actions/login.php" method="POST" class="space-y-4">
            <div>
                <label for="username" class="block font-medium text-gray-700">Username</label>
                <input type="text" id="email" name="email"
                    class="w-full md:w-96 rounded-md p-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300 no-outline">
            </div>
            <div>
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input type="password" id="contrasena" name="contrasena"
                    class="w-full md:w-96 rounded-md p-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300 no-outline">
                <input type="hidden" name="accion" value="acceso_username">
            </div>
            <button type="submit" class="w-full bg-gray-700 text-white py-2 rounded-md hover:bg-gray-800 shadow-md">Log
                In</button>
            <h1 class=" text-gray-900">O crea una cuenta: <a class="text-blue-900"
                    href="./registrar.php">Registrarse</a></h1>
        </form>

        <!-- Cuadro adicional en la derecha -->
        <div class="fixed top-0 right-0 p-4 bg-gray-600 text-gray-200">
            <h2 class="text-lg font-semibold mb-4">Información de acceso</h2>

            <!-- Información para Administrador -->
            <div>
                <p><strong>Administrador:</strong></p>
                <p><strong>Usuario:</strong> admin@admin</p>
                <p><strong>Contraseña:</strong> admin</p>
            </div>

            <!-- Información para Maestro -->
            <div>
                <p><strong>Maestro:</strong></p>
                <p><strong>Usuario:</strong> maestro@maestro</p>
                <p><strong>Contraseña:</strong> maestro</p>
            </div>

            <!-- Información para Alumno -->
            <div>
                <p><strong>Alumno:</strong></p>
                <p><strong>Usuario:</strong> alumno@alumno</p>
                <p><strong>Contraseña:</strong> alumno</p>
            </div>
        </div>
    </div>
    

</html>