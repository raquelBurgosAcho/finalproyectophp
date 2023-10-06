<?php
include "../config/conexiondatabs.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $id_estudiante = $_POST["id_estudiante"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];
    $direccion = $_POST["direccion"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $DNI = $_POST["DNI"];

    // Consulta SQL para actualizar los datos del estudiante
    $sql = "UPDATE estudiantes SET nombre = ?, apellido = ?, email = ?, contrasena = ?, direccion = ?, fecha_nacimiento = ?, DNI = ? WHERE id_estudiante = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros con los nuevos valores
        $stmt->bind_param("sssssssi", $nombre, $apellido, $email, $contrasena, $direccion, $fecha_nacimiento, $DNI, $id_estudiante);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Los datos del estudiante se actualizaron correctamente.";
        } else {
            echo "Error al actualizar los datos del estudiante: " . $stmt->error;
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
header("Location: vista_estudiante.php");
