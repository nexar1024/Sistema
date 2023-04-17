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
$id = $_GET['id_pregunta'];

$sql = "SELECT preguntas.titulo, preguntas.id_pregunta,  preguntas.id_tipo_pregunta, opciones.id_opcion, opciones.valor
FROM opciones
INNER JOIN preguntas
ON preguntas.id_pregunta = opciones.id_pregunta
WHERE preguntas.id_pregunta = '$id'
ORDER BY opciones.id_pregunta, opciones.id_opcion";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($conexion, $sql)) die();

$preguntas = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
    $id_pregunta=$row['id_pregunta'];
    $id_opcion=$row['id_opcion'];
    $valor=$row['valor'];
    
    
    $preguntas['data'][] = array('id_opcion'=> $id_opcion,'valor'=> $valor, 'id_pregunta'=> $id_pregunta);

}
    
//desconectamos la base de datos
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
$json_string = json_encode($preguntas);
echo $json_string;

//Si queremos crear un archivo json, sería de esta forma:
/*
$file = 'clientes.json';
file_put_contents($file, $json_string);
*/
    

?>  