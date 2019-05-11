<?php
session_start();
require_once("./lib/baseDatos/favoritos.php");
require_once("../coneccionBD/coneccion.php");

$controlCarrito = new Favoritos();
$controlCarrito->setFavoritos($_SESSION['id-usuario'], $_POST['idCarrito'], 1);
?>
