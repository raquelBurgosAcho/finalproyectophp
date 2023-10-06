<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $email = $_POST["email"];
    $rol = $_POST["rol"];
    $estado = isset($_POST["estado"]) ? 1 : 0;
    // Conectar a la base de datos
    include "../../config/conexiondatabs.php"; // Ajusta la ruta según tu configuración

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Determinar la tabla a actualizar según el rol
    $tabla = "";
    switch ($rol) {
        case "Administrador":
            $tabla = "administrador";
            break;
        case "Estudiante":
            $tabla = "estudiantes";
            break;
        case "Maestro":
            $tabla = "maestros";
            break;
        default:
            // En caso de un rol desconocido, puedes manejarlo aquí
            break;
    }

    if (!empty($tabla)) {
        // Consulta SQL para actualizar el estado en la tabla correspondiente
        $sql = "UPDATE $tabla SET estado = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Vincular los parámetros con los nuevos valores
            $stmt->bind_param("is", $estado, $email);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "El estado del usuario se actualizó correctamente.";
            } else {
                echo "Error al actualizar el estado del usuario: " . $stmt->error;
            }

            // Cerrar la consulta preparada
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }
    } else {
        echo "Rol de usuario desconocido.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();

    // Redirigir de vuelta a la página anterior o a donde desees

    header("Location: permisos.php");
    exit;
}
