<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();

require_once("../../lib/baseDatos/imagenPublicacion.php");
require_once("../../lib/baseDatos/fichaAudio.php");
require_once("../../lib/baseDatos/fichaAccesorios.php");
require_once("../../lib/baseDatos/fichaVariedad.php");
require_once("../../lib/baseDatos/productos.php");
require_once("../../lib/baseDatos/publicaciones.php");
require_once("../../../coneccionBD/coneccion.php");

$imagenes = new imagenPublicacion();
$publicacion = new Publicaciones();
$producto = new Productos();

$productoActual = $producto->setProductoId($_POST['idProducto']);
$publicacionProductoActual = $publicacion->setPublicacionProductoId($_POST['idProducto']);


if ($publicacionProductoActual) {
  $idPublicacion = $publicacion->getIdPublicacion();
  $tipoProducto = $producto->getTipo();

  $filasimagenes = $imagenes->setImagenPublicacionIdPublicacion($idPublicacion);
  foreach ($filasimagenes as $fila) {
      $imagenes->unsetImagenProducto($idPublicacion, $fila['URL']);
  }
  $eliminar = $publicacion->unsetPublicacion($idPublicacion);

  switch ($tipoProducto) {
    case 'accesorios':
      $fichaAccesorios = new fichaAccesorios();
      $fichaActual = $fichaAccesorios->unsetFicha($_POST['idProducto']);
    break;
    case 'audio':
      $fichaAudio = new fichaAudio();
      $fichaActual = $fichaAudio->unsetFicha($_POST['idProducto']);
    break;
    case 'variedad':
      $fichaVariedad = new fichaVariedad();
      $fichaActual = $fichaVariedad->unsetFicha($_POST['idProducto']);
    break;
    default:
    break;
  }

  if ($eliminar && $fichaActual){
    $_SESSION['error'] = "
    <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
      se a des-publicado con exito!!.
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times;</span>
      </button>
    </div>
    ";
    header("Location: index.php");
  }
  else{
    $_SESSION['error'] = "
    <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
      se a des-publicado con exito!!.
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times;</span>
      </button>
    </div>
    ";
    header("Location: index.php");
  }
}
else{
  $_SESSION['error'] = "
  <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
    se a eliminado con exito!!.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>
  ";
  header("Location: index.php");
}
 ?>
