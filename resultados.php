<?php 

	include 'bd/conexion.php';
	$id_encuesta = $_GET['id_encuesta'];

	/* Consulta para extraer título y descripción de la encuesta*/
	$query3 = "SELECT * FROM encuestas WHERE id_encuesta = '$id_encuesta'";
	$resultados3 = $conn->query($query3);
	$row3 = $resultados3->fetch_assoc();

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="styless.css">

  <link rel="stylesheet" href="datatables/datatables.min.css">
  <link rel="stylesheet" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
 
  <script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>

  <title>Resultados</title>
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

  	<div class="container" style="margin-top: 50px;">
  		
  	<?php

  	$consulta = "SELECT * FROM preguntas WHERE id_encuesta = '$id_encuesta'";
	$resultados2 = $conn->query($consulta);

	 ?>

	<hr/>
	<div class="container text-center">
		<h1><?php echo $row3['titulo'] ?></h1>
		<p><?php echo $row3['descripcion'] ?></p>
	</div>
	<hr/>

	<?php
		while ($row2 = $resultados2->fetch_assoc()) {
		
		$id_pregunta = $row2['id_pregunta'];

		$query = "SELECT preguntas.id_pregunta, preguntas.titulo,COUNT('preguntas.titulo') as count, opciones.valor FROM opciones INNER JOIN preguntas ON opciones.id_pregunta=preguntas.id_pregunta INNER JOIN resultados ON opciones.id_opcion=resultados.id_opcion WHERE preguntas.id_pregunta = '$id_pregunta' GROUP BY opciones.valor ORDER BY preguntas.id_pregunta";
		$resultados = $conn->query($query);

				/*TITULO*/
		echo "<h3>" . $row2['titulo'] . "</h3>";

		$cantidades = array();
		$titulos = array();
		$tamaño = array(); 
		$i = 1;
		while ($row = $resultados->fetch_assoc()) {
			$cantidades[$i] = 0;
			$cantidades[$i] = $row['count'];
			$titulos[$i] = $row['valor'];
			$i++;
		}

		$opciones = $i - 1;
		for ($i = 1; $i <= $opciones; $i++) {

		?>

		<input type="hidden" class="<?php echo "valor$i" ?>" value="<?php echo $cantidades[$i] ?>">
		<input type="hidden" class="<?php echo "titulo$i" ?>" value="<?php echo $titulos[$i] ?>">

		<?php  
		}
		?>
		<input type="hidden" class="tamaño" value="<?php echo $opciones ?>">		
		
		<div class="container" style="width: 50%; margin: 0 auto; width: 400px;">		
			<canvas class="oilChart" width="600" height="400"></canvas>
		</div>

		<script type="text/javascript" src="resultados.js"></script>
		
		<hr/>

	<?php


	}
  	 ?>

  	<!-- Optional JavaScript -->
  	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
  	<script src="../js/jquery-3.3.1.min.js"></script>
  	<script src="../js/popper.min.js"></script>
  	<script src="../js/bootstrap.min.js"></script>
</body>
</html>

