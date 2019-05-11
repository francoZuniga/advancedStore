
Checkout básico
Recibe pagos en cuestión de minutos.
Te damos todo resuelto, solo dinos qué quieres cobrar y nos encargaremos del resto.
<br>
Qué aprenderás a hacer
Usar el SDK para crear una preferencia de pagos.
Insertar un botón en tu sitio y abrir el flujo de pagos.
Recibir notificaciones de tus pagos.
Cómo funciona
<br>
Crea la preferencia de pago.
Muestra el botón o link a tu cliente.
Tu cliente paga en MercadoPago y retorna a tu sitio.
Recibe la notificación del pago.
Cómo empezar
Crea una cuenta en Mercadopago.
Descarga e instala el SDK y configura tus credenciales.
Utiliza las credenciales de tu aplicación: 290295101 - MercadoPago application
SHORT_NAME: mp-app-290295101
CLIENT_ID: 2337824604207319
CLIENT_SECRET: mxbtVS1PL9DP6haxAHjigYPeSZoxwIMw
Crea una Preferencia de pago
Es el punto de entrada al checkout básico. Te permite configurar:
<br>
Datos y monto del producto que estás vendiendo.
Medios de pago que aceptas.
Opciones avanzadas, para definir cómo se comportará el proceso de pago.
Danos la información de lo que quieres cobrar y el Checkout básico se encargará de que recibas tus pagos.
<br>
Para crear una preferencia de pago, debes:
<br>
Enviar a la API los atributos correspondientes. Recibirás los datos de la preferencia creada.
Utilizar el atributo init_point de la preferencia creada en un link.
Ejemplo:


<?php
require_once ('lib/mercadopago.php');

$mp = new MP('2337824604207319', 'mxbtVS1PL9DP6haxAHjigYPeSZoxwIMw');

$preference_data = array(
	"items" => array(
		array(
			"id" => 123,
			"title" => "Multicolor kite",
			"quantity" => 1,
			"currency_id" => "ARS", // Available currencies at: https://api.mercadopago.com/currencies
			"unit_price" => 10.00
		),
		array(
			"id" => 123,
			"title" => "cas kite",
			"quantity" => 1,
			"currency_id" => "ARS", // Available currencies at: https://api.mercadopago.com/currencies
			"unit_price" => 14.00
		)
	),

);
print_r($preference_data);
//$preference = $mp->create_preference($preference_data);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Pay</title>
	</head>
	<body>
		<a href="<?php echo $preference['response']['init_point']; ?>">Pay</a>
	</body>
</html>
