<?php
// Verificar si se ha enviado el ID de estudiante para eliminar
if (isset($_GET["id"])) {
    $id_estudiante = $_GET["id"];

    include "../../config/conexiondatabs.php";

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para eliminar el estudiante por su ID
    $sql = "DELETE FROM estudiantes WHERE id_estudiante = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular el parámetro con el valor
        $stmt->bind_param("i", $id_estudiante);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "El estudiante se eliminó correctamente.";
        } else {
            echo "Error al eliminar el estudiante: " . $stmt->error;
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
    echo "Falta el ID de estudiante para eliminar.";
}
