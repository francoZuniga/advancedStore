<?php
session_start();
require_once("../lib/baseDatos/usurios.php");
require_once("../lib/baseDatos/empleados.php");
require_once("../../coneccionBD/coneccion.php");

$email = $_GET['usuario'];
$nombre = $_GET['nombre'];
$contraseña = $_GET['contraseña'];

$controlUsuario = new Usurio();//controlador de usuario
$control = $controlUsuario->getUsurio($nombre);//obtenemos los datos de ese usurio
if($control){
  header("Location: ../login.php");
}
else{
  $creacion = $controlUsuario->setUsurio($nombre, $email, $contraseña, getRealIP(), 0);
}

function getRealIP() {
      if (!empty($_SERVER['HTTP_CLIENT_IP']))
          return $_SERVER['HTTP_CLIENT_IP'];

      if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
          return $_SERVER['HTTP_X_FORWARDED_FOR'];
      return $_SERVER['REMOTE_ADDR'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="Media/icono_imaguen/icono_paguina.png" rel="shortcut icon" type="image/png"/>
    <title>Inicio</title>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <!--estilos boostrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Ubuntu:400,700'>
    <link rel="stylesheet" href="Css/meinFrontendCss.css">
  </head>
  <body class="conteiner">
    <?php
    if ($creacion){
      echo "
      <div class=\"alert alert-secondary\" role=\"alert\" style=\"width: 80%; margin: 0 auto; margin-top: 15%;\">
        <h4 class=\"alert-heading\">se a creado el usuario</h4>
        <p><a href=\"../login.php\">login</a></p>
        <hr>
      </div>
      ";
    }
    else{
      echo "
      <div class=\"alert alert-secondary\" role=\"alert\" style=\"width: 80%; margin: 0 auto; margin-top: 15%;\">
        <h4 class=\"alert-heading\">no se a creado el usuario</h4>
        <p>quiere contactar al soporte!!</p>
        <hr>
      </div>
      ";
    }
    ?>
  <?php require_once("coockies.php") ?>
</body>
</html>
