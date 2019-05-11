<?php
session_start();
require_once("../../loginBackend/controlSession.php");
require_once("../../lib/baseDatos/publicaciones.php");
require_once("../../lib/baseDatos/caracteristicas.php");
require_once("../../lib/baseDatos/fichaAccesorios.php");
require_once("../../lib/baseDatos/fichaAudio.php");
require_once("../../lib/baseDatos/fichaVariedad.php");
require_once("../../../coneccionBD/coneccion.php");
controlAcceso();

$tipo = $_SESSION['tipoProducto'];
if (!isset($_SESSION['cargarPublicacion']) || $_SESSION['cargarPublicacion'] != 2) {
  header("Location: index.php");
}
else {
  $controlPublicacion = new Publicaciones();
  $publicacion = $controlPublicacion->setPublicacion($_SESSION['publicacion'][0], $_SESSION['publicacion'][1]);
  $_SESSION['idPublicacion'] = $controlPublicacion->getIdPublicacion();

  $controlCaracteristicas = new Caracteristicas();
  $caracteristicas = $controlCaracteristicas->setCaractersticas($_SESSION['idProducto'], $_SESSION['caracteristicas']);

  header("Location: cargarImagenes.php");
}
 ?>
