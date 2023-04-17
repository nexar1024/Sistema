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
$id_entrevista = $_GET['id_entrevista'];

$sql = "SELECT preguntasentrevista.id_pregunta, preguntasentrevista.titulo, preguntasentrevista.id_entrevista
FROM preguntasentrevista
INNER JOIN entrevistas
ON preguntasentrevista.id_entrevista = entrevistas.id_entrevista
WHERE preguntasentrevista.id_entrevista = '$id_entrevista'";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($conexion, $sql)) die();

$preguntasentrevista = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
    $pregunta_titulo=$row['titulo'];
    $preguntasentrevista_id_pregunta=$row['id_pregunta'];
    $preguntasentrevista_id_entrevista=$row['id_entrevista'];
    
    
    $preguntasentrevista['data'][] = array('id_pregunta'=> $preguntasentrevista_id_pregunta, 'titulo'=> $pregunta_titulo, 'id_entrevista'=> $preguntasentrevista_id_entrevista
);

}
    
//desconectamos la base de datos
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
$json_string = json_encode($preguntasentrevista);
echo $json_string;

//Si queremos crear un archivo json, sería de esta forma:
/*
$file = 'clientes.json';
file_put_contents($file, $json_string);
*/
    

?> 