<?php
// Verificar si se ha enviado el ID de la clase a eliminar
if (isset($_GET["id"])) {
    $id_clase = $_GET["id"];

    // Conectar a la base de datos (reemplaza con tus propios datos de conexión)
    include "../../config/conexiondatabs.php";
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para eliminar la clase por su ID
    $sql = "DELETE FROM clases WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular el parámetro con el valor
        $stmt->bind_param("i", $id_clase);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "La clase se eliminó correctamente.";
        } else {
            echo "Error al eliminar la clase: " . $stmt->error;
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
    header("Location: clases_vista.php");
} else {
    echo "Falta el ID de la clase a eliminar.";
}
