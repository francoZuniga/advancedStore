<?php
require_once("lib/mercadopago.php");
require_once("../coneccionBD/coneccion.php");

$mp = new MP('2337824604207319', 'mxbtVS1PL9DP6haxAHjigYPeSZoxwIMw');

$result = $mp->cancel_payment($_GET['id']);

 ?>
