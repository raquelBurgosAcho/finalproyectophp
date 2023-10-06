<?php
include "../config/conexiondatabs.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $id_maestro = $_POST["id_maestro"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];

    // Conectar a la base de datos (reemplaza con tus propios datos de conexión)

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Consulta SQL para actualizar los datos del maestro
    $sql = "UPDATE maestros SET email = ?, contrasena = ?, nombre = ?, direccion = ?, fecha_nacimiento = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros con los nuevos valores
        $stmt->bind_param("sssssi", $email, $contrasena, $nombre, $direccion, $fecha_nacimiento, $id_maestro);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Los datos del maestro se actualizaron correctamente.";
        } else {
            echo "Error al actualizar los datos del maestro: " . $stmt->error;
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}