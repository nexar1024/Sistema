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
$id_opcion = $_POST['id_opcion'];

$sql = "INSERT INTO resultados (id_opcion) VALUES ('$id_opcion')";
$result = mysqli_query($conexion,$sql);

if($result){
    echo "Respuesta Guardada";
}else{
    echo "No se pudo guardar la Respuesta";
}

?>