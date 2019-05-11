<!DOCTYPE html>
<?php
session_start();
require_once("lib/baseDatos/carrito.php");
require_once("lib/baseDatos/productos.php");
require_once("../coneccionBD/coneccion.php");
require_once("lib/baseDatos/productos.php");
require_once("lib/mercadopago.php");

if(!isset($_SESSION['nombre-usurio'])){
  header("Location: login.php");
}
else{
  $controlCarrito = new Carrito();
  $carrito = $controlCarrito->setCarritoUsuario($_SESSION['id-usuario']);
  $total = 0;
  $pesoFinal = 0;
}
?>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="Media/icono_imaguen/icono_paguina.png" rel="shortcut icon" type="image/png"/>
  <title>Productos</title>
  <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <!--estilos boostrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Ubuntu:400,700'>
  <link rel="stylesheet" href="Css/meinFrontendCss.css">
	<link rel="stylesheet" type="text/css" href="Css/productosCuerpo.css">
  <script src="Js/filtro.js"></script>
</head>
<body>
  <style>
    section{
      height: 100%;
    }
    #load{
      margin: 3px;
      width: auto;
      min-width: 80px;
    }
    @media (max-width: 768px){
      #linea{
        width: 100%;
        height: auto;
        min-height: 50px;
        justify-content: center;
      }
      #linea img, strong{
        margin: 0 auto;
        display: block;
      }
      #linea .btn-group{
        margin: 0 auto;
      }
    }
  </style>
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
          <a class="nav-link text-white text-center" href="index2.php">Inicio<span class="sr-only">(current)</span></a>
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
      </ul>
      <form class="form-inline my-2 my-lg-0" method="get" action="productos.php">
        <input type="hidden" name="tipo" value="">
        <input type="hidden" name="pagina" value="">
        <input type="hidden" name="orden" value="normal">
        <input class="form-control mr-sm-2" name="busqueda" type="search" placeholder="Search" aria-label="Search">
        <button class="btn bg-white text-danger" type="submit">Search</button>
      </form>
    </div>
    <script type="text/javascript">
      $('.dropdown-toggle').dropdown()
    </script>
  </nav>
  <section>
    <div style="min-width: 98%; margin: 1%;" class="bg-light container centro justify-content-center" id="centro">
      <div class="card" style="width: 18rem; display: none;" id="load">
        <img src="Media/load.gif" alt="" width="80px;" style="margin: 0 auto;">
      </div>
      <?php

    if ($carrito){
      foreach($carrito as $filaCarrito){
        echo "
          <div class=\"card\" style=\"margin: 3px;\" id=\"datos\">
            <div class=\"card-body row d-flex justify-content-between\">
            ";
            $controlProducto = new Productos();
            $filas = $controlProducto->setProductoId($filaCarrito['IdProducto']);
            foreach ($filas as $fila) {
              $nombre = $fila['nombre'];
              $medidas = $fila['medidas'];
              $URL = $fila['URL'];
              $descripcion = $fila['descripcion'];

              echo "
              <div class=\"col-md-15\" id=\"linea\"><img src=\"".$URL."\" width=\"200px;\"></div>
              <div class=\"col-md-15\" id=\"linea\"><strong>".$nombre."</strong><br>".$descripcion."</div>
              ";
              $precio = ($fila['precio']+(($fila['ganancia']*$fila['precio'])/100));
            }
            $precio = $precio *$filaCarrito['cantidad'];
            $peso = $fila['peso'] * $filaCarrito['cantidad'];
            $maximo = $fila['maximo'];
            if ($filaCarrito['cantidad'] == 0){
              echo "
                <div class=\"col-md-15\" id=\"linea\">
                  <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
                    <button type=\"button\" class=\"btn btn-secondary bg-light text-dark\">".$filaCarrito['cantidad']."</button>
                    <form method=\"post\">
                      <input type=\"hidden\" value=\"".$filaCarrito['idCarrito']."\" name=\"idCarrito\" id=\"idCarrito\">
                      <button type=\"submit\" class=\"btn btn-secondary bg-light text-dark\" onclick=\"sumarCarrito()\">+</button>
                    </form>
                  </div>
                </div>
              ";
            }
            elseif ($filaCarrito['cantidad'] == $maximo) {
              $cantidad = $filaCarrito['cantidad'];

              echo "
              <div class=\"col-md-15\" id=\"linea\">
                  <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
                    <form method=\"post\">
                      <input type=\"hidden\" value=\"".$filaCarrito['idCarrito']."\" name=\"\" id=\"idCarrito\">
                      <button type=\"button\" class=\"btn btn-secondary bg-light text-dark\" onclick=\"restarCarrito(".$filaCarrito['idCarrito'].",".$cantidad.")\">-</button>
                    </form>
                    <input type=\"text\" value=\"".$cantidad."\" class=\"btn btn-secondar\" style=\"width: 50px;\" id=\"cantidad\" disabled>
                  </div>
                </div>
              ";
            }
            else{
              $cantidad = $filaCarrito['cantidad'];

              echo "
              <div class=\"col-md-15\" id=\"linea\">
                  <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
                    <form method=\"post\">
                      <input type=\"hidden\" value=\"".$filaCarrito['idCarrito']."\" name=\"idCarrito\" id=\"idCarrito\">
                      <button type=\"button\" class=\"btn btn-secondary bg-light text-dark\" onclick=\"restarCarrito(".$filaCarrito['idCarrito'].",".$cantidad.")\">-</button>
                    </form>
                    <input type=\"text\" value=\"".$cantidad."\" class=\"btn btn-secondar\" style=\"width: 50px;\" id=\"cantidad\" disabled>
                    <form method=\"post\">
                      <input type=\"hidden\" value=\"".$filaCarrito['idCarrito']."\" name=\"idCarrito\" id=\"idCarrito\">
                      <button type=\"button\" class=\"btn btn-secondary bg-light text-dark\" onclick=\"sumarCarrito(".$filaCarrito['idCarrito'].",".$cantidad.")\">+</button>
                    </form>
                  </div>
                </div>
              ";
            }
            echo "
                    <div class=\"col-md-15\" id=\"linea\">
                      ".$precio."
                    </div>
            ";

            /*$mp = new MP('2337824604207319','mxbtVS1PL9DP6haxAHjigYPeSZoxwIMw');

            $preference_data = array(
              "items" => array(
                array(
                  "title" => "$nombre",
                  "quantity" => intval($cantidad),
                  "currency_id" => "ARS", // Available currencies at: https://api.mercadopago.com/currencies
                  "unit_price" => $precio
                )
              ),
              "shipments" => array(
                "mode" => "me2",
                "dimensions" => "$medidas",
                "local_pickup" => true,
                "default_shipping_method" => 73328,
                "zip_code" => "8300"
              ),
              "back_urls" => array(
                "success" => "https://www.youtube.com",
                "failure" => "http://www.youtube.com",
                "pending" => "https://advancedstorebeta.000webhostapp.com/notificaciones.php"
              ),
            );

            $preference = $mp->create_preference($preference_data);
            echo "
            <div class=\"col-md-15\" id=\"linea\">
                <form action=\"eliminarCarrito.php\" method=\"post\">
                    <a class=\"btn btn-primary\" href=\"".$preference['response']['init_point']."\" role=\"button\">comprar</a>
                </form>
            </div>";*/

            echo "
                <div class=\"col-md-15\" id=\"linea\">
                    <form action=\"eliminarCarrito.php\" method=\"post\">
                        <input type=\"hidden\" name=\"sacar\" value=\"".$filaCarrito['IdProducto']."\">
                        <button type=\"submit\" class=\"close\" aria-label=\"Close\">
                          <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </form>
                </div>
            </div>
          </div>";
            $pesoFinal = $pesoFinal + $peso;
            $total = $total + $precio;

          }
          if ($pesoFinal <= 5000) {
            echo "<div class=\"card d-flex justify-content-end\" style=\"margin: 3px;\" id=\"total\">
                <div class=\"col-md-15\" id=\"linea\">
                  <br>
                  <a class=\"btn btn-primary\" href=\"scriptCompraCarrito.php\" role=\"button\" style=\" margin-left: 65%;\">comprar carrito</a>
                </div>
                <div class=\"col-md-15\" id=\"linea\">
                  <p style=\" margin-left: 75%;\"><strong>Total</strong></p>
                </div>
                <div class=\"col-md-15\" id=\"linea\">
                  <p style=\" margin-left: 75%;\">".$total."</p>
                </div>
            </div>
            ";
          }
          else{
            echo "son demasiados productos y pesan mucho, redusca su pedido del carrto";
          }
        }
        else {
          echo "el carrito esta vacio";
        }
  ?>
    </div>
  </section>
  <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
  <script type="text/javascript">

  function restarCarrito(idProducto, cantidad){
    var id, url;
    url = "restarCarrito.php";
    id = idProducto;
    cantidad = cantidad;
    $.ajax({
        type: "post",
        url: url,
        data: {idCarrito:id},
        success: function(){
          document.getElementById('load').setAttribute("style", "display: block;");
          $("#centro").load(" #centro");
        }
    })
  }

  function sumarCarrito(idProducto, cantidad){
      var id, url;
      url = "sumarCarrito.php";
      id = idProducto;

      $.ajax({
          type: "post",
          url: url,
          data: {idCarrito:id},
          success: function(){
              document.getElementById('load').setAttribute("style", "display: block;");
              $("#centro").load(" #centro");
          }
      })
    }
  </script>
<?php require_once("coockies.php") ?>
</body>
</html>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="js/index.js"></script>
<?php require_once("coockies.php") ?>
</body>
</html>
