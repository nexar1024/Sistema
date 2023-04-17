<?php

  	require "bd/conexion.php";

  	$id_entrevista = $_GET['id_entrevista'];
 	$query2 = "SELECT * FROM preguntasentrevista WHERE id_entrevista = '$id_entrevista'";
  	$respuesta2 = $con->query($query2);

  	$query3 = "SELECT entrevistas.tituloE, entrevistas.objetivo, preguntasentrevista.id_pregunta, preguntasentrevista.id_entrevista 
		FROM preguntasentrevista
		INNER JOIN entrevistas
		ON preguntasentrevista.id_entrevista = entrevistas.id_entrevista
		WHERE preguntasentrevista.id_entrevista = '$id_entrevista'";
	$respuesta3 = $con->query($query3);
	$row3 = $respuesta3->fetch_assoc();


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista previa encuesta</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
		<nav class="menuSis">
            <ul class= "menu">
                <li><a href="principal.php">Inicio</a></li>
                <li><a href="#">Mapa</a>
                    <ul class="submenu">
                        <li><a href="mapaEncuesta.php">Mapa de las Encuestas</a>
                        <li><a href="mapaEntrevista.php">Mapa de las Entrevistas</a>
                    </ul>
                </li>
                <li><a href="usuarios.php">Usuarios</a></li>
                <li><a href="encuestas.php">Encuestas y Entrevista</a></li>
                <li><a href="#">Reportes</a>
                    <ul class="submenu">
                        <li><a href="reportes.php">Reporte mapa de calor Encuesta</a>
                        <li><a href="reportesEntrevista.php">Reporte mapa de calor Entrevista</a>
                    </ul>
                </li>
                <li>
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    
     
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
      <span class="navbar-toggler-icon"></span>
    </button>
    

    <!--NAVBAR-->
    <div class="collapse navbar-collapse" id="navb">
      <ul class="navbar-nav mr-auto">
      </ul>
      <form class="form-inline my-2 my-lg-0" style="color: #fff">
          
      <?php   
      session_start();
        if (isset($_SESSION['u_usuario'])) {
          echo "Bienvenido " . $_SESSION['u_usuario'] . "\t";
          

          echo "<a href='cerrar_sesion.php' class='btn btn-danger' style='margin-left: 10px'>Cerrar Sesión</a>";
        } else {
          header("Location: ../index.php");
        }
        

       ?>
         
      </form>
    </div>
    </nav>

                </li>
            </ul>	
		</nav>
	</header>


    <br>
    <br>

    <center>
 	<div class="container text-center">
 		<hr /> 
 		<h1><?php echo $row3['tituloE'] ?></h1>
 		<p><?php echo $row3['objetivo'] ?></p>
 		<form action="procesar.php" method="Post" autocomplete="off">


 		<input type="hidden" id="id_entrevista" name="id_entrevista" value="<?php echo $id_entrevista ?>" />

 		<hr />
 		<?php

 			$i = 1; 
			while (($row2 = $respuesta2->fetch_assoc())) {

			$id = $row2['id_pregunta'];

			$query = "SELECT preguntasentrevista.id_pregunta, preguntasentrevista.titulo, opcionesentrevista.id_opcion, opcionesentrevista.valor
				FROM opcionesentrevista
				INNER JOIN preguntasentrevista
				ON preguntasentrevista.id_pregunta = opcionesentrevista.id_pregunta
                WHERE preguntasentrevista.id_pregunta = $id
				ORDER BY opcionesentrevista.id_pregunta, opcionesentrevista.id_opcion";

			$respuesta = $con->query($query);

		 ?>
		 	<div class="container col-md-12">
			<h4><?php echo "$i. " . $row2['titulo'] ?></h4>
			
		<?php 
			while (($row = $respuesta->fetch_assoc())) {

		 ?>
			<div class="radio">
		      <label><input type="text" name="<?php echo $row['id_pregunta'] ?>"></label>
		    </div>
		<br>
	
		<?php 	
			}
			$i++;
		}
		 ?>
		 	</div>
		<br/>
		<a href="encuestas.php" class="btn btn-primary">Regresar</a>
		
		</form>
 	</div>
	</center>

    <!--jQuery, Popper.js, Bootstrap JS-->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
 <!--jQuery, Popper.js, Bootstrap JS-->


 