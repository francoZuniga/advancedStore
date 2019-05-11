<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();

$tipo = $_SESSION['tipoProducto'];
if (!isset($_SESSION['cargarProducto']) || $_SESSION['cargarProducto'] != 1) {
  header("Location: index.php");
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="../ckeditor/ckeditor.js"></script>
    <!-- estilos de bosstrap-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="productos.css">
  </head>
  <body>
    <div class="progress" style="height: 1px; margin-top: 2%;">
      <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <?php
    if (isset($_SESSION['errorCarga'])) {
      echo $_SESSION['errorCarga'];
      unset($_SESSION['errorCarga']);
    }
     ?>
    <section class="container">
      <textarea name="content" id="ckeditor" class="ckeditor">
        
      </textarea>
      <script type="text/javascript" src="productos.js"></script>
    </section>
  </body>
</html>
