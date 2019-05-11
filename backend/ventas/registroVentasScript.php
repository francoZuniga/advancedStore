<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();
//contamos los archivos necesarios
require_once("../../../coneccionBD/coneccion.php");
require_once("../../lib/baseDatos/almacen.php");
require_once("../../lib/baseDatos/ventas.php");
require_once("../../lib/baseDatos/salida.php");
require_once("../../lib/baseDatos/stock.php");
require_once("../../lib/baseDatos/productos.php");
//creamos una venta
$controlVenta = new Ventas();
$controlSalida = new Salida();
$controlStock = new Stock();
$controlAlmacen = new Almacen();

//cremos la venta y tomamos los datos
$venta = $controlVenta->setVentas($_SESSION['arrayProductos'][0][2], $_SESSION['arrayProductos'][0][3], $_SESSION['legajo']);
$numeroFactuaA = $controlVenta->getNumeroFactura();

//creamos un movimiento de stock y tomamos los datos
$venta = $controlStock->setStock($_SESSION['arrayProductos'][0][2], $_SESSION['arrayProductos'][0][3]);
$numeroMovimiento = $controlStock->getIdMovimiento();


//registramos todos la salida de la venta
$longitud = count($_SESSION['arrayProductos']);

for ($i=0; $i < $longitud; $i++) {
  $salida = $controlSalida->setSalida($numeroMovimiento, $numeroFactuaA, $_SESSION['arrayProductos'][$i][0], $_SESSION['arrayProductos'][$i][1]);
}
for ($j=0; $j < $longitud; $j++) {
  $controlAlmacen->setAlmacen($_SESSION['arrayProductos'][$j][2], $_SESSION['arrayProductos'][$j][3],$_SESSION['arrayProductos'][$j][0], -$_SESSION['arrayProductos'][$j][1]);
  $controlProductos = new Productos();
  $controlProductos->setProductoId($_SESSION['arrayProductos'][$j][0]);
  $cantidad = $controlProductos->getCantidad();
  $cantidad = $cantidad - $_SESSION['arrayProductos'][$j][1];
  $controlProductos->setCantidad($cantidad);
}
if ($salida) {
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
