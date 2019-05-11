<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();
require_once("../../lib/baseDatos/imagenPublicacion.php");
require_once("../../lib/baseDatos/productos.php");
require_once("../../../coneccionBD/coneccion.php");

$productos = new Productos();

$nombreArchivo = $_FILES['imagen']['name'];
$idPublicacion = $_POST['idPublicacion'];

$ubicacionRegistro = "Media/productos2/".$nombreArchivo;
$ubicacion = "../../Media/productos2/".$nombreArchivo;
$controlImagen = $productos->getCantidadUrl($ubicacionRegistro);

if ($controlImagen == 0) {
  if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ubicacion)){
      $incercionPublicacion = new imagenPublicacion();
      $control = $incercionPublicacion->setImagenPublicacion($idPublicacion, $ubicacionRegistro);
      if ($control) {
        header("Location: cargarImagenes.php");
      }
      else{
        $_SESSION['errorCarga'] = "
        <div class=\"alert alert-danger\" role=\"alert\">
          no se ha incertado la imagen!! contacte al soporte.
        </div>";
        header("Location: cargarImagenes.php");
      }
    }
    else{
      $_SESSION['errorCarga'] = "
      <div class=\"alert alert-danger\" role=\"alert\">
        no se cargo la imagen o se repite la foto!!!
      </div>";
      header("Location: cargarImagenes.php");
    }
}
else{
  $incercionPublicacion = new imagenPublicacion();
  $control = $incercionPublicacion->setImagenPublicacion($idPublicacion, $ubicacionRegistro);
  if ($control) {
    header("Location: cargarImagenes.php");
  }
  else{
    $_SESSION['errorCarga'] = "
    <div class=\"alert alert-danger\" role=\"alert\">
      no se ha incertado la imagen!! contacte al soporte.
    </div>";
    header("Location: cargarImagenes.php");
  }
}
 ?>
