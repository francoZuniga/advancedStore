<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();

$_SESSION['cargarProducto'];

if ($_SESSION['cargarPublicacion'] != 1){
  /*
    $_SESSION['errorCarga'] = "
      <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
        no se puede saltar este paso!!
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
          <span aria-hidden=\"true\">&times;</span>
        </button>
      </div>";
    header("Location: cargarFicha.php");*/
}
$_SESSION['fichaAccesorios'] = array($_POST['modelo'], $_POST['marca'], $_POST['celulares'],  $_POST['descripcion']);

if (!empty($_SESSION['fichaAccesorios'])) {
  $_SESSION['cargarPublicacion'] = 2;
  header("Location: scriptPublicacion.php");
}
else {
  echo $_SESSION['errorCarga'] =
  "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
    no se pudo cargar la ficha!! contacte al soporte.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>";
}
 ?>
