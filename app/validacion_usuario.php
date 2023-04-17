<?php 

$server = "mysql-121747-0.cloudclusters.net";
$user = "admin";
$pass = "LWWiArhJ";
$bd = "sistema_geo_encent";
$dbServerPort = "10024";

$json = array();
    if(isset($_GET["email"]) && isset($_GET["clave"])){
        $email = $_GET['email'];
        $clave = $_GET['clave'];

        $conexion = mysqli_connect($server,$user,$pass,$bd,$dbServerPort);

        $consulta = "SELECT email, clave, id_usuario FROM usuarios WHERE email='{$email}' AND clave='{$clave}' AND id_tipo_usuario='2'";
        $resultado = mysqli_query($conexion,$consulta);

        if($consulta){
            if($reg=mysqli_fetch_array($resultado)){
                $json['datos'][]=$reg;
            }
            mysqli_close($conexion);
            echo json_encode($json);
        }
        else{
			$results["email"]='';
			$results["clave"]='';
			$results["id_usuario"]='';
			$json['datos'][]=$results;
			echo json_encode($json);
		}
		
	}
	else{
		   	$results["email"]='';
			$results["clave"]='';
			$results["id_usuario"]='';
			$json['datos'][]=$results;
			echo json_encode($json);
		}

?>  