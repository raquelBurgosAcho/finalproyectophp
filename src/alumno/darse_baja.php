<?php 
session_start();
require_once "../conexiondb.php";
$email = $_SESSION['email'];
$consulta = $mysqli->query("SELECT *FROM estudiantes WHERE email = '$email'");
$resultado = $consulta->fetch_assoc();
$id_estudent = $resultado['id_estudiante'];
if (isset($_GET['id'])) {
    $curso_id = $_GET['id'];
$query = "DELETE FROM inscripciones WHERE estudianteID = $id_estudent AND cursoID = $curso_id";
    $result = $mysqli->query($query);
    header("Location: cursos.php");
} else {
    echo "no se pudo dar de baja";
    die();
}

?>