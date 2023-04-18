<?php

// Incluimos el archivo de conexión a base de datos
include ("../bd/conexion.php");

// Diseñamos el encabezado de la tabla
$data = '
    <table class="table table-bordered table-hover table-condensed">
        <thead class="thead-dark">
            <tr>
                <th>ID encuesta</th>
                <th>Título</th>
                <th width="100">Descripción</th>
                <th>Estado</th>
                <th>Fecha Inicio</th>
                <th>Fecha Final</th>
                <th>Accciones</th>
            </tr>
        </thead>';

$query = "SELECT * FROM encuestas ORDER BY id_encuesta DESC";
$resultado = $con->query($query);

while ($row = $resultado->fetch_assoc()) {
    $data .= '
        <tbody>
            <tr>
                <td>' . $row["id_encuesta"] . '</td>
                <td><a href="mostrarpreguntas.php?id_encuesta=' . $row['id_encuesta'] . '">' . $row['titulo'] . '</a></td>
                <td width="100">' . mb_strimwidth($row["descripcion"], 0, 30, "...") . '</td>
                <td>' . $row["estado"] . '</td>
                <td>' . $row["fecha_inicio"] . '</td>
                <td>' . $row["fecha_final"] . '</td>
                <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Accciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <button onclick="obtenerDetallesUsuario(' . $row['id_usuario'] . ')" class="dropdown-item btn btn-warning">Modificar</button>
                        <button onclick="eliminarUsuario(' . $row['id_usuario'] . ')" class="dropdown-item btn btn-danger">Eliminar</button>
                    </div>
                </td>
            </tr>
        </tbody>';
}


$data .= '</table>';

echo $data;