<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $dni = $_POST["DNI"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];

    // Conectar a la base de datos (reemplaza con tus propios datos de conexión)
    include "../../config/conexiondatabs.php";
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar un nuevo estudiante
    $sql = "INSERT INTO estudiantes (DNI, nombre, apellido, email, direccion, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros con los valores
        $stmt->bind_param("ssssss", $dni, $nombre, $apellido, $email, $direccion, $fecha_nacimiento);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Estudiante registrado con éxito.";
        } else {
            echo "Error al registrar el estudiante: " . $stmt->error;
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
    echo "El formulario no se ha enviado correctamente.";
}
