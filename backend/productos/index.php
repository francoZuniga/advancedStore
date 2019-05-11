<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();

unset($_SESSION['cargarProducto'], $_SESSION['tipoProducto'], $_SESSION['idProducto'], $_SESSION['idPublicacion']);

if (empty($_GET['producto'])) {
  $_GET['producto'] = "";
}
if (empty($_GET['precioMin'])) {
  $_GET['precioMin'] = "";
}
if (empty($_GET['precioMax'])) {
  $_GET['precioMax'] = "";
}
if (empty($_GET['tipo'])) {
  $_GET['tipo'] = "";
}
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
    <script type="text/javascript" src="jsProductos/form.js"></script>
		<script type="text/javascript" src="../../js/paginador.js">	</script>
		<style media="screen">
		section .table{
			width: 90%;
			min-width: 100px;
      font-size: 11pt;
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
	        <li class="nav-item active">
	          <a class="nav-link" href="#"><img src="" alt="">Productos</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link text-white" href="../almacen/index.php"><img src="" alt="">Almacen</a>
	        </li>
	        <li class="nav-item dropdown">
	          <a class="nav-link text-white" href="../stock/index.php"><img src="" alt="">Stock</a>
	        </li>
					<li class="nav-item dropdown">
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
    <section>
      <?php
      if (isset($_SESSION['error'])) {
          echo $_SESSION['error'];
          unset($_SESSION['error']);
      }
      else {

      }
       ?>
  		<button type="button" class="btn bg-transparent" data-toggle="modal" data-target="#exampleModal"><img src="../../Media/outline_add_circle_outline_black_18dp.png" style="width: 50px;"></button>
      <table class="table">
        <thead class="thead-dar">
			    <tr>
			      <th scope="col">ID producto</th>
			      <th scope="col">nombre</th>
			      <th scope="col">precio</th>
						<th scope="col">ganancia</th>
						<th scope="col">precio Web</th>
			      <th scope="col">Categoria</th>
						<th scope="col">Tipo</th>
						<th scope="col">Descripcion</th>
            <th scope="col">Cantidad</th>
						<th scope="col">Detalle</th>
            <th scope="col">Imagenes</th>
            <th scope="col">Publicar</th>
            <th scope="col">Eliminar</th>
			    </tr>
			  </thead>
				<?php
				require_once("scripts.php");
				$retorno = paginarProductos($_GET['producto'], $_GET['precioMin'], $_GET['precioMax'], $_GET['tipo']);
				 ?>
      </table>
			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
					<form method="post" enctype="multipart/form-data" action="cargarProductos.php" class="needs-validation" novalidate >
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Cargar Producto</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
								<!-- los elementos del formulario-->
								<div class="form-row">
                  <div class="col-md-12 mb-3">
                    <label for="validationServer01">Nombre Producto</label>
                    <input type="text" class="form-control is-valid" id="validationServer01" placeholder="Nombre del producto" value="" name="nombre" required>
                    <div class="invalid-feedback">
                      porfavor complete el campo!!
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="validationServer01">Tipo</label>
										<select class="form-control" id="inlineFormCustomSelectPref" name="tipo" required>
									    <option selected></option>
									    <option value="gaming">gaming</option>
									    <option value="componentes">componentes</option>
									    <option value="audio">Audio</option>
									  </select>
                    <div class="invalid-feedback">
                      porfavor complete el campo!!
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="validationServer01">Categoria</label>
										<select class="form-control" id="inlineFormCustomSelectPref" name="categoria" required>
									    <option selected></option>
									    <option value="auriculares">auriculares</option>
									    <option value="parlantes">parlantes</option>
									    <option value="teclados">teclados</option>
                      <option value="mause">mause</option>
                      <option value="alfombrillas">alfombrillas</option>
                      <option value="placas de video">placas de video</option>
                      <option value="placas madre">placas madre</option>
                      <option value="placas madre">placas madre</option>
                      <option value="discos">discos</option>
									  </select>
                    <div class="invalid-feedback">
                      porfavor complete el campo!!
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="validationServer01">Ganancia a obtener</label>
                    <input type="number" class="form-control is-valid" id="validationServer01" placeholder="%" value="" name="ganancia" required>
                    <div class="invalid-feedback">
                      porfavor complete el campo!!
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="validationServer01">Precio de la Compra</label>
                    <input type="number" class="form-control is-valid" id="validationServer01" placeholder="Precio de compra" value="" name="precio" required>
                    <div class="invalid-feedback">
                      porfavor complete el campo!!
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="validationServer01">Medidas</label>
                    <input type="text" class="form-control is-valid" id="validationServer01" placeholder="alto x ancho x largo" value="" name="medimas" required>
                    <div class="invalid-feedback">
                      porfavor complete el campo!!
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="validationServer01">Peso</label>
                    <input type="number" class="form-control is-valid" id="validationServer01" placeholder="peso gr" value="" name="peso" max="5000" required>
                    <div class="invalid-feedback">
                      porfavor complete el campo!!
                    </div>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="validationServer01">Descripcion</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion" required></textarea>
                    <div class="invalid-feedback">
                      porfavor complete el campo!!
                    </div>
                  </div>
                  <div class="col-md-8 mb-3">
                    <label for="validationServer01">cargar imagen</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="img" required>
                    <div class="invalid-feedback">
                      porfavor complete el campo!!
                    </div>
                  </div>
								<script>
									// Example starter JavaScript for disabling form submissions if there are invalid fields
									(function() {
									  'use strict';
									  window.addEventListener('load', function() {
									    // Fetch all the forms we want to apply custom Bootstrap validation styles to
									    var forms = document.getElementsByClassName('needs-validation');
									    // Loop over them and prevent submission
									    var validation = Array.prototype.filter.call(forms, function(form) {
									      form.addEventListener('submit', function(event) {
									        if (form.checkValidity() === false) {
									          event.preventDefault();
									          event.stopPropagation();
									        }
									        form.classList.add('was-validated');
									      }, false);
									    });
									  }, false);
									})();
									</script>
				      </div>
              <input type="hidden" name="fecha" value="" id="fecha" value="">
              <input type="hidden" name="hora" value="" id="hora" value="">
              <script type="text/javascript">
    						var fecha = document.getElementById('fecha').value = fecha();
    						var hora = document.getElementById('hora').value = hora();
    					</script>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button class="btn btn-primary" type="submit">Cargar</button>
				      </div>
				    </div>
					</form>
			  </div>
			</div>
			<script type="text/javascript">
			$('#myModal').on('shown.bs.modal', function () {
				$('#myInput').trigger('focus')
				})
			</script>
      <form>
  			<input type="hidden" name="" id="indicador" value="<?php echo $retorno[0]; ?>">
  			<input type="hidden" name="" id="total" value="<?php echo $retorno[1]; ?>">
  		</form>
      <script type="text/javascript" src="../../js/paginador.js"></script>
    </section>
  </body>
</html>
