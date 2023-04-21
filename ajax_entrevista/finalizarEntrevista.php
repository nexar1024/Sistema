<?php
// Validar consulta
if (isset($_POST['id_entrevista']) && isset($_POST['id_entrevista']) != "") {
    // Incluir archivo de conexión a base de datos
    include ("../bd/conexion.php");

    // Obtener id_entrevista
    $id_entrevista = $_POST['id_entrevista'];

    // Eliminar encuesta
    $query = "UPDATE entrevistas SET estado = '0' WHERE id_entrevista = '$id_entrevista'";
    $resultado = $conn->query($query);

}
