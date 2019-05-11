<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();
//llamamos  las librerias
require_once("../../lib/baseDatos/productos.php");
require_once("../../lib/baseDatos/entrada.php");
require_once("../../lib/baseDatos/stock.php");
require_once("../../lib/baseDatos/compra.php");
require_once("../../lib/baseDatos/publicaciones.php");
require_once("../../../coneccionBD/coneccion.php");


$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$categoria = $_POST['categoria'];
$ganancia = $_POST['ganancia'];
$precio = $_POST['precio'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
//si se publica o no
$medidas = $_POST['medimas'].",".$_POST['peso'];
//algoritmo de maximo
$maximo = 1;
$cantidad = $_POST['peso'];
while ($cantidad <= 5000) {
  $maximo++;
  $cantidad = $cantidad + $_POST['peso'];
}

if (isset($_POST['publicar']) && $_POST['publicar'] == "true") {
  $publicar = true;
}
else {
  $publicar = false;
}
$descripcion = $_POST['descripcion'];
$img = $_FILES['img']['name'];
//algoritmo de la ubicacion
$ubicacion = "../../Media/productos2/".$img;
$ubicacionRegistro = "Media/productos2/".$img;
$producto = new Productos();

if ($producto->getCantidadNombre($nombre) == 0){

  if ($producto->getCantidadUrl($ubicacion) == 0) {

    $control = move_uploaded_file($_FILES['img']['tmp_name'], $ubicacion);
    if ($control) {
      //$argNombre, $argPrecio, $argGanancia, $argCategoria, $argTipo, $argMedidas, $argMaximo, $argDescripcion, $argUrl
      $incerccionProducto = $producto->setProducto($nombre, $precio, $ganancia, $categoria, $tipo, $medidas, $_POST['peso'], $maximo, $descripcion, $ubicacionRegistro);

      if (!$incerccionProducto){
        $_SESSION['error'] = "
        <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
          no se pudo cargar el produto!!! <a href=\"#\">informar</a> del fallo
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button>
        </div>";
        header("Location: index.php");
      }
      else {
        header("Location: index.php");
      }
    }
  }
  else{
    $_SESSION['error'] = "
    <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
      se repite la imagen del producto!!!
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times;</span>
      </button>
    </div>";
    header("Location: index.php");
  }
}
else {
  $_SESSION['error'] = "
  <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
    se repite el nombre del producto!!!
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>";
  header("Location: index.php");
}
/**
 * @autor: franco agustin ojeda zuñiga.
 * @e-mail: fra.zu345@gmail.com
 */
 ?>
