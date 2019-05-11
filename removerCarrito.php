<?php
session_start();
require_once("lib/baseDatos/carrito.php");
require_once("../coneccionBD/coneccion.php");

$controlCarrito = new Carrito();
$carrito = $controlCarrito->setCarritoProducto($_SESSION['id-usuario'], $_POST['idCarrito']);

$controlCarrito->unsetProducto($_POST['idCarrito']);
?>
