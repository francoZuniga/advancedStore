<?php
session_start();
require_once("lib/baseDatos/carrito.php");
require_once("../coneccionBD/coneccion.php");

$controlCarrito = new Carrito();
$controlCarrito->setCarrito($_SESSION['id-usuario'], $_POST['idCarrito'], 1);

 ?>
