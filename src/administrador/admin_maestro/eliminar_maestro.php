<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && is_numeric($_GET["id"])) {
    // Obtener el ID del maestro desde la URL
    $id_maestro = $_GET["id"];

    // Conectar a la base de datos (reemplaza con tus propios datos de conexión)
    include "../../config/conexiondatabs.php";

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Consulta SQL para eliminar al maestro con el ID proporcionado
    $sql = "DELETE FROM maestros WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular el parámetro con el valor del ID del maestro
        $stmt->bind_param("i", $id_maestro);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "El maestro se eliminó correctamente.";
        } else {
            echo "Error al eliminar al maestro: " . $stmt->error;
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "Acceso no autorizado o ID de maestro no válido.";
}