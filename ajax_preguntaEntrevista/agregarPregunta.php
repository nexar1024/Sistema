<?php

if (isset($_POST['id_entrevista']) && isset($_POST['titulo'])) {
    // Incluir archivo de conexión a base de datos
    include("../bd/conexion.php");

    // Obtener valores
    $id_entrevista 		= $_POST['id_entrevista'];
    $titulo     		= $_POST['titulo'];

    $query = "INSERT INTO preguntasEntrevista (id_entrevista, titulo)
              VALUES ('$id_entrevista', '$titulo')";

    $resultado = $con->query($query);

}
