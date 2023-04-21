<?php

include ("../bd/conexion.php");

if (isset($_POST)) {
    // Obtener valores
    $id_encuesta    = $_POST['id_encuesta'];
    $titulo         = $_POST['titulo'];
    $descripcion    = $_POST['descripcion'];
    $fecha_final    = $_POST['fecha_final'];

    // Modificar producto
    $query = "
        UPDATE encuestas SET
        titulo      = '$titulo',
        descripcion = '$descripcion',
        fecha_final = '$fecha_final' 
        WHERE id_encuesta   = '$id_encuesta'
    ";
    if (!$result = mysqli_query($conn, $query)) {
        exit(mysqli_error($conn));
    }
}