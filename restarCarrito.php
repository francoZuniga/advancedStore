<?php
	require_once("lib/baseDatos/carrito.php");
  require_once("lib/baseDatos/productos.php");
  require_once("../coneccionBD/coneccion.php");

  $controlCarrito = new Carrito();
  $carrito = $controlCarrito->setCarritoIdCarrito($_POST['idCarrito']);
  $cantidad = 0;
  foreach ($carrito as $fila) {
  	$cantidad = $fila['cantidad'];
  	$idProducto = $fila['IdProducto'];
  }
  $controlCarrito->setCantidad($cantidad - 1, $idProducto);
 ?>
