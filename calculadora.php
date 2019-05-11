<?php
require_once ('lib/mercadopago.php');

$mp = new MP('2337824604207319', 'mxbtVS1PL9DP6haxAHjigYPeSZoxwIMw');

$params = array(
	"dimensions" => "30x30x30,500",
	"zip_code" => "5700",
    "item_price"=>"400.58",
);

$response = $mp->get("/shipping_options", $params);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Shipping Cost Calculator</title>
	</head>
	<body>

		<form method="POST" action="YOUR_SERVER_URL">	
			<table>
				<thead>
					<tr>
						<th>Shipping method</th>
						<th>Estimated days</th>
						<th>Cost</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$shipping_options = $response['response']['options'];

					foreach($shipping_options as $shipping_option) {

						$value = $shipping_option['shipping_method_id'];
						$name = $shipping_option['name'];
						$checked = $shipping_option['display'] == "recommended" ? "checked='checked'" : "";

						$shipping_speed = $shipping_option['estimated_delivery_time']['shipping'];
						$estimated_delivery = $shipping_speed < 24 ? 1 : ceil($shipping_speed / 24); //from departure, estimated delivery time

						$cost = $shipping_option['cost'];
						$cost = $cost == 0 ? "FREE" : "$$cost";

					?>
					<tr>
						<td>
							<input type='radio' name='shippingOption' id='<?=$value;?>' value='<?=$value;?>' <?=$checked;?>>
							<label for='<?=$value;?>'><?=$name;?></label>
						</td>
						<td>
							<?=$estimated_delivery;?>
						</td>
						<td>
							<?=$cost;?>
						</td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			<input type="submit">
		</form>
	<?php require_once("coockies.php") ?>
</body>
</html>