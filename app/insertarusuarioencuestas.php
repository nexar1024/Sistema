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
$id_usuario = $_POST['id_usuario'];
$id_encuesta = $_POST['id_encuesta'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];

$sql = "INSERT INTO usuarios_encuestas(id_usuario,id_encuesta,latitud,longitud) VALUES ('".$id_usuario."','".$id_encuesta."','".$latitud."','".$longitud."')";
$result = mysqli_query($conexion,$sql);

if($result){
    echo "Encuesta guardada";
}else{
    echo "No se pudo guardar la encuesta";
}

?>