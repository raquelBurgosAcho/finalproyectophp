<?php
session_start();
require_once __DIR__ . '/../../conexiondb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curso_id = $_POST['clase'];
    $profesor_id = $_POST['nombre'];

    $query = "UPDATE cursos SET maestroID = ? WHERE id = ?";
    
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $profesor_id, $curso_id);

    if ($stmt->execute()) {
        // Asignación exitosa
        header("Location: clases_vista.php"); // Redirige a una página de éxito o a donde desees
    } else {
        echo "Error en la asignación: " . $stmt->error;
    }
}
?>

