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
    <title>Creación de encuestas y entrevista</title>

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
	                    Agregar Encuesta
	                </button>
	        	</div>
	        </div>
	    </div>
	    <hr/>
	    <div class="row">
	        <div class="col-md-12">
	            <h4>Encuestas:</h4>
	            <div class="table-responsive">
	            	<div id="tabla_encuestas"></div>
	            </div>
	        </div>
	    </div>
	</div>

  <div class="container" style="margin-top: 30px;">
	    <div class="row">
	        <div class="col-md-12 row">
	        	<div class="col-md-10 col-xs-12">
	        		<h3>SISTEMA DE ENTREVISTA</h3>
	        	</div>
	        	<div class="col-md-2 col-xs-12">
	        		 <button class="float-right btn btn-primary" id="boton_agregar_entrevista">
	                    Agregar Entrevistas
	                </button>
	        	</div>
	        </div>
	    </div>
	    <hr/>
	    <div class="row">
	        <div class="col-md-12">
	            <h4>Entrevistas:</h4>
	            <div class="table-responsive">
	            	<div id="tabla_entrevista"></div>
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
    
    <script type="text/javascript" src="encuestass.js"></script>
    <script type="text/javascript" src="entrevista.js"></script>
</body>
</html>

<!-- Modal Agregar Nueva Encuesta -->
<div class="modal fade" id="modal_agregar" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            	<h4 class="modal-title">Agregar Nueva Encuesta</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

            	<div class="form-group row">
      					<label for="titulo" class="col-sm-3 col-form-label">Título</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="titulo" placeholder="Título" autocomplete="off" autofocus>
      					</div>
      				</div>
              <div class="form-group row">
                <label for="descripcion" class="col-sm-3 col-form-label">Descripción</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="descripcion" placeholder="Descripción"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="fecha_final" class="col-sm-3 col-form-label">Fecha Final</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="fecha_final" value="<?php echo $fecha_inicio ?>"  autocomplete="off">
                  <p>Fomato: año-mes-día horas:minutos:segundos</p>
                </div>
              </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="agregarEncuesta()">Agregar Encuesta</button>
                <input type="hidden" id="hidden_id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
              </div>
        </div>
    </div>
</div>

<!-- Modal Modificar Producto -->
<div class="modal fade" id="modal_modificar" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            	<h4 class="modal-title">Modificar Producto</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

            	<div class="form-group row">
      					<label for="modificar_titulo" class="col-sm-3 col-form-label">Título</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="modificar_titulo" placeholder="Título">
      					</div>
      				</div>

              <div class="form-group row">
                <label for="descripcion" class="col-sm-3 col-form-label">Descripción</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="modificar_descripcion" placeholder="Descripción"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="fecha_final" class="col-sm-3 col-form-label">Fecha Final</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="modificar_fecha_final" placeholder="Fecha de Cierre" autocomplete="off"
                  value="<?php echo $fecha_inicio ?>">
                  <p>Fomato: año-mes-día horas:minutos:segundos</p>
                </div>
              </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="modificarDetallesEncuesta()">Modificar Encuesta</button>
                <input type="hidden" id="hidden_id_encuesta">
            </div>

        </div>
    </div>
</div>

<!-- Modal Agregar Nueva Entrevista -->
<div class="modal fade" id="modal_agregar_entrevista" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            	<h4 class="modal-title">Agregar Nueva Entrevista</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

              <div class="form-group row">
      					<label for="tituloE" class="col-sm-3 col-form-label">Titulo de la Entrevista</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="tituloE" placeholder="Titulo" autocomplete="off" autofocus>
      					</div>
      				</div>
              <div class="form-group row">
                <label for="objetivo" class="col-sm-3 col-form-label">Objetivo de la entrevista</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="objetivo" placeholder="Objetivo"></textarea>
                </div>
              </div>
              <div class="form-group row">
      					<label for="nombre_entrevistado" class="col-sm-3 col-form-label">Nombre del entrevistado</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="nombre_entrevistado" placeholder="Nombre entrevistado" autocomplete="off" autofocus>
      					</div>
      				</div>
              <div class="form-group row">
                <label for="fecha_final" class="col-sm-3 col-form-label">Fecha Final</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="fecha_final" value="<?php echo $fecha_inicio ?>"  autocomplete="off">
                  <p>Fomato: año-mes-día horas:minutos:segundos</p>
                </div>
              </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="agregarEntrevista()">Agregar Entrevista</button>
                <input type="hidden" id="hidden_id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
              </div>
        </div>
    </div>
</div>

<!-- Modal Modificar Producto -->
<div class="modal fade" id="modal_modificar_entrevista" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            	<h4 class="modal-title">Modificar Producto</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

            	<div class="form-group row">
      					<label for="modificar_tituloE" class="col-sm-3 col-form-label">Título</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="modificar_tituloE" placeholder="Título">
      					</div>
      				</div>

              <div class="form-group row">
                <label for="descripcion" class="col-sm-3 col-form-label">Objetivo</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="modificar_objetivo" placeholder="Descripción"></textarea>
                </div>
              </div>

              <div class="form-group row">
      					<label for="nombre_entrevistado" class="col-sm-3 col-form-label">Nombre del entrevistado</label>
      					<div class="col-sm-9">
      						<input type="text" class="form-control" id="modificar_nombre_entrevistado" placeholder="Título">
      					</div>
      				</div>


              <div class="form-group row">
                <label for="fecha_final" class="col-sm-3 col-form-label">Fecha Final</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="modificar_fecha_final" placeholder="Fecha de Cierre" autocomplete="off"
                  value="<?php echo $fecha_inicio ?>">
                  <p>Fomato: año-mes-día horas:minutos:segundos</p>
                </div>
              </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="modificarDetallesEntrevista()">Modificar Entrevista</button>
                <input type="hidden" id="hidden_id_entrevista">
            </div>

        </div>
    </div>
</div>