<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();
require_once("../../lib/baseDatos/imagenPublicacion.php");
require_once("../../../coneccionBD/coneccion.php");
$ubicacion = $_POST['URL'];
$idPublicacion = $_POST['idPublicacion'];

$imagenPublicacion = new imagenPublicacion();
$control = $imagenPublicacion->unsetImagenProducto($idPublicacion, $ubicacion);
if ($control) {
  $_SESSION['errorCarga'] = "
  <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
    no se pudo eliminar el la imagen!! contacte al soporte.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>";
  header("Location: cargarImagenes.php");
}
else {
  $_SESSION['errorCarga'] = "
  <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
    se a eliminado con exito!!
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>";
  header("Location: cargarImagenes.php");
}
 ?>
