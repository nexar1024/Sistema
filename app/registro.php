<?php 

$server = "mysql-121747-0.cloudclusters.net";
$user = "admin";
$pass = "LWWiArhJ";
$bd = "sistema_geo_encent";
$dbServerPort = "10024";

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd,$dbServerPort) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

//generamos la consulta
$sql = "SELECT * FROM encuestas";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($conexion, $sql)) die();

$encuesta = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
    $id_encuesta=$row['id_encuesta'];
    $id_usuario=$row['id_usuario'];
    $titulo=$row['titulo'];
    $descripcion=$row['descripcion'];
    $estado=$row['estado'];
    $fecha_inicio=$row['fecha_inicio'];
    $fecha_final=$row['fecha_final'];
    

    $encuesta['data'][] = array('id_encuesta'=> $id_encuesta, 'id_usuario'=> $id_usuario, 'titulo'=> $titulo, 'descripcion'=> $descripcion,
                        'estado'=> $estado, 'fecha_inicio'=> $fecha_inicio, 'fecha_final'=> $fecha_final);

}
    
//desconectamos la base de datos
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
$json_string = json_encode($encuesta);
echo $json_string;

//Si queremos crear un archivo json, sería de esta forma:
/*
$file = 'clientes.json';
file_put_contents($file, $json_string);
*/
    

?>