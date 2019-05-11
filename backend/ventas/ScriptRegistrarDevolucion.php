<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();
//contamos los archivos necesarios
require_once("../../../coneccionBD/coneccion.php");
require_once("../../lib/baseDatos/devolciones.php");
require_once("../../lib/baseDatos/entradaDevolucion.php");
require_once("../../lib/baseDatos/salida.php");
require_once("../../lib/baseDatos/almacen.php");
require_once("../../lib/baseDatos/stock.php");
//creamos una venta
$controlDevolucion = new devoluciones();
$controlEntradaDevolucion = new entradaDevoluciones();
$controlStock = new Stock();
$controlSalida = new Salida();
$controlAlamcen = new Almacen();

//creamos la devolucion
$devolucion = $controlDevolucion->setDevoluciones($_POST['fecha'], $_POST['hora'], $_SESSION['legajo'], $_POST['idFactura']);
$numeroFactuaD = $controlDevolucion->getFacturaD();

//creamos un movimiento de stock y tomamos los datos
$stock = $controlStock->setStock($_SESSION['arrayProductos'][0][2], $_SESSION['arrayProductos'][0][3]);
$numeroMovimiento = $controlStock->getIdMovimiento();

//registramos todos la salida de la venta
$entradaDevolucion = $controlEntradaDevolucion->setEntradaDevolucion($numeroFactuaD, $numeroMovimiento, $_SESSION['legajo']);

//registramos las entradas en el almacen
$salida = $controlSalida->setSalidaNumeroFactura($_POST['idFactura']);
foreach($salida as $fila){
  $controlAlamcen->setAlmacen($_POST['fecha'], $_POST['hora'], $fila['ProductoId'], $fila['cantidad']);
}

if ($devolucion && $stock && $entradaDevolucion) {
  $_SESSION['fallo'] = "
  <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
    se a podido cargar la venta!!.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>";
  header("Location: index.php");
}
else {
  $_SESSION['fallo'] = "
  <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
    no se a podido cargar la venta!!. contacte el soporte
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>";

  header("Location: index.php");
}
 ?>
