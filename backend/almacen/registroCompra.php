<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();
//contamos los archivos necesarios
require_once("../../../coneccionBD/coneccion.php");
require_once("../../lib/baseDatos/almacen.php");
require_once("../../lib/baseDatos/compra.php");
require_once("../../lib/baseDatos/entrada.php");
require_once("../../lib/baseDatos/stock.php");
require_once("../../lib/baseDatos/productos.php");
//creamos una venta
$controlCompra = new Compra();
$controlEntrada = new Entrada();
$controlStock = new Stock();
$controlAlmacen = new Almacen();
$ubicacionArchivo = "pdfCompra/".$_FILES['pdf']['name'];
$ubicacion = "../../pdfCompra/".$_FILES['pdf']['name'];

//cremos la venta y tomamos los datos
$compra = $controlCompra->setCompra($_SESSION['arrayCompra'][0][2], $_SESSION['arrayCompra'][0][3], $_SESSION['legajo'], $ubicacionArchivo);
$numeroFactuaA = $controlCompra->getNumeroFacturaAtributte();

//creamos un movimiento de stock y tomamos los datos
$salida = $controlStock->setStock($_SESSION['arrayCompra'][0][2], $_SESSION['arrayCompra'][0][3]);
$numeroMovimiento = $controlStock->getIdMovimiento();

//registramos todos la salida de la venta
$longitud = count($_SESSION['arrayCompra']);
for ($i=0; $i < $longitud; $i++) {
  $salida = $controlEntrada->setEntrada($numeroMovimiento, $numeroFactuaA, $_SESSION['arrayCompra'][$i][0], $_SESSION['arrayCompra'][$i][1]);
}
for ($j=0; $j < $longitud; $j++) {
  $controlAlmacen->setAlmacen($_SESSION['arrayCompra'][$j][2], $_SESSION['arrayCompra'][$j][3],$_SESSION['arrayCompra'][$j][0], $_SESSION['arrayCompra'][$j][1]);
  $controlProductos = new Productos();
  $controlProductos->setProductoId($_SESSION['arrayCompra'][$j][0]);
  $cantidad = $controlProductos->getCantidad();
  $cantidad = $cantidad + $_SESSION['arrayCompra'][$j][1];
  $controlProductos->setCantidad($cantidad);
}

$controlArchivo = move_uploaded_file($_FILES['pdf']['tmp_name'], $ubicacion);

if (!$salida && !$controlAlmacen && !$salida && !$compra && !$controlArchivo) {
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
