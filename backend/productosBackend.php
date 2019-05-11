<?php
session_start();
require_once("loginBackend/controlSession.php");
controlAcceso();
require_once("../coneccionBD/coneccion.php");
require_once("lib/baseDatos/productos.php");
//pedimos los datos y los mostramos
$consulta = new Productos();
$registros = $consulta->setP($_POST['id']);

foreach ($registros as $fila) {
  echo $fila['nombre']."</br>";
  $array2 = $consulta->getProductosNombre($fila['nombre']);
  foreach ($array2 as $fila2) {
    echo $fila2['ProductoId'];
  }
}
 ?>
