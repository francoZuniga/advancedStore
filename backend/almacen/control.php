<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>index</title>
		<!--los estilos de boostrap-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../Css/menuBackend.css">
    <link rel="stylesheet" href="ventas.css">
		<link rel="stylesheet" href="../../Css/productosCuerpo.css">
		<script type="text/javascript" src="jsAlmacen/form.js"></script>
		<script type="text/javascript" src="../../js/paginador.js"></script>

  </head>
  <body>
    <a href="index.php"><img src="../../Media/outline_undo_black_18dp.png"></a>
		<section class="container form-group">
					<div class="card" style="width: 50%; height: 200px; overflow-y: scroll;">
						<div class="card-body ">
						<?php

						if (isset($_POST['idProducto']) && isset($_POST['cantidad']) && isset($_POST['fecha']) && isset($_POST['hora'])){
							if ($_POST['idProducto'] != "" && $_POST['cantidad'] != "") {

								$productos = array($_POST['idProducto'], $_POST['cantidad'], $_POST['fecha'], $_POST['hora']);
								array_push($_SESSION['arrayCompra'], $productos);
								unset($_POST['idProducto'], $_POST['cantidad'], $_POST['fecha'], $_POST['hora']);
							}
							else {

							}
						}
						for ($i=0; $i < count($_SESSION['arrayCompra']); $i++) {
							//mostramos los contenidos de el arreglo
							echo "<p class=\"card-text\">".$_SESSION['arrayCompra'][$i][0]."-".$_SESSION['arrayCompra'][$i][1]."</p></br>";
						}
						/*** [unset eliminamos los datos de la variable]* @var [type]*/
						unset($_POST['arrayCompra'], $_POST['cantidad'], $_POST['fecha'], $_POST['hora']);
						?>
					</div>
				</div>
				<form action="control.php" style="width: 50%;" method="post" class="">
					Productos
					<select class="form-control" name="idProducto" style="width: 100%;" id="exampleFormControlSelect1">
						<option value="">-------</option>
						<?php
							require_once("scripts.php");
							mostrarProductosFiltro();
						 ?>
					</select>
					cantidad
					<input type="number" name="cantidad" value="" class="form-control" id="inputGroup-sizing-lg">
					<input type="hidden" name="fecha" value="" id="fecha">
					<input type="hidden" name="hora" value="" id="hora">
					<br>
					<input type="submit" name="" value="cargar" class="btn btn-outline-primary btn-lg">
					<a href="cargaAlmacen.php" class="btn btn-outline-success btn-lg" role="button" style="float: right;">registrar</a>
					<script type="text/javascript">
						var fecha = document.getElementById('fecha').value = fecha();
						var fecha = document.getElementById('hora').value = hora();
						bloqueamosForm();
					</script>
				</form>
			</div>
    </section>
  </body>
</html>
