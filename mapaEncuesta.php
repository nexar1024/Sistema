<!doctype html>
<html class="no-js" lang="">
    <head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Mapas</title>
		
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    	<link rel="stylesheet" href="styless.css">

		<link rel="stylesheet" href="datatables/datatables.min.css">
    	<link rel="stylesheet" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

		<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
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

	

    <div class="container">
        <br>
      <!-- Example row of columns -->
        <h2>Ubicación de encuestas realizadas</h2>
        <p>Puntos exactos donde fueron hechas las encuestas</p>
        <input type="search" placeholder="Buscar nombre" class="map" center>
        <div id="mapaEncuesta" class="z-depth-1-half map-container" style="height: 450px; width:100%;">
    </div>     
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        <script>
          var customLabel = {
              restaurant: {
                  label: 'R'
              },
              bar: {
                  label: 'B'
              }
          };
      
          function initMap() {
              var map = new google.maps.Map(document.getElementById('mapaEncuesta'), {
                  center: new google.maps.LatLng(-0.958004,-80.734255),
                  zoom: 13,
              heading: 90,
              tilt: 45
              });
      
              var infoWindow = new google.maps.InfoWindow;
              downloadUrl('https://sistemadegeolocalizacion.herokuapp.com/xml.php', function(data) {
                  var xml = data.responseXML;
                  var markers = xml.documentElement.getElementsByTagName('marker');
                  Array.prototype.forEach.call(markers, function(markerElem) {
              		  var persona = markerElem.getAttribute('nombres');
                      var persona_apellido = markerElem.getAttribute('apellidos');
                      var descripcion = markerElem.getAttribute('id_encuesta');
                     
                      var point = new google.maps.LatLng(
                          parseFloat(markerElem.getAttribute('latitud')),
                          parseFloat(markerElem.getAttribute('longitud')));
                      const contentString =
                          '<div id="content">' +
                          '<div id="siteNotice">' +
                          "</div>" +
                          '<center>'+
                          '<h4 id="firstHeading" class="firstHeading">'+ "Nombre de usuario que realizo la encuesta: "+persona+" "+persona_apellido+  '</h4>' +
                          '</center>'+
                          '<br>'+
                          '<div id="bodyContent">' +
                          '<br>'+
                          "<p><b>" + "Id de encuesta realizada: "+descripcion + "</p>" +
                          "</p>" +
                          "</div>" +
                          "</div>";
      
      
                      //const image = "img/soldadoss.png";
                      //  var icon = customLabel[codigo] || {};
      
               
      
                      var marker = new google.maps.Marker({
                          map: map,
                          position: point,
                          //icon: image
                      });
                      marker.addListener('click', function() {
                          infoWindow.setContent(contentString);
                          infoWindow.open(map, marker);
                      });
                  });
              });
      
              // Una matriz con las coordenadas de los límites de Bucaramanga, extraídas manualmente de la base de datos GADM
      
             
      }      
          function downloadUrl(url, callback) {
              var request = window.ActiveXObject ?
                  new ActiveXObject('Microsoft.XMLHTTP') :
                  new XMLHttpRequest;
              request.onreadystatechange = function() {
                  if (request.readyState == 4) {
                      request.onreadystatechange = doNothing;
                      callback(request, request.status);
                  }
              };
              request.open('GET', url, true);
              request.send(null);
          }
      
          function doNothing() {}
          </script>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-rbnMxufATlyLIILejVqxKo4MZo-6jRs&callback=initMap"
              defer>
          </script>
    </body>
</html>



