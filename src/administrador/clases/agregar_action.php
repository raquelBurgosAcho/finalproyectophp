<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $clase = $_POST["clase"];
    $maestro = $_POST["maestro"];
    $alumno_inscrito = $_POST["alumno_inscrito"];

    include "../../config/conexiondatabs.php";
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar una nueva clase
    $sql = "INSERT INTO clases (clase, maestro, alumno_inscrito) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros con los valores
        $stmt->bind_param("sss", $clase, $maestro, $alumno_inscrito);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "La clase se agregó correctamente.";
        } else {
            echo "Error al agregar la clase: " . $stmt->error;
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
    echo "El formulario no se ha enviado correctamente.";
}
