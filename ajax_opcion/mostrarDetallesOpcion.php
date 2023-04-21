<?php

include("../bd/conexion.php");

if (isset($_POST['id_opcion']) && isset($_POST['id_opcion']) != "") {
    // Obtener id_opcion
    $id_opcion = $_POST['id_opcion'];

    // Obtener detalles de la pregunta
    $query = "SELECT * FROM opciones WHERE id_opcion = '$id_opcion'" ;
    if (!$result = mysqli_query($conn, $query)) {
        exit(mysqli_error($conn));
    }
    $response = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
    }
    else {
        $response['status'] = 200;
        $response['message'] = "Información no encontrada!";
    }
    // display JSON data
    echo json_encode($response) ;
}
else {
    $response['status'] = 200;
    $response['message'] = "Consulta Invalida!";
}