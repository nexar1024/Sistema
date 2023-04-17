<?php

include ("../bd/conexion.php");

if (isset($_POST)) {
    // Obtener valores
    $id_usuario     = $_POST['id_usuario'];
    $nombres        = $_POST['nombres'];
    $apellidos      = $_POST['apellidos'];
    $email          = $_POST['email'];
    $clave          = $_POST['clave'];

    // Modificar producto
    $query = "
        UPDATE usuarios SET
        nombres      = '$nombres',
        apellidos = '$apellidos',
        email = '$email',
        clave = '$clave' 
        WHERE id_usuario   = '$id_usuario'
    ";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}