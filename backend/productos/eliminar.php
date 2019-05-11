<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();
require_once("../../lib/baseDatos/imagenPublicacion.php");
require_once("../../lib/baseDatos/fichaAudio.php");
require_once("../../lib/baseDatos/fichaAccesorios.php");
require_once("../../lib/baseDatos/fichaVariedad.php");
require_once("../../lib/baseDatos/productos.php");
require_once("../../lib/baseDatos/caracteristicas.php");
require_once("../../lib/baseDatos/publicaciones.php");
require_once("../../../coneccionBD/coneccion.php");

$imagenes = new imagenPublicacion();
$publicacion = new Publicaciones();
$producto = new Productos();
$caracteristicas = new Caracteristicas();

if(isset($_POST['idProducto'])){
  global $imagenes, $publicacion, $producto;

  $publicacionControl = $publicacion->setPublicacionProductoId($_POST['idProducto']);
  $productoControl = $producto->setProductoId($_POST['idProducto']);
  $caracteristicaControl = $caracteristicas->setCaracteristicasIdProducto($_POST['idProducto']);

  $controlPublicacion = $publicacion->unsetPublicacion();
  $controlProducto = $producto->unsetProducto();
  $caracteristicaControl = $caracteristicas->unsetCaracteristicas();

  if ($controlProducto && $controlPublicacion && $caracteristicaControl) {
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
  else{
    $_SESSION['error'] = "
    <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
      no se a podido eliminar!!
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
  <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
    se a eliminado con exito!!.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>
  ";
  header("Location: index.php");
}
 ?>
