<?php
// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $id_estudiante = $_POST["id_estudiante"];
    $dni = $_POST["DNI"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];

    include "../../config/conexiondatabs.php";

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para actualizar los datos del estudiante
    $sql = "UPDATE estudiantes SET DNI = ?, nombre = ?, apellido = ?, email = ?, direccion = ?, fecha_nacimiento = ? WHERE id_estudiante = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros con los valores
        $stmt->bind_param("ssssssi", $dni, $nombre, $apellido, $email, $direccion, $fecha_nacimiento, $id_estudiante);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Los cambios se guardaron correctamente.";
        } else {
            echo "Error al guardar los cambios: " . $stmt->error;
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
    header("Location: crud_alumnos.php");
} else {
    echo "El formulario de edición no se ha enviado correctamente.";
}
