<?php 
include("bd/conexion.php");

//$arrLat = array();
//$arrLng = array();
$arrLatLng = array();
$result = '';

$sql = "SELECT latitud,longitud from usuarios_encuestas";
$result = $conn->query($sql);
while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
  //$arrLat[] = $row["latitud"];
  //$arrLng[] = $row["longitud"];
  //$arrLatLng[] = array_combine($arrLat,$arrLng);
  $arrLatLng[] = "new google.maps.LatLng(".$row["latitud"].",".$row["longitud"].")";
}
$result = json_encode($arrLatLng);

//echo $result;
//$result = str_replace("[[","[",$result);
//$result = str_replace("]]","]",$result);
$result = str_replace('"','',$result);
//echo $result;

?>
<!DOCTYPE html>
<!--
 @license
 Copyright 2019 Google LLC. All Rights Reserved.
 SPDX-License-Identifier: Apache-2.0
-->
<html>
  <head>
    <title>Heatmaps</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


	  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./stylesmaps.css" />
      
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
    <h2>Mapa de calor de las Encuestas</h2> 
    <br>
   
    <div id="floating-panel">
      <button id="toggle-heatmap">Heatmap</button>
      <button id="change-gradient">Gradiente</button>
      <button id="change-radius">Radio</button>
      <button id="change-opacity">Opacidad</button>
    </div>
    <div id="map"></div>

    <script>
    let map, heatmap;

    function initMap() {
      map = new google.maps.Map(document.getElementById("map"), {
      zoom: 14,
      center: { lat: -0.958004, lng: -80.734255 },
      mapTypeId: "roadmap",
    });
      heatmap = new google.maps.visualization.HeatmapLayer({
      data: getPoints(),
      map: map,
    });
  
    document
      .getElementById("toggle-heatmap")
      .addEventListener("click", toggleHeatmap);
    document
      .getElementById("change-gradient")
      .addEventListener("click", changeGradient);
    document
      .getElementById("change-opacity")
      .addEventListener("click", changeOpacity);
    document
      .getElementById("change-radius")
      .addEventListener("click", changeRadius);
    }

  function toggleHeatmap() {
    heatmap.setMap(heatmap.getMap() ? null : map);
  }

  function changeGradient() {
    const gradient = [
      "rgba(0, 255, 255, 0)",
      "rgba(0, 255, 255, 1)",
      "rgba(0, 191, 255, 1)",
      "rgba(0, 127, 255, 1)",
      "rgba(0, 63, 255, 1)",
      "rgba(0, 0, 255, 1)",
      "rgba(0, 0, 223, 1)",
      "rgba(0, 0, 191, 1)",
      "rgba(0, 0, 159, 1)",
      "rgba(0, 0, 127, 1)",
      "rgba(63, 0, 91, 1)",
      "rgba(127, 0, 63, 1)",
      "rgba(191, 0, 31, 1)",
      "rgba(255, 0, 0, 1)",
    ];

    heatmap.set("gradient", heatmap.get("gradient") ? null : gradient);
  }

    function changeRadius() {
      heatmap.set("radius", heatmap.get("radius") ? null : 20);
    }

    function changeOpacity() {
      heatmap.set("opacity", heatmap.get("opacity") ? null : 0.2);
    }

    // Heatmap data: 500 Points
    function getPoints() {

      return <?php echo $result;?>;
    
    }

    window.initMap = initMap;
    </script>

    <!-- 
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
    
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-rbnMxufATlyLIILejVqxKo4MZo-6jRs&callback=initMap&libraries=visualization&v=weekly"
      defer
    ></script>
  </body>

  <!--jQuery, Popper.js, Bootstrap JS-->
  <script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</html>
