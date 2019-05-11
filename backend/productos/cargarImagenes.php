<?php
session_start();
require_once("../../loginBackend/controlSession.php");
require_once("../../lib/baseDatos/fichaAccesorios.php");
require_once("../../lib/baseDatos/fichaAudio.php");
require_once("../../lib/baseDatos/fichaVariedad.php");
require_once("../../../coneccionBD/coneccion.php");
controlAcceso();

$tipo = $_SESSION['tipoProducto'];
$idPublicacion = $_SESSION['idPublicacion'];
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- estilos de bosstrap-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="productos.css">
  </head>
  <body>
    <?php
    if (isset($_SESSION['errorCarga'])) {
      echo $_SESSION['errorCarga'];
      unset($_SESSION['errorCarga']);
    }
     ?>
    <div class="progress" style="height: 1px; margin-top: 2%;">
      <div class="progress-bar" role="progressbar" style="width: 66%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <section class="container">
      <form class="needs-validation" novalidate action="scriptCargaImagenes.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="validationCustom01">Imagen</label>
            <input type="hidden" name="idPublicacion" value="<?php echo $idPublicacion;?>">
            <input type="file" class="form-control" id="validationCustom01" placeholder="imagen" value="" name="imagen" required>
            <div class="valid-feedback">
              bien hecho
            </div>
            <div class="invalid-feedback">
              complete el campo
            </div>
          </div>
        </div>
        <button class="btn btn-primary" type="submit">Cargar</button>
        <a href="productoFinal.php" class="btn badge-success">terminar</a>
      </form>
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
      <!-- el muestra de las imagenes cargadas-->
      <input type="hidden" name="" value="<?php echo $tipo;?>" id="datoTipo">
      <script type="text/javascript" src="productos.js"></script>
      <ul class="nav justify-content-center">
        <?php
          require_once("../../lib/baseDatos/imagenPublicacion.php");
          require_once("../../../coneccionBD/coneccion.php");
          $imagenPublicacion = new imagenPublicacion();
          $filas = $imagenPublicacion->setImagenPublicacionIdPublicacion($idPublicacion);
          if(!empty($filas)) {
            foreach ($filas as $fila) {
              echo "
              <li class=\"nav-item\">
                <div class=\"card\" style=\"width: 18rem;\">
                  <form class=\"\" action=\"eliminarImagen.php\" method=\"post\">
                    <input type=\"hidden\" name=\"idPublicacion\" value=\"".$fila['idPublicacion']."\">
                    <input type=\"hidden\" name=\"URL\" value=\"".$fila['URL']."\">
                    <button type=\"submit\" class=\"close\" aria-label=\"Close\">
                      <span aria-hidden=\"true\">&times;</span>
                    </button>
                  </form>
                  <img class=\"card-img-top\" src=\"../../".$fila['URL']."\" alt=\"Card image cap\">
                </div>
              </li>";
            }
          }
         ?>
      </ul>
    </section>
  </body>
</html>
