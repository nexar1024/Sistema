<?php

if (isset($_POST['id_usuario']) && isset($_POST['tituloE']) && isset($_POST['objetivo']) && isset($_POST['nombre_entrevistado']) && isset($_POST['fecha_final'])) {
    // Incluir archivo de conexión a base de datos
    include ("../bd/conexion.php");

    // Establecemos la zona horario
    date_default_timezone_set("America/Lima");
  	$date = new DateTime();
  	$fecha_inicio = $date->format('Y-m-d H:i:s');

    // Obtener valores
    $id_usuario  = $_POST['id_usuario'];
    $tituloE      = $_POST['tituloE'];
    $objetivo = $_POST['objetivo'];
    $nombre_entrevistado = $_POST['nombre_entrevistado'];
    $fecha_final = $_POST['fecha_final'];

    $query = "INSERT INTO entrevistas (id_usuario, tituloE, objetivo, nombre_entrevistado, estado, fecha_inicio, fecha_final)
              VALUES ('$id_usuario', '$tituloE', '$objetivo','$nombre_entrevistado', '0', '$fecha_inicio', '$fecha_final')";

    $resultado = $con->query($query);

}
