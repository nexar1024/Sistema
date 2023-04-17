<?php
// Validar consulta
if (isset($_POST['id_usuario']) && isset($_POST['id_usuario']) != "") {
    // Incluir archivo de conexión a base de datos
    include ("../bd/conexion.php");

    // Obtener id_usuario
    $id_usuario = $_POST['id_usuario'];

    // Eliminar usuario
    $query = "DELETE FROM usuarios WHERE id_usuario = '$id_usuario'";
    $resultado = $con->query($query);
}
