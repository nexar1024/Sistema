<?php 
$servername = "mysql-121747-0.cloudclusters.net";
$username = "admin";
$password = "LWWiArhJ";
$dbname = "sistema_geo_encent";
$dbServerPort = "10024";

// Creamos la conexión
$con = new mysqli($servername, $username, $password, $dbname,$dbServerPort);
mysqli_set_charset($con,"utf8");

// Verificamos la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
} else {
	// echo "Conexión exitosa";
}


?>