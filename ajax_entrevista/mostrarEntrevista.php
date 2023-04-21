<?php

// Incluimos el archivo de conexión a base de datos
include ("../bd/conexion.php");

// Diseñamos el encabezado de la tabla
$data = '
    <table class="table table-bordered table-hover table-condensed">
        <thead class="thead-dark">
            <tr>
                <th>ID entrevista</th>
                <th>Título entrevista</th>
                <th width="100">Objetivo de la entrevista</th>
                <th>Nombre del entrevistado</th>
                <th>Estado</th>
                <th>Fecha Inicio</th>
                <th>Fecha Final</th>
                <th>Accciones</th>
            </tr>
        </thead>';

$query = "SELECT * , (select audio from resultadosentrevista where resultadosentrevista.id_entrevista = entrevistas.id_entrevista order by resultadosentrevista.id_entrevista desc limit 1 ) as audio FROM entrevistas ORDER BY id_entrevista DESC";
$resultado = $conn->query($query);

while ($row = $resultado->fetch_assoc()) {



    $data .= '
        <tbody>
            <tr>
                <td>' . $row["id_entrevista"] . '</td>
                <td><a href="mostrarpreguntasentrevistas.php?id_entrevista=' . $row['id_entrevista'] . '">' . $row['tituloE'] . ' </a></td>
                <td width="100">' . $row["objetivo"] . '</td>
                <td>' . $row["nombre_entrevistado"] . '</td>
                <td>' . $row["estado"] . '</td>
                <td>' . $row["fecha_inicio"] . '</td>
                <td>' . $row["fecha_final"] . '</td>
                <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Accciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <button onclick="obtenerDetallesEntrevista(' . $row['id_entrevista'] . ')" class="dropdown-item btn btn-warning">Modificar</button>
                        <button onclick="eliminarEntrevista(' . $row['id_entrevista'] . ')" class="dropdown-item btn btn-danger">Eliminar</button>
                        <button onclick="publicarEntrevista(' . $row['id_entrevista'] . ')" class="dropdown-item btn btn-primary">Publicar</button>
                        <button onclick="finalizarEntrevista(' . $row['id_entrevista'] . ')" class="dropdown-item btn btn-secondary">Finalizar</button>
                       
                        <a class="dropdown-item btn btn-secondary" href="audiosEntrevista.php?id_entrevista=' . $row['id_entrevista'] . '">Audios</a>
                        <a class="dropdown-item btn btn-secondary" href="vistapreviaEntrevista.php?id_entrevista=' . $row['id_entrevista'] . '">Vista Previa</a>
                    </div>
                </td>
            </tr>
            <tr>

            <td colspan="7">
            <h5>Audio Relacionado:</h5>

            -> Ruta de Grabacion en nube: '.$row['audio'].'   <a href="./app/'.$row['audio'].'"  download> DESCARGAR </a>
            
            </td>

            </tr>

        </tbody>';
}


$data .= '</table>';

echo $data;