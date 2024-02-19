<?php
session_start();
include_once "conexion.php";
$db=conectarDB();

// Obtener el empleado ID enviado por método POST
$empleadoID = $_POST['empleadoID'];

// Preparar la consulta SQL para insertar el registro en la tabla pedidos
$stmt = $pdo->prepare('INSERT INTO pedidos (empleado_id) VALUES ($empleadoID)');
$stmt->execute([$empleadoID]);

?>
