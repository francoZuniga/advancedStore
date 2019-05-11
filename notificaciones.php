<?php
session_start();
require_once("loginBackend/controlSession.php");
controlAcceso();
require_once("../coneccionBD/coneccion.php");
require_once("lib/baseDatos/almacen.php");
require_once("lib/baseDatos/ventas.php");
require_once("lib/baseDatos/salida.php");
require_once("lib/baseDatos/stock.php");
require_once("lib/baseDatos/productos.php");
require_once("lib/baseDatos/ventaWeb.php");

$controlVenta = new Ventas();
$controlSalida = new Salida();
$controlStock = new Stock();
$controlAlmacen = new Almacen();
$controlVentaWeb = new ventaWeb();

$fecha = $date['year']."-".$date['mon']."-".$date['mday'];
$hora = $date['hours'].":".$date['minutes'].":".$date['seconds'].".000000";

//cremos la venta y tomamos los datos

$venta = $controlVenta->setVentas($fecha, $hora, 0);
$numeroFactuaA = $controlVenta->getNumeroFactura();

//creamos un movimiento de stock y tomamos los datos
$stock = $controlStock->setStock($fecha, $hora);
$numeroMovimiento = $controlStock->getIdMovimiento();

//registramos todos la salida de la venta
$salida = $controlSalida->setSalida($numeroMovimiento, $numeroFactuaA, $_SESSION['idProducto'], $_SESSION['cantidad']);

//instanciamos el almacen
$controlAlmacen->setAlmacen($fecha, $hora, $_SESSION['idProducto'], -$_SESSION['cantidad']);

//descontamos del productos
$controlProductos = new Productos();
$controlProductos->setProductoId($_SESSION['idProducto']);
$cantidad = $controlProductos->getCantidad();
$cantidad = $cantidad - $_SESSION['cantidad'];
$controlProductos->setCantidad($cantidad);

//instanciamos una venta en la web
$ventaWeb = $controlVentaWeb->setVentaWeb($_SESSION['id-usuario'], $numeroFactuaA, $_GET['collection_id']);


if ($salida) {
  $_SESSION['fallo'] = "
  <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
    se a podido cargar la venta!!.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>";
  header("Location: perfil.php");
}
else {
  $_SESSION['fallo'] = "
  <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
    no se a podido cargar la venta!!. contacte el soporte
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>";

  header("Location: perfil.php");
}
 ?>
