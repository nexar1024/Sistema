<?php
// Validar consulta
if (isset($_POST['id_entrevista']) && isset($_POST['id_entrevista']) != "") {
    // Incluir archivo de conexión a base de datos
    include ("../bd/conexion.php");

    // Obtener id_encuesta
    $id_entrevista = $_POST['id_entrevista'];

    // Eliminar encuesta
    $query = "DELETE FROM entrevistas WHERE id_entrevista = '$id_entrevista'";
    $resultado = $con->query($query);
}
