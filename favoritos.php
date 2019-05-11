<!DOCTYPE html>
<html lang="en" >
<?php
require_once("lib/baseDatos/productos.php");
require_once("lib/baseDatos/favoritos.php");
require_once("lib/baseDatos/carrito.php");
require_once("../coneccionBD/coneccion.php");
session_start();
 if (isset($_POST['carrito'])){
    $controlCarrito = new Carrito();
    $carrito = $controlCarrito->setCarritoProducto($_SESSION['id-usuario'], $_POST['carrito']);
    if ($carrito) {
      $controlCarrito->unsetProducto($_POST['carrito']);
    }
    else{
      $controlCarrito->setCarrito($_SESSION['id-usuario'], $_POST['carrito'], 1);
    }
    unset($_POST['carrito']);
  }
 ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="Media/icono_imaguen/icono_paguina.png" rel="shortcut icon" type="image/png"/>

  <meta property="og:url"           content="https://www.your-domain.com/your-page.html" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="Your Website Title" />
  <meta property="og:description"   content="Your description" />
  <meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />

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
  <section>
    <style>
      .centro{
        overflow-x: scroll;
        height: 100%;
      }
      .card .card-body li{
        width: calc(100%/5);
      }
    </style>
    <div style="width: 98%; margin: 1%;" class="bg-light">

      <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.2';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    </div>
    <div style="min-width: 98%; margin: 1%;" class="bg-light container centro">
      <?php
      if (isset($_SESSION['id-usuario'])) {
        $controlFavoritos = new Favoritos();
        $favoritos = $controlFavoritos->setFavoritosUsuario($_SESSION['id-usuario']);
        if (empty($favoritos)) {
          // code...
        }
        else{
          foreach ($favoritos as $fila) {
            echo "<div class=\"card\" style=\"margin: 3px; min-width: 1000px;\">
                      <div class=\"card-body\">
                        <ul class=\"nav\">";

          $controlProducto = new Productos();
          $filas = $controlProducto->setProductoId($fila['ProductoId']);
          foreach ($filas as $fila) {
            echo "
              <li class=\"nav-item\"><img src=\"".$fila['URL']."\" width=\"200px;\"></li>
              <li class=\"nav-item\"><strong>".$fila['nombre']."</strong><br>".$fila['descripcion']."</li>
              ";
              $precio = ($fila['precio']+(($fila['ganancia']*$fila['precio'])/100));
            }
            echo "<li class=\"nav-item\"><div class=\"fb-share-button\" data-href=\"https://advancedstore.000webhostapp.com/producto.php?carrito=".$fila['ProductoId']."\" data-layout=\"button_count\" data-size=\"large\" data-mobile-iframe=\"true\"><a target=\"_blank\" href=\"https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2FpaginaActual%2Fproducto.php%3Ftipo%3Daccesorios%26id%3D1&amp;src=sdkpreparse\" class=\"fb-xfbml-parse-ignore\">Compartir</a></div><li>";
            $controlCarrito = new Carrito();
            $carrito = $controlCarrito->setCarritoUsuarioProducto($_SESSION['id-usuario'], $fila['ProductoId']);
            if (empty($carrito)) {
              echo "<li class=\"nav-item\">
                    <form action=\"favoritos.php\" method=\"post\">
                    <input type=\"hidden\" name=\"carrito\" value=\"".$fila['ProductoId']."\">
                    <button type=\"submit\" name=\"\" class=\"btn btn-outline-primary\" style=\"\">agregar al carrito</button>
                  </form></li>";
            }
            else{
              echo "<li class=\"nav-item\">
                    <form action=\"favoritos.php\" method=\"post\">
                    <input type=\"hidden\" name=\"carrito\" value=\"".$fila['ProductoId']."\">
                    <button type=\"submit\" name=\"\" class=\"btn btn-primary\" style=\"\">eliminar del carrito</button>
                  </form></li>";
            }
            echo " </ul>
                </div>
              </div>";
          }
        }
      }
      else{
        echo "
          <div class=\"alert alert-warning\" role=\"alert\">
            no esta logueardo. <a href=\"login.php\">ingresar</a>
          </div>
        ";
      }
      ?>
    </div>
  </section>
<?php require_once("coockies.php") ?>
</body>
</html>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="js/index.js"></script>
<?php require_once("coockies.php") ?>
</body>
</html>
