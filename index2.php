<!DOCTYPE html>
<html lang="en" dir="ltr">
<title>Inicio</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="Media/icono_imaguen/icono_paguina.png" rel="shortcut icon" type="image/png"/>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="./slick/slick.css">
<link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
<link rel="stylesheet" href="Css/main.css">
<style type="text/css">
html, body {
  margin: 0;
  padding: 0;
}
* {
  box-sizing: border-box;
}

.slider{
    width: 95%;
    margin: 0 auto;
    margin-top: 5%;
    margin-bottom: 5%;
}

.slick-slide {
  margin: 0px 20px;
}

.slick-slide img {
  width: 100%;
}

.slick-prev:before,
.slick-next:before {
  color: black;
}


.slick-slide {
  transition: all ease-in-out .3s;
  opacity: .2;
}

.slick-active {
  opacity: .5;
}

.slick-current {
  opacity: 1;
}
.productos{
  width: 70%;
}
.movile{
  display: none;
  width: 95%;
  margin: 0 auto;
  margin-top: 5%;
  margin-bottom: 5%;
}
.screen{
  width: 100%;
  margin-bottom: 5%;
}
.ultimosProductos{
  margin: 0 auto;
  margin-bottom: 5%;
  padding: 5px;
}
.ultimosProductos a img{
  width: 70%;
}
@media (max-width: 425px){
  .movile{
    width: 90%;
    margin-top: 0;
    padding: 0;
    display: block;
  }
  .screen{
    display: none;
  }
  .ultimosProductos{
    width: 100%;
    margin: 0 auto;
    margin-bottom: 5px;
  }
  .ultimosProductos a img{
    width: 90%;
    margin: 0 auto;
  }
  .ultimosProductos .productos{
    display: none;
  }
}
</style>
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
              <a class="dropdown-item text-center" href="productos.php?busqueda=&tipo=gaming&pagina=1&orden=normal">Gaming</a>
              <a class="dropdown-item text-center" href="productos.php?busqueda=&tipo=audio&pagina=1&orden=normal">Audio</a>
              <a class="dropdown-item text-center" href="productos.php?busqueda=&tipo=componentes&pagina=1&orden=normal">Componentes</a>
            </div>
          </li>
           <script type="text/javascript">
             $('.dropdown-toggle').dropdown()
           </script>
        </ul>
        <ul class="navbar-nav justify-content-end">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white text-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="Media/outline_account_circle_white_18dp.png" alt="">
            </a>
            <div class="dropdown-menu justify-content-center" aria-labelledby="navbarDropdown">
              <a class="dropdown-item text-center" href="favoritos.php">favoritos</a>
              <a class="dropdown-item text-center" href="carrito.php">carrito</a>
              <?php
              //datos de ingreso
              if (isset($_SESSION['id-usurio'])) {
                echo "<a class=\"dropdown-item text-center\" href=\"loginBackend/salirSession.php\">salir</a>";
                if (isset($_SESSION['legajo'])) {
                  echo "<a class=\"dropdown-item text-center\" href=\"backend/index.php\">administrar</a>";
                }
              }else{
                echo "<a class=\"nav-link text-center\" href=\"login.php\">ingresar</a>";
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
          <input class="form-control mr-sm-2" name="busqueda" type="search" placeholder="Buscar.." aria-label="Search" style="height: 35px;">
          <button class="btn bg-white text-danger" type="submit" style="height: 35px;"><i class="material-icons">search</i></button>
        </form>
      </div>
    </nav>
    <section class="container" style="width: 100%; max-width: 100%;">

      <div id="carouselExampleControls" class="carousel slide screen" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="Media/img/01.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="Media/img/02.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="Media/img/03.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="lazy slider movile" data-sizes="50vw">
        <div>
          <img src="Media/img/1a.png">
        </div>
        <div>
          <img src="Media/img/2b.png">
        </div>
        <div>
          <img src="Media/img/3c.png">
        </div>
      </div>


      <div class="bg-white row ultimosProductos border" style="width: 90%;">
        <a href="productos.php?busqueda=&tipo=componentes&pagina=1&orden=normal" class="col-sm"><img src="Media/comonentes.png" alt="..." class="rounded"></a>
        <div class="regular productos col-sm">
          <?php
          require_once("lib/baseDatos/productos.php");
          require_once("../coneccionBD/coneccion.php");
          $productos = new Productos();
          $filas = $productos->getProductosUltimos(1,6,"componentes");
          if (empty($filas)) {
            echo "<div>
                    <img src=\"http://placehold.it/350x300?text=7\">
                  </div>
                  <div>
                    <img src=\"http://placehold.it/350x300?text=8\">
                  </div>
                  <div>
                    <img src=\"http://placehold.it/350x300?text=9\">
                  </div>";
          }
          else{
            foreach ($filas as $fila) {
              echo "
              <a href=\"producto.php?tipo=gaming&id=".$fila['ProductoId']."\">
                <div class=\"\" style=\"width: 156; height: auto;\">
                  <img src=\"".$fila['URL']."\" style\"margin: 0 auto; height: 134px;\">
                </div>
              </a>
              ";
            }
          }
           ?>
           <div class="">
           </div>
           <div>
             <img src="http://placehold.it/350x300?text=7">
           </div>
           <div>
             <img src="http://placehold.it/350x300?text=8">
           </div>
           <div>
             <img src="http://placehold.it/350x300?text=9">
           </div>
        </div>
      </div>

      <div class="bg-white row ultimosProductos border" style="width: 90%;">
        <a href="productos.php?busqueda=&tipo=gaming&pagina=1&orden=normal" class="col-sm"><img src="Media/gaiming.png" alt="..." class="rounded"></a>
        <div class="regular productos col-sm">
          <?php
          $productos = new Productos();
          $filas = $productos->getProductosUltimos(1,6,"gaming");
          if (empty($filas)) {
            echo "<div>
                    <img src=\"http://placehold.it/350x300?text=7\">
                  </div>
                  <div>
                    <img src=\"http://placehold.it/350x300?text=8\">
                  </div>
                  <div>
                    <img src=\"http://placehold.it/350x300?text=9\">
                  </div>";
          }
          else{
            foreach ($filas as $fila) {
              echo "
              <a href=\"producto.php?tipo=gaming&id=".$fila['ProductoId']."\">
                <div class=\"\" style=\"width: 156; height: auto;\">
                  <img src=\"".$fila['URL']."\" style\"margin: 0 auto; height: 134px;\">
                </div>
              </a>
              ";
            }
          }
           ?>
          <div>
            <img src="http://placehold.it/350x300?text=7">
          </div>
          <div>
            <img src="http://placehold.it/350x300?text=8">
          </div>
          <div>
            <img src="http://placehold.it/350x300?text=9">
          </div>
        </div>
      </div>

      <div class="bg-white row ultimosProductos border" style="width: 90%;">
        <a href="productos.php?busqueda=&tipo=audio&pagina=1&orden=normal" class="col-sm"><img src="Media/audio.png" alt="..." class="rounded"></a>
        <div class="regular productos col-sm">
          <?php
          $productos = new Productos();
          $filas = $productos->getProductosUltimos(1,6,"audio");
          if (empty($filas)) {
            echo "<div>
                    <img src=\"http://placehold.it/350x300?text=7\">
                  </div>
                  <div>
                    <img src=\"http://placehold.it/350x300?text=8\">
                  </div>
                  <div>
                    <img src=\"http://placehold.it/350x300?text=9\">
                  </div>";
          }
          else{
            foreach ($filas as $fila) {
              echo "
              <a href=\"producto.php?tipo=gaming&id=".$fila['ProductoId']."\">
                <div class=\"\" style=\"width: 156; height: auto;\">
                  <img src=\"".$fila['URL']."\" style\"margin: 0 auto; height: 134px;\">
                </div>
              </a>
              ";
            }
          }
           ?>
          <div>
            <img src="http://placehold.it/350x300?text=7">
          </div>
          <div>
            <img src="http://placehold.it/350x300?text=8">
          </div>
          <div>
            <img src="http://placehold.it/350x300?text=9">
          </div>
        </div>
      </div>
      <br>
      <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="./slick/slick.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
      $(document).on('ready', function() {
        $(".vertical-center-4").slick({
          dots: true,
          vertical: true,
          centerMode: true,
          slidesToShow: 4,
          slidesToScroll: 2
        });
        $(".vertical-center-3").slick({
          dots: true,
          vertical: true,
          centerMode: true,
          slidesToShow: 3,
          slidesToScroll: 3
        });
        $(".vertical-center-2").slick({
          dots: true,
          vertical: true,
          centerMode: true,
          slidesToShow: 2,
          slidesToScroll: 2
        });
        $(".vertical-center").slick({
          dots: true,
          vertical: true,
          centerMode: true,
        });
        $(".vertical").slick({
          dots: true,
          vertical: true,
          slidesToShow: 3,
          slidesToScroll: 3
        });
        $(".regular").slick({
          dots: true,
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 3
        });
        $(".center").slick({
          dots: true,
          infinite: true,
          centerMode: true,
          slidesToShow: 5,
          slidesToScroll: 3
        });
        $(".variable").slick({
          dots: true,
          infinite: true,
          variableWidth: true
        });
        $(".lazy").slick({
          lazyLoad: 'ondemand', // ondemand progressive anticipated
          infinite: true
        });
      });</script>
    </section>
    <footer class="footer bg-light" style="width: 100%;">
      <div class="container bg-light row">
        <div class="bg-transparent col-sm">
          <p class="bg-transparent"><strong class="text-muted">Productos</strong></p>
          <p class="bg-transparent"><a class="text-muted" href="productos.php?busqueda=&tipo=componentes&pagina=1&orden=normal">Componentes</a></p>
          <p class="bg-transparent"><a class="text-muted" href="productos.php?busqueda=&tipo=audio&pagina=1&orden=normal">Audio</a></p>
          <p class="bg-transparent"><a class="text-muted" href="productos.php?busqueda=&tipo=gaming&pagina=1&orden=normal">Gaming</a></p>
        </div>
        <div class="bg-transparent col-sm">
          <p class="text-muted bg-transparent"><strong class="text-muted">Informacion</strong></p>
          <p class="bg-transparent"><a class="text-muted" href="">Nosotros</a></p>
          <p class="bg-transparent"><a class="text-muted" href="">Desarrollador</a></p>
        </div>
        <div class="bg-transparent col-sm">
          <p class="text-muted bg-transparent"><strong class="text-muted">Legal</strong></p>
          <p class="bg-transparent"><a class="text-muted" href="">Copyright</a></p>
          <p class="bg-transparent"><a class="text-muted" href="">Cookies</a></p>
          <p class="bg-transparent"><a class="text-muted" href="">Política de privacidad</a></p>
        </div>
        <div class="bg-transparent col-sm">
          <p class="text-muted bg-transparent"><strong class="text-muted">Redes</strong></p>
          <table>
            <tr>
              <td>
                <a href="#">
                  <img class="col-sm rounded" src="Media/social/facebook.png"  width="50px" alt="">
                </a>
              </td>
              <td>
                <a href="#">
                  <img class="col-sm rounded" src="Media/social/instagram.png" width="50px" alt="">
                </a>
              </td>
              <td>
                <a href="#">
                  <img class="col-sm rounded"src="Media/social/twitter.png" width="50px" alt="">
                </a>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="text-muted bg-transparent">Iconos diseñados por <a href="http://www.freepik.com/" title="Freepik">Freepik</a> from <a href="https://www.flaticon.es/" title="Flaticon">www.flaticon.com</a> con licencia <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
    </footer>
  <?php require_once("coockies.php") ?>
</body>
</html>
