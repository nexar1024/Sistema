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
$id_encuesta = $_GET['id_encuesta'];

$sql = "SELECT preguntas.id_pregunta, preguntas.titulo, preguntas.id_encuesta, preguntas.id_tipo_pregunta 
FROM preguntas
INNER JOIN encuestas
ON preguntas.id_encuesta = encuestas.id_encuesta
WHERE preguntas.id_encuesta = '$id_encuesta'";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($conexion, $sql)) die();

$preguntas = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
    $pregunta_titulo=$row['titulo'];
    $preguntas_id_pregunta=$row['id_pregunta'];
    $preguntas_id_encuesta=$row['id_encuesta'];
    
    
    $preguntas['data'][] = array('id_pregunta'=> $preguntas_id_pregunta, 'titulo'=> $pregunta_titulo, 'id_encuesta'=> $preguntas_id_encuesta
);

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