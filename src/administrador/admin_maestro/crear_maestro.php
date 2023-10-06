<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];
    $direccion = $_POST["direccion"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $clase_asignada = $_POST["clase_asignada"];

    // Conectar a la base de datos (reemplaza con tus propios datos de conexión)
    include "../../config/conexiondatabs.php";

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar un nuevo maestro en la tabla "maestros"
    $sql = "INSERT INTO maestros (nombre, email,contrasena, direccion, fecha_nacimiento, clase_asignada) VALUES (?, ?,?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros con los valores
        $stmt->bind_param("ssssss", $nombre, $email, $contrasena, $direccion, $fecha_nacimiento, $clase_asignada);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "El maestro se agregó correctamente.";
        } else {
            echo "Error al agregar el maestro: " . $stmt->error;
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
    header("Location: crud_maestros.php");
} else {
    echo "Acceso no autorizado.";
}
