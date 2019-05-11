<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();
require_once("../../lib/baseDatos/almacen.php");
require_once("../../lib/baseDatos/productos.php");
require_once("../../../coneccionBD/coneccion.php");
$controlador = new Almacen();

$longitud = count($_SESSION['arrayCompra']);
for ($j=0; $j < $longitud; $j++){
  $controlador->setAlmacen($_SESSION['arrayCompra'][$j][2], $_SESSION['arrayCompra'][$j][3],$_SESSION['arrayCompra'][$j][0], $_SESSION['arrayCompra'][$j][1]);
  $controlProductos = new Productos();
  $controlProductos->setProductoId($_SESSION['arrayCompra'][$j][0]);
  $cantidad = $controlProductos->getCantidad();
  $cantidad = $cantidad + $_SESSION['arrayCompra'][$j][1];
  $controlProductos->setCantidad($cantidad);
}

if ($controlador) {
  header("Location: index.php");
}
 ?>
