<?php

// Incluimos el archivo de conexión a base de datos
include ("../bd/conexion.php");

if (isset($_POST['id_entrevista'])) {
    $id_entrevista = $_POST['id_entrevista'];
}

// Diseñamos el encabezado de la tabla
$data = '
    <table class="table table-bordered table-hover table-condensed">
        <thead class="thead-dark">
            <tr>
                <th>ID Pregunta</th>
                <th>Título</th>
                <th>Accciones</th>
            </tr>
        </thead>';

$query = "SELECT preguntasentrevista.id_pregunta, preguntasentrevista.id_entrevista, preguntasentrevista.titulo
            FROM preguntasentrevista
            WHERE preguntasentrevista.id_entrevista = '$id_entrevista'";

$resultado = $con->query($query);

while ($row = $resultado->fetch_assoc()) {
    $data .= '
        <tbody>
            <tr>
                <td>' . $row["id_pregunta"] . '</td>
                <td><a href="mostraropcionesentrevista.php?id_pregunta=' . $row['id_pregunta'] . '">' . $row['titulo'] . '</a></td>
                <td>
                    <button onclick="obtenerDetallesPregunta(' . $row['id_pregunta'] . ')" class="btn btn-warning">Modificar</button>
                    <button onclick="eliminarPregunta(' . $row['id_pregunta'] . ')" class="btn btn-danger">Eliminar</button>
                </td>
            </tr>
        </tbody>';
}

$data .= '</table>';

echo $data; 