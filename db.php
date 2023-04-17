<?php
$servername = "mysql-121747-0.cloudclusters.net";
$username = "admin";
$password = "LWWiArhJ";
$dbname = "sistema_geo_encent";
$dbServerPort = "10024";

$conn=new mysqli($servername,$username,$password,$dbname,$dbServerPort);

if($conn->connect_error){
	die("Connection Failed".$conn->connect_error);
}else{
	
}

?>