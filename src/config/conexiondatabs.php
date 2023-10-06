<?php
try {
    $conn = new mysqli("localhost", "root", "", "universidad");

    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    $conn->set_charset("utf8");
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}