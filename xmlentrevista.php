<?php
require("db.php");

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}


$query = "SELECT * FROM usuarios_entrevistas INNER JOIN usuarios 
ON usuarios_entrevistas.id_usuario = usuarios.id_usuario";
$result = mysqli_query($conn,$query);
if (!$result) {
  die('Invalidproyecto query: ' . mysqli_error());
}

header("Content-type: text/xml");


echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;

while ($row = @mysqli_fetch_assoc($result)){

  echo '<marker ';
  echo 'id_usuario="' . $row['id_usuario'] . '" ';
  echo 'id_entrevista="' . $row['id_entrevista'] . '" ';
  echo 'latitud="' . $row['latitud'] . '" ';
  echo 'longitud="' . $row['longitud'] . '" ';
  echo 'nombres="' . $row['nombres'] . '" ';
  echo 'apellidos="' . $row['apellidos'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}


echo '</markers>';

?>
