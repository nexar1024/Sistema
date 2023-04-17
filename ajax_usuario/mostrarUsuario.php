<?php

// Incluimos el archivo de conexión a base de datos
include ("../bd/conexion.php");

// Diseñamos el encabezado de la tabla
$data = '
    <table class="table table-bordered table-hover table-condensed">
        <thead class="thead-dark">
            <tr>
                <th>ID usuario</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Clave</th>
                <th>Accciones</th>
            </tr>
        </thead>';

$query = "SELECT * FROM usuarios ORDER BY id_usuario DESC";
$resultado = $con->query($query);

while ($row = $resultado->fetch_assoc()) {
    $data .= '
        <tbody>
            <tr>
                <td>' . $row["id_usuario"] . '</td>
                <td>' . $row['nombres'] . '</td>
                <td>' . $row["apellidos"]. '</td>
                <td>' . $row["email"] . '</td>
                <td>' . $row["clave"] . '</td>
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