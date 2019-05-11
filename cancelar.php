<?php 
require_once ('lib/mercadopago.php');

$mp = new MP('2337824604207319', 'mxbtVS1PL9DP6haxAHjigYPeSZoxwIMw');

$mp->cancel_payment(":290295101-4250dedd-3abf-4212-ada1-f6adce9ac08b");
 ?>