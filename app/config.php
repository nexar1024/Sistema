<?php

$host="mysql-121747-0.cloudclusters.net";
$user="admin";
$password="LWWiArhJ";
$db = "sistema_geo_encent";
$dbServerPort = "10024";
 
$con = mysqli_connect($host,$user,$password,$db,$dbServerPort);
 
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }else{  //echo "Connect"; 
  
   
   }
 
?>