<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abel&family=Alegreya:ital@1&family=Asap+Condensed&family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
  <link href="/dist/output.css" rel="stylesheet">
  </head>

<body class="bg-gray-100 flex items-center justify-center h-screen bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url('./img/universidad.png');">
  <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md relative bg-opacity-50">
   <img class="w-[300px] mx-auto mb-4" src="../img/logo.jpg" alt="logo">
    <h2 class="text-2xl mb-4 text-center font-semibold">Bienvenido! Crea tu cuenta.</h2>
    <form action="../actions/crear.php" method="POST" class="space-y-4">
      <div>
        <label for="username" class="block font-medium text-gray-700">Username</label>
        <input type="text" id="correo" name="correo" class="w-full md:w-96 rounded-md p-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300 no-outline">
      </div>
      <div>
        <label for="password" class="block font-medium text-gray-700">Password</label>
        <input type="password" id="contrasena" name="contrasena" class="w-full md:w-96 rounded-md p-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300 no-outline">
        <input type="hidden" name="accion" value="acceso_username">
      </div>
      <button type="submit" class="w-full bg-gray-700 text-white py-2 rounded-md hover:bg-gray-800 shadow-md">Crear Cuenta</button>
      <h1 class=" text-gray-900">O crea una cuenta: <a class="text-blue-900" href="index.php">Login</a></h1>
    </form>