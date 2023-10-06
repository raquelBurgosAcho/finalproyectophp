<?php

// Iniciar la sesión (si no está iniciada)
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar el email y la contraseña ingresados desde el formulario
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    // Conectar a la base de datos (reemplaza con tus propios datos de conexión)
    $mysqli = new mysqli("localhost", "root", "", "universidad");

    if ($mysqli->connect_error) {
        die("Error de conexión a la base de datos: " . $mysqli->connect_error);
    }

    // Consulta SQL para buscar el email y la contraseña en la tabla "maestros"
    $sql_maestros = "SELECT id, nombre, estado FROM maestros WHERE email = ? AND contrasena = ?";
    $stmt_maestros = $mysqli->prepare($sql_maestros);
    $stmt_maestros->bind_param("ss", $email, $contrasena);
    $stmt_maestros->execute();
    $result_maestros = $stmt_maestros->get_result();

    // Consulta SQL para buscar el email y la contraseña en la tabla "estudiantes"
    $sql_estudiantes = "SELECT id_estudiante, nombre, estado FROM estudiantes WHERE email = ? AND contrasena = ?";
    $stmt_estudiantes = $mysqli->prepare($sql_estudiantes);
    $stmt_estudiantes->bind_param("ss", $email, $contrasena);
    $stmt_estudiantes->execute();
    $result_estudiantes = $stmt_estudiantes->get_result();

    // Consulta SQL para buscar el email y la contraseña en la tabla "administradores"
    $sql_administradores = "SELECT id_admin, nombre, estado FROM administrador WHERE email = ? AND contrasena = ?";
    $stmt_administradores = $mysqli->prepare($sql_administradores);
    $stmt_administradores->bind_param("ss", $email, $contrasena);
    $stmt_administradores->execute();
    $result_administradores = $stmt_administradores->get_result();

    // Verificar si el email y la contraseña coinciden en alguna tabla
    if ($result_maestros->num_rows > 0) {
        // Obtener el estado del maestro
        $row_maestros = $result_maestros->fetch_assoc();
        if ($row_maestros["estado"] == 0) {
            // Agregar un retraso de un segundo antes de mostrar el mensaje de alerta
            echo '<script>setTimeout(function() {
                alert("Usuario inactivo. Contacta al administrador para activar tu cuenta.");
                // Redirigir al usuario a ../src/index.php
                window.location.href = "../src/index.php";
            }, 1000);</script>';
            exit;
        } else {
            // El maestro ha iniciado sesión con éxito, redirige a maestros.php
            $_SESSION["email"] = $email;
            header("Location: ../src/maestros/vista_maestro.php");
            exit;
        }
    } elseif ($result_estudiantes->num_rows > 0) {
        // Obtener el estado del estudiante
        $row_estudiantes = $result_estudiantes->fetch_assoc();
        if ($row_estudiantes["estado"] == 0) {
            // Agregar un retraso de un segundo antes de mostrar el mensaje de alerta
            echo '<script>setTimeout(function() {
                alert("Usuario inactivo. Contacta al administrador para activar tu cuenta.");
                // Redirigir al usuario a ../src/index.php
                window.location.href = "../src/index.php";
            }, 1000);</script>';
            exit;
        } else {
            // El estudiante ha iniciado sesión con éxito, redirige a estudiantes.php
            $_SESSION["email"] = $email;
            header("Location: ../src/alumno/vista_estudiante.php");
            exit;
        }
    } elseif ($result_administradores->num_rows > 0) {
        // Obtener el estado del administrador
        $row_administradores = $result_administradores->fetch_assoc();
        if ($row_administradores["estado"] == 0) {
            // Agregar un retraso de un segundo antes de mostrar el mensaje de alerta
            echo '<script>setTimeout(function() {
                alert("Usuario inactivo. Contacta al administrador para activar tu cuenta.");
                // Redirigir al usuario a ../src/index.php
                window.location.href = "../src/index.php";
            }, 1000);</script>';
            exit;
        } else {
            // El administrador ha iniciado sesión con éxito, redirige a admin.php
            $_SESSION["email"] = $email;
            header("Location: ../src/administrador/vista_admin.php");
            exit;
        }
    } else {
        // Las credenciales son incorrectas, muestra un mensaje de error
        $error = "Email y/o contraseña incorrectos. Inténtalo de nuevo.";
    }

    // Cerrar la conexión a la base de datos
    $mysqli->close();
}

// ... (continúa con el resto de tu código)