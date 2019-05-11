<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();

if ($_SESSION['cargarPublicacion'] != 1){
    $_SESSION['errorCarga'] = "
      <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
        no se puede saltar este paso!!
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
          <span aria-hidden=\"true\">&times;</span>
        </button>
      </div>";
    header("Location: cargarFicha.php");
}
$_SESSION['fichaVariedad'] = array($_POST['modelo'], $_POST['marca'], $_POST['tipoProducto'] , $_POST['descripcion']);

if (!empty($_SESSION['fichaVariedad'])) {
  $_SESSION['cargarPublicacion'] = 2;
  header("Location: scriptPublicacion.php");
}

 ?>
