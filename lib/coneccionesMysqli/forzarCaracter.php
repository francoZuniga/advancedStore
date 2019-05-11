<?php
require_once("conecciones.php");

function forzarEspeciales($avlor){
  $retorno = mysqli_real_escape_string($coneccion, $valor);
  return $retorno;
}
 ?>
