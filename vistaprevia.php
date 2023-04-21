<?php

  	require "bd/conexion.php";

  	$id_encuesta = $_GET['id_encuesta'];
 	$query2 = "SELECT * FROM preguntas WHERE id_encuesta = '$id_encuesta'";
  	$respuesta2 = $conn->query($query2);

  	$query3 = "SELECT encuestas.titulo, encuestas.descripcion, preguntas.id_pregunta, preguntas.id_encuesta, preguntas.id_tipo_pregunta 
		FROM preguntas
		INNER JOIN encuestas
		ON preguntas.id_encuesta = encuestas.id_encuesta
		WHERE preguntas.id_encuesta = '$id_encuesta'";
	$respuesta3 = $conn->query($query3);
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
    <link rel="stylesheet" href="styless.css">
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
 		<h1><?php echo $row3['titulo'] ?></h1>
 		<p><?php echo $row3['descripcion'] ?></p>
 		<form action="procesar.php" method="Post" autocomplete="off">


 		<input type="hidden" id="id_encuesta" name="id_encuesta" value="<?php echo $id_encuesta ?>" />

 		<hr />
 		<?php

 			$i = 1; 
			while (($row2 = $respuesta2->fetch_assoc())) {

			$id = $row2['id_pregunta'];

			$query = "SELECT preguntas.id_pregunta, preguntas.titulo, preguntas.id_tipo_pregunta, opciones.id_opcion, opciones.valor
				FROM opciones
				INNER JOIN preguntas
				ON preguntas.id_pregunta = opciones.id_pregunta
                WHERE preguntas.id_pregunta = $id
				ORDER BY opciones.id_pregunta, opciones.id_opcion";

			$respuesta = $con->query($query);

		 ?>
		 	<div class="container col-md-12">
			<h4><?php echo "$i. " . $row2['titulo'] ?></h4>
			
		<?php 
			while (($row = $respuesta->fetch_assoc())) {

		 ?>
			<div class="radio">
		      <label><input class="form-check-input" type="radio" name="<?php echo $row['id_pregunta'] ?>" value="<?php echo $row['id_opcion'] ?>" required> <?php echo $row['valor'] ?></label>
		    </div>

		
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