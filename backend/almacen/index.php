<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();
$_SESSION['arrayCompra'] = array();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>index</title>
		<!-- estilos de bosstrap-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../Css/menuBackend.css">
		<link rel="stylesheet" href="../../Css/productosCuerpo.css">
		<script type="text/javascript" src="jsAlmacen/form.js"></script>
		<script type="text/javascript" src="../../js/paginador.js">	</script>
		<style media="screen">
		section .table{
			width: 90%;
			min-width: 100px;
		}
		table tr{
      background-color: #fff;
    }
		</style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e1381c;">
	    <a class="navbar-brand text-white" href="../index.php">
	      <img src="Media/icono_imaguen/icono.png" width="60" height="30" class="d-inline-block align-top bg-light rounded" alt="">
	    </a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>

	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav mr-auto border-primary justify-content-center">
	        <li class="nav-item">
	          <a class="nav-link text-white" href="../productos/index.php"><img src="" alt="">Productos</a>
	        </li>
	        <li class="nav-item active">
	          <a class="nav-link" href="#"><img src="" alt="">Almacen</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link text-white" href="../stock/index.php"><img src="" alt="">Stock</a>
	        </li>
					<li  class="nav-item">
	          <a class="nav-link text-white" href="../ventas/index.php"><img src="" alt="">Ventas</a>
	        </li>
	         <script type="text/javascript">
	           $('.dropdown-toggle').dropdown()
	         </script>
	      </ul>
	      <form class="form-inline my-2 my-lg-0" method="get" action="productos.php">
	        <input class="form-control mr-sm-2" name="busqueda" type="search" placeholder="Search" aria-label="Search">
	        <button class="btn bg-white text-danger" type="submit">Search</button>
	      </form>
        <a href="../../index.php"><img class="rounded-circle bg-white" src="../../Media/outline_store_black_18dp.png" style="margin-right: 10px; margin-left: 10px; "></a>
        <a href="../../loginBackend/salirSession.php"><img class="rounded-circle bg-white" src="../../Media/outline_input_black_18dp.png" alt="" style="margin-right: 10px; margin-left: 10px; "></a>
	    </div>
	  </nav>
    <div class="btn-group" style="margin-left: 10%; margin-top: 10px;">
      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        tipo de carga
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="compra.php">cargar compra</a>
        <a class="dropdown-item" href="control.php">control de stock</a>
      </div>
    </div>
    <section>
      <table class="table" style="">
			  <thead class="thead-light">
			    <tr>
			      <th scope="col">n°almacen</th>
			      <th scope="col">fecha</th>
			      <th scope="col">hora</th>
			      <th scope="col">id producto</th>
						<th scope="col">cantidad</th>
						<th scope="col">detalle</th>
			    </tr>
			  </thead>
			  <tbody>
        <?php
				require_once("scripts.php");
				$retorno = paguinarAlmacen();
         ?>
    </section>
    <form>
			<input type="hidden" name="" id="indicador" value="<?php echo $retorno[0]; ?>">
			<input type="hidden" name="" id="total" value="<?php echo $retorno[1]; ?>">
		</form>
    <script type="text/javascript" src="../../js/paginador.js"></script>
  </body>
</html>
