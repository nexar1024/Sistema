<?php
  session_start();   // Necesitamos una sesion
  if(isset($SESSION['u_usuario'])){  // comparamos si existe
    header("Location: validacion.php"); // si existe, lo redireccionamos a sesion.php
  }
  else{
    session_destroy();  // si no existe, destruimos sesion
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="index.css">
    <title>Administrador Login</title>
</head>
<body>
<div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="imagenes/login.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="validacion.php" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" class="form-control" placeholder="Email" required autofocus name="email">
                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required name="clave">
                <div id="remember" class="checkbox">
                    <!--
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                     -->
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Ingresar</button>
                <!--
                  <input type="submit" name="" value="Ingresar">
                -->
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>
</html>