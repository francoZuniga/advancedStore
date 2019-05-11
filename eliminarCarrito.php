<?php 
session_start();
require_once("lib/baseDatos/carrito.php");
require_once("../coneccionBD/coneccion.php");

$controlCarrito = new Carrito();
$carrito = $controlCarrito->setCarritoProducto($_SESSION['id-usuario'], $_POST['sacar']);

if ($carrito){
   $controlCarrito->unsetProducto($_POST['sacar']);
   header("Location: carrito.php");
}
else{
  echo "no la cosa";
}
unset($_POST['sacar']);
 ?>