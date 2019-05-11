<!DOCTYPE html>
<?php
session_start();
require_once("lib/baseDatos/usurios.php");
require_once("lib/baseDatos/ventaWeb.php");
require_once("lib/mercadopago.php");
require_once("../coneccionBD/coneccion.php");
 ?>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="Media/icono_imaguen/icono_paguina.png" rel="shortcut icon" type="image/png"/>
  <title>Inicio</title>
  <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!--estilos boostrap-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Ubuntu:400,700'>
  <link rel="stylesheet" href="Css/meinFrontendCss.css">
  <style>
    .left,
    .right {
        top: 5%;
        float: left;
    }

    .left {
        display: inline-block;
        white-space: nowrap;
        width: 50px;
        transition: width .5s;
    }

    .right {
        width: 350px;
        transition: width 1s;
        border-style: solid;
        border-color: #ccc;
        border-width: 1px;
    }

    .left:hover {
        width: 243px;
    }

    .item:hover {
        background-color: #cdcdcd;
    }

    .left .fas {
        margin: 15px;
        width: 20px;
        color: #000;
    }

    i.fas {
        font-size: 17px;
        vertical-align: middle !important;
    }

    .item {
        height: 50px;
        overflow: hidden;
        color: #000;
    }
    #icono{
      margin-left: 15px;
      margin-right: 15px;

    }
</style>
<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
<script type="text/javascript">
  function caragVenta(){
    $("#respuesta").load("scriptCargaDeCompra.php");
  }
</script>
</head>
  <body onload="caragVenta()">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e1381c;">
      <a class="navbar-brand text-white" href="#">
        <img src="Media/icono_imaguen/logo_imaguen2.png" height="30" class="d-inline-block align-top bg-light rounded" alt="" style="padding-left: 4px; padding-right: 2px;">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto border-primary justify-content-center">
          <li class="nav-item">
            <a class="nav-link text-white text-center" href="index.php">Inicio<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white text-center" href="#">Nosotros</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white text-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Productos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item text-center" href="productos.php?busqueda=&tipo=accesorios&pagina=1&orden=normal">Accesorios</a>
              <a class="dropdown-item text-center" href="productos.php?busqueda=&tipo=audio&pagina=1&orden=normal">Audio</a>
              <a class="dropdown-item text-center" href="productos.php?busqueda=&tipo=variedad&pagina=1&orden=normal">Variedad</a>
            </div>
          </li>
           <script type="text/javascript">
             $('.dropdown-toggle').dropdown()
           </script>
        </ul>
        <ul class="navbar-nav justify-content-end">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white text-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="rounded-circle bg-light" src="Media/png/user.png" alt="" style="width: 40px; height: 40px;">
            </a>
            <div class="dropdown-menu justify-content-center" aria-labelledby="navbarDropdown">
              <a class="dropdown-item text-center" href="favoritos.php">favoritos</a>
              <a class="dropdown-item text-center" href="carrito.php">carrito</a>
              <?php
              //datos de ingreso
              if (isset($_SESSION['nombre-usurio'])) {
                echo "<a class=\"dropdown-item text-center\" href=\"loginBackend/salirSession.php\">salir</a>";
                if (isset($_SESSION['legajo'])) {
                  echo "<a class=\"dropdown-item text-center\" href=\"backend/index.php\">administrar</a>";
                }
              }else{
                echo "<a class=\"nav-link active text-white text-center\" href=\"login.php\">ingresar</a>";
              }
               ?>
               <a class="dropdown-item text-center" href="perfil.php">perfil</a>
            </div>
          </li>
          <script type="text/javascript">
            $('.dropdown-toggle').dropdown()
          </script>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="get" action="productos.php">
          <input type="hidden" name="tipo" value="">
          <input type="hidden" name="pagina" value="">
          <input type="hidden" name="orden" value="normal">
          <input class="form-control mr-sm-2" name="busqueda" type="search" placeholder="Search" aria-label="Search">
          <button class="btn bg-white text-danger" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <section class="">
      <div class="">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm">
                <?php

                ?>
                <img src="..." alt="..." class="img-thumbnail" width="200px" height="200px">
              </div>
              <div class="col-sm">
                <table class="table table-sm">
                  <tbody>
                <?php
                if (isset($_SESSION['id-usuario'])) {
                  $controlUsuario = new Usurio();
                  $filas = $controlUsuario->setUsuarioId($_SESSION['id-usuario']);
                  foreach($filas as $fila){
                    echo "
                    <tr>
                      <th scope=\"row\">nombre:</th>
                      <td>".$fila['nombre']."</td>
                    </tr>
                    <tr>
                      <th scope=\"row\">email:</th>
                      <td>".$fila['usuario']."</td>
                    </tr>
                    <tr>
                      <th scope=\"row\">nivel:</th>
                      <td>".$fila['nivel']."</td>
                    </tr>"
                    ;
                  }
                }
                else{
                  echo "
                  <div class=\"alert alert-warning\" role=\"alert\">
                    no esta logueardo. <a href=\"login.php\">ingresar</a>
                  </div>";
                }
                ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row bg-light">
        <div class="container d-flex justify-content-center" id="respuesta" style="margin-bottom: 20px;">
          <img src="Media/load.gif" alt="" width="100px" height="100px">
        </div>
      </div>
    </section>
  </body>
</html>
