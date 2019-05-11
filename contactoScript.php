<?php

      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );

      $user = $_POST['nombre'];
      //armamos el email
      $from = $_POST['destino'];
      $subject = "Checking PHP mail";
      $message = $_POST['mensaje'];
      $headers = "From:" . $user;
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
        header("Location: contacto.php");
      }
?>
