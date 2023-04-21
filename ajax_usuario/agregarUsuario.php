<?php

if (isset($_POST['id_usuario']) && isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['email']) && isset($_POST['clave'])) {
    // Incluir archivo de conexión a base de datos
    include ("../bd/conexion.php");

    // Obtener valores
    $id_usuario  = $_POST['id_usuario'];
    $nombres     = $_POST['nombres'];
    $apellidos   = $_POST['apellidos'];
    $email       = $_POST['email'];
    $clave       = $_POST['clave'];

    $query = "INSERT INTO usuarios (nombres, apellidos, email, clave, id_tipo_usuario)
              VALUES ('$nombres', '$apellidos', '$email', '$clave','2')";

    $resultado = $conn->query($query);

}
