<?php 	

session_start();

$email = $_POST['email'];
echo $id_usuario;
$clave 	= $_POST['clave'];
echo $clave;
include("bd/conexion.php");

$query = "SELECT * FROM usuarios WHERE email = '$email' AND clave = '$clave'";
	

	$resultado = $conn->query($query);

	
	if ($row = $resultado->fetch_assoc()) {


		if ($row['id_tipo_usuario'] == '1') {
			$_SESSION['id_usuario'] = $row['id_usuario'];
			$_SESSION['u_usuario'] = $row['nombres'];
			header("Location: principal.php");
		} else {
			$_SESSION['id_usuario'] = $row['id_usuario'];
			$_SESSION['u_usuario'] = $row['nombres'];
			header("Location: index.php");
		}

	} else {
		header("Location: index.php");
	}

	if (!$query) {
	    printf("Error: %s\n", mysqli_error($con));
	    exit();
	}
	

 ?>