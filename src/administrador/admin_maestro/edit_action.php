<?php
session_start();
require_once __DIR__ . '/../../conexiondb.php';

$email = $_POST["email"];
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellido"];
$direccion = $_POST['direccion'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$curso = $_POST['curso'];

// Obtén el ID del maestro
$consulta = $mysqli->query("SELECT * FROM maestros WHERE email = '$email'");
$resultado = $consulta->fetch_assoc();
$id_maestro = $resultado['id_maestro'];

// Actualiza otros datos del maestro si es necesario
$query_maestros = "UPDATE `maestros` SET ";
$params_maestros = array();

if (!empty($nombre)) {
    $query_maestros .= "`nombre` = ?, ";
    $params_maestros[] = $nombre;
    $_SESSION['name'] = $nombre;
}
if (!empty($apellidos)) {
    $query_maestros .= "`apellido` = ?, ";
    $params_maestros[] = $apellidos;
    $_SESSION['apellidos'] = $apellidos;
}
if (!empty($direccion)) {
    $query_maestros .= "`direccion` = ?, ";
    $params_maestros[] = $direccion;
    $_SESSION['direccion'] = $direccion;
}
if (!empty($fecha_nacimiento)) {
    $query_maestros .= "`fecha_nacimiento` = ?, ";
    $params_maestros[] = $fecha_nacimiento;
    $_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
}

$query_maestros = rtrim($query_maestros, ", ");
$query_maestros .= " WHERE `maestros`.`email` = ?";
$params_maestros[] = $email; // Cambio $correo a $email

$stmt_maestros = $mysqli->prepare($query_maestros);

// Genera un string de tipos dinámico basado en la cantidad de parámetros
$types_maestros = str_repeat("s", count($params_maestros));
$params_maestros = array_merge(array($types_maestros), $params_maestros);
call_user_func_array(array($stmt_maestros, 'bind_param'), $params_maestros);

if ($stmt_maestros->execute()) {
    // Obtén el ID del curso anterior al que estaba asignado el maestro
    $consulta_curso_anterior = $mysqli->query("SELECT maestroID FROM cursos WHERE maestroID = $id_maestro");
    $curso_anterior = $consulta_curso_anterior->fetch_assoc();
    $id_curso_anterior = $curso_anterior['maestroID'];

    // Actualiza el curso anterior para desvincular al maestro
    if (!empty($id_curso_anterior)) {
        $query_desvincular = "UPDATE cursos SET maestroID = NULL WHERE id = ?";
        $stmt_desvincular = $mysqli->prepare($query_desvincular);
        $stmt_desvincular->bind_param("i", $id_curso_anterior);
        $stmt_desvincular->execute();
        $stmt_desvincular->close();
    }

    // Actualiza el nuevo curso para asignar al maestro
    $query_asignar = "UPDATE cursos SET maestroID = ? WHERE id = ?";
    $stmt_asignar = $mysqli->prepare($query_asignar);
    $stmt_asignar->bind_param("ii", $id_maestro, $curso);
    $stmt_asignar->execute();
    $stmt_asignar->close();

} else {
    echo "Error en la actualización: " . $stmt_maestros->error;
}
header("Location: crud_maestros.php");

$stmt_maestros->close();
