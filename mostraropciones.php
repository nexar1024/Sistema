<?php

include("bd/conexion.php") ;

$id_pregunta = $_GET['id_pregunta'];

$query = "SELECT * FROM preguntas WHERE id_pregunta = '$id_pregunta'";
$respuesta = $con->query($query);
$row = $respuesta->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opciones Preguntas</title>

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
              <h3><?php echo $row['titulo'] ?></h3>
            </div>
            <div class="col-md-2 col-xs-12">
               <button class="float-right btn btn-primary" id="boton_agregar">
                  Agregar Opción
                </button>
            </div>
          </div>
      </div>
      <hr/>
      <div class="row">
          <div class="col-md-12">
              <h4>Opciones:</h4>
              <input type="hidden" id="id_pregunta" value="<?php echo $row['id_pregunta'] ?>">
              <div class="table-responsive">
                <div id="tabla_opciones"></div>
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
    
    <script type="text/javascript" src="opcioness.js"></script>
</body>
</html>

<!-- Modal Agregar Nueva Opción -->
<div class="modal fade" id="modal_agregar" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Agregar Nueva Opción</h4>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div class="form-group row">
                <label for="valor" class="col-sm-3 col-form-label">Valor</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="valor" placeholder="Valor" autocomplete="off" autofocus>
                </div>
              </div>         
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="agregarOpcion()">Agregar Opción</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal Modificar Pregunta -->
<div class="modal fade" id="modal_modificar" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Modificar Opción</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
              <div class="form-group row">
                <label for="modificar_valor" class="col-sm-3 col-form-label">Valor</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="modificar_valor" placeholder="Valor">
                </div>
              </div>           
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="modificarDetallesOpcion()">Modificar Opción</button>
                <input type="hidden" id="hidden_id_opcion">
            </div>

        </div>
    </div>
</div>