<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();

require_once("../../lib/baseDatos/imagenPublicacion.php");
require_once("../../lib/baseDatos/publicaciones.php");
require_once("../../lib/baseDatos/caracteristicas.php");
require_once("../../lib/baseDatos/fichaAudio.php");
require_once("../../lib/baseDatos/fichaAccesorios.php");
require_once("../../lib/baseDatos/fichaVariedad.php");
require_once("../../lib/baseDatos/productos.php");
require_once("../../../coneccionBD/coneccion.php");
$imagenes = new imagenPublicacion();
$publicacion = new Publicaciones();
$producto = new Productos();

$filasPublicacion = $publicacion->setPublicacionProductoId($_GET['producto']);

$idPublicacion = $publicacion->getIdPublicacion();

$filas = $producto->setProductoId($_GET['producto']);
$filasImagenes = $imagenes->setImagenPublicacionIdPublicacion($idPublicacion);

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
      <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <section class="container">
    <div class="container">
      <div class="row">
        <div class="col-sm">
          <div id="carouselExampleControls" class="carousel slide row" data-ride="carousel">
            <div class="carousel-inner ">
              <?php
              foreach ($filas as $fila) {
                echo "
                <div class=\"carousel-item active\">
                  <img class=\"rounded mx-auto d-block\" src=\"../../".$fila['URL']."\" alt=\"First slide\" style=\"height: 300px;\">
                </div>";
              }
              if (empty($filasImagenes)) {

              }
              else{
                foreach ($filasImagenes as $fila) {
                  echo "
                  <div class=\"carousel-item item\">
                    <img class=\"rounded mx-auto d-block\" src=\"../../".$fila['URL']."\" alt=\"First slide\" style=\"height: 300px;\">
                  </div>";
                }
              }
               ?>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon " aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only rounded-circle bg-dark">Next</span>
            </a>
          </div>
        </div>
        </div>
        <div class="col-sm">
          <?php
            foreach ($filas as $fila) {
              echo"
              <table class=\"table bg-light\">
                <tbody>
                 <tr>
                   <th scope=\"row\">Productos:</th>
                   <td>".$fila['nombre']."</td>
                 </tr>
                 <tr>
                   <th scope=\"row\">Precio:</th>
                   <td>".($fila['precio']+(($fila['ganancia']*$fila['precio'])/100))."</td>
                 </tr>
                 <tr>
                   <th scope=\"row\">Descripcion:</th>
                   <td>".$fila['descripcion']."</td>
                 </tr>
                 <tr>
                   <th scope=\"row\" colspan=\"2\">//detinado a los metodos de pago</th>
                 </tr>
                 <tr>
                   <th scope=\"row\">Carrito</th>
                   <th scope=\"row\">Favoritos</th>
                 </tr>
              </table>";
            }
           ?>
        </div>
      </div>
    </div>
    <div class="conteiner">
      <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Ficha Tecnica</a>
      </p>
      <div class="row">
        <div class="col">
          <div class="collapse table-bordered" id="multiCollapseExample1">
            <div class="card card-body">
              <?php
              $controlCaracteristicas = new Caracteristicas();
              $filas = $controlCaracteristicas->setCaracteristicasIdProducto($_GET['producto']);
              echo $controlCaracteristicas->getCaracteristicas();
               ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a class="btn btn-success" href="index.php" role="button">terminar</a>
    </section>
  </body>
</html>
Copyright (c) 2018 Copyright Holder All Rights Reserved.
