<?php
session_start();
require_once("./lib/baseDatos/favoritos.php");
require_once("../coneccionBD/coneccion.php");

$controlCarrito = new Favoritos();
$carrito = $controlCarrito->setFavoritosUsuarioProducto($_SESSION['id-usuario'], $_POST['idCarrito']);

$controlCarrito->unsetProducto($_POST['idCarrito']);
?>
