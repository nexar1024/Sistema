<?php

include("../bd/conexion.php");

if (isset($_POST['id_pregunta']) && isset($_POST['id_pregunta']) != "") {
    // Obtener id_pregunta
    $id_pregunta = $_POST['id_pregunta'];

    // Obtener detalles de la pregunta
    $query = "SELECT * FROM preguntasentrevista WHERE id_pregunta = '$id_pregunta'" ;
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