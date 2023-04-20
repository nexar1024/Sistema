<?php 

  date_default_timezone_set("America/Lima");
  $date = new DateTime();

  $fecha_inicio = $date->format('Y-m-d H:i:s');
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de usuarios</title>

    <script type="text/javascript" language="javascript">   
      history.pushState(null, null, location.href);
      window.onpopstate = function () {
        history.go(1);
      };
    </script>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styless.css">

    <link rel="stylesheet" href="datatables/datatables.min.css">
    <link rel="stylesheet" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
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
    <!-- Content Section -->
	<div class="container" style="margin-top: 30px;">
	    <div class="row">
	        <div class="col-md-12 row">
	        	<div class="col-md-10 col-xs-12">
	        		<h3>SISTEMA DE ENCUESTAS</h3>
	        	</div>
	        	<div class="col-md-2 col-xs-12">
	        		 <button class="float-right btn btn-primary" id="boton_agregar">
	                    Agregar Usuarios
	                </button>
	        	</div>
	        </div>
	    </div>
	    <hr/>
	    <div class="row">
	        <div class="col-md-12">
	            <h4>Usuarios:</h4>
	            <div class="table-responsive">
	            	<div id="tabla_usuarios"></div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- /Content Section -->

    <!--jQuery, Popper.js, Bootstrap JS-->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!--datatable JS-->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    
    <script type="text/javascript" src="usuario.js"></script>
</body>
</html>

<!-- Modal Agregar Nuevo Usuarios -->
<div class="modal fade" id="modal_agregar" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            	<h4 class="modal-title">Agregar Nuevo Usuario</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

            	<div class="form-group row">
      					<label for="nombres" class="col-sm-3 col-form-label">Nombres</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="nombres" placeholder="Nombres" autocomplete="off" autofocus>
      					</div>
      				</div>
              <div class="form-group row">
      					<label for="apellidos" class="col-sm-3 col-form-label">Apellidos</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="apellidos" placeholder="Apellidos" autocomplete="off">
      					</div>
      				</div>
              <div class="form-group row">
      					<label for="email" class="col-sm-3 col-form-label">Email</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="email" placeholder="Email" autocomplete="off">
      					</div>
      				</div>
              <div class="form-group row">
      					<label for="clave" class="col-sm-3 col-form-label">Clave</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="clave" placeholder="Clave" autocomplete="off">
      					</div>
      				</div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="agregarUsuario()">Agregar Usuario</button>
                <input type="hidden" id="hidden_id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
              </div>
        </div>
    </div>
</div>

<!-- Modal Modificar Usuario -->
<div class="modal fade" id="modal_modificar" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            	<h4 class="modal-title">Modificar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

            	<div class="form-group row">
      					<label for="modificar_nombres" class="col-sm-3 col-form-label">Nombres</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="modificar_nombres" placeholder="Nombres">
      					</div>
      				</div>

              <div class="form-group row">
      					<label for="modificar_apellidos" class="col-sm-3 col-form-label">Apellidos</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="modificar_apellidos" placeholder="Apellidos">
      					</div>
      				</div>

              <div class="form-group row">
      					<label for="modificar_email" class="col-sm-3 col-form-label">Email</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="modificar_email" placeholder="Email">
      					</div>
      				</div>

              <div class="form-group row">
      					<label for="modificar_clave" class="col-sm-3 col-form-label">Clave</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="modificar_clave" placeholder="Clave">
      					</div>
      				</div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="modificarDetallesUsuario()">Modificar Usuario</button>
                <input type="hidden" id="hidden_id_usuario">
            </div>

        </div>
    </div>
</div>