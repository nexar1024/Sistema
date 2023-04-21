<?php

include ("../bd/conexion.php");

if (isset($_POST)) {
    // Obtener valores
    $id_entrevista    = $_POST['id_entrevista'];
    $tituloE         = $_POST['tituloE'];
    $objetivo    = $_POST['objetivo'];
    $nombre_entrevistado    = $_POST['nombre_entrevistado'];
    $fecha_final    = $_POST['fecha_final'];

    // Modificar producto
    $query = "
        UPDATE entrevistas SET
        tituloE      = '$tituloE',
        objetivo = '$objetivo',
        nombre_entrevistado = '$nombre_entrevistado',
        fecha_final = '$fecha_final' 
        WHERE id_entrevista   = '$id_entrevista'
    ";
    if (!$result = mysqli_query($conn, $query)) {
        exit(mysqli_error($conn));
    }
}