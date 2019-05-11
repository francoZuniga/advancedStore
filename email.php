<?php
    session_start();
    require_once("lib/baseDatos/usurios.php");
    require_once("lib/baseDatos/empleados.php");
    require_once("../coneccionBD/coneccion.php");

    //verificamos que el usuario ya exista!!
    $controlUsuario = new Usurio();//controlador de usuario
    $control = $controlUsuario->getUsurio($_POST['email']);//obtenemos los datos de ese usurio

    if ($control) {
      $_SESSION['login'] = "
      <div class=\"alert alert-danger\" role=\"alert\">
        el usuario ya existe!!
      </div>
      ";
      header("Location: crearUsuario.php");
    }
    else {
      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );

      $user = $_POST['email'];
      $nombre = $_POST['nombre'];
      $pass = $_POST['contraseña'];
      //armamos el email
      $from = "fra.zu345@gmail.com";
      $subject = "Checking PHP mail";
      $message = "<p style=\"color: #fgfdsd;\">ingresa al siguiente link para poder verificar su usuario https://advancedstorebeta.000webhostapp.com/loginBackend/scriptUsuario.php?usuario=".$user."&contraseña=".$pass."&nombre=".$nombre."</p>";
      $headers = "From:" . $from;
      $controlEmail = mail($user,$subject,$message, $headers);
      if ($controlEmail) {
        $mensaje = "necesitamos que verifiques tu email, por favor ve a tu cuanta de e-mail y vericalo!!";
      }
      else {
        $_SESSION['login'] = "
        <div class=\"alert alert-danger\" role=\"alert\">
          no se puedo enviar el email!!
        </div>
        ";
        header("Location: crearUsuario.php");
      }
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
    <div class="alert alert-secondary" role="alert" style="width: 80%; margin: 0 auto; margin-top: 15%;">
      <h4 class="alert-heading">verificacion de email</h4>
      <p>por favor verifique su email</p>
      <hr>
      <p class="mb-0"><a href="https://mail.google.com/">ir a Gmail</a></p>
      <p class="mb-0"><a href="https://outlook.live.com/">ir a outlook</a></p>
    </div>
  <?php require_once("coockies.php") ?>
</body>
</html>
