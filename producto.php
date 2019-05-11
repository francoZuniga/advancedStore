  <?php
  session_start();

  require_once("lib/baseDatos/imagenPublicacion.php");
  require_once("lib/baseDatos/publicaciones.php");
  require_once("lib/baseDatos/caracteristicas.php");
  require_once("lib/baseDatos/fichaAudio.php");
  require_once("lib/baseDatos/fichaAccesorios.php");
  require_once("lib/baseDatos/fichaVariedad.php");
  require_once("lib/baseDatos/productos.php");
  require_once("lib/baseDatos/favoritos.php");
  require_once("lib/baseDatos/carrito.php");
  require_once("../coneccionBD/coneccion.php");
  $imagenes = new imagenPublicacion();
  $publicacion = new Publicaciones();
  $producto = new Productos();

  if (isset($_POST['id'])) {
    $idProducto = $_POST['id'];

    $filasPublicacion = $publicacion->setPublicacionProductoId($idProducto);

    $idPublicacion = $publicacion->getIdPublicacion();

    $filas = $producto->setProductoId($idProducto);
    $filasImagenes = $imagenes->setImagenPublicacionIdPublicacion($idPublicacion);
    $tipo = $producto->getTipo();

    foreach ($filas as $fila) {
      $URL = $fila['URL'];
      $precioFinal = ($fila['precio']+(($fila['ganancia']*$fila['precio'])/100));
      $nombre = $fila['nombre'];
    }
  }
  else{
    $idProducto = $_GET['id'];

    $filasPublicacion = $publicacion->setPublicacionProductoId($idProducto);

    $idPublicacion = $publicacion->getIdPublicacion();

    $filas = $producto->setProductoId($idProducto);
    $filasImagenes = $imagenes->setImagenPublicacionIdPublicacion($idPublicacion);
    $tipo = $producto->getTipo();

    foreach ($filas as $fila) {
      $URL = $fila['URL'];
      $precioFinal = ($fila['precio']+(($fila['ganancia']*$fila['precio'])/100));
      $nombre = $fila['nombre'];
      $maximo = $fila['maximo'];
    }
  }
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

      <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
      <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Ubuntu:400,700'>
      <link rel="stylesheet" href="Css/meinFrontendCss.css">
    	<link rel="stylesheet" type="text/css" href="Css/productosCuerpo.css">
      <script src="js/filtro.js"></script>
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
                <a class="dropdown-item text-center" href="productos.php?busqueda=&tipo=gaming&pagina=1&orden=normal">gaming</a>
                <a class="dropdown-item text-center" href="productos.php?busqueda=&tipo=audio&pagina=1&orden=normal">Audio</a>
                <a class="dropdown-item text-center" href="productos.php?busqueda=&tipo=componentes&pagina=1&orden=normal">componentes</a>
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
      <section class="container" style="background-color: #fff; margin-top: 2%;">
      <div class="container">
        <div class="row">
          <div class="col-sm">
            <div id="carouselExampleControls" class="carousel slide row" data-ride="carousel">
              <div class="carousel-inner ">
                  <div class="carousel-item active">
                    <img class="rounded mx-auto d-block" src="<?php echo $URL;?>" alt="First slide" style="height: 300px;">
                  </div>
                <?php
                if (empty($filasImagenes)) {

                }
                else{
                  foreach ($filasImagenes as $fila) {
                    echo "
                    <div class=\"carousel-item item\">
                      <img class=\"rounded mx-auto d-block\" src=\"".$fila['URL']."\" alt=\"First slide\" style=\"height: 300px;\">
                    </div>";
                  }
                }
                 ?>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="" aria-hidden="true" style="color: #e1381c; font-size: 30pt;"><</span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="" aria-hidden="true" style="color: #e1381c; font-size: 30pt;">></span>
                <span class="sr-only rounded-circle bg-dark">Next</span>
              </a>
            </div>
          </div>
          </div>
          <div class="col-sm">
                <table class="table" style="margin-top: 0px;">
                  <tbody>
                   <tr>
                     <th scope="row">Productos:</th>
                     <td><?php echo $nombre;?></td>
                   </tr>
                   <tr>
                     <th scope="row">Precio:</th>
                     <td><?php echo $precioFinal;?></td>
                   </tr>
                   <?php
                   if (isset($_SESSION['id-usuario'])) {
                     echo "
                     <tr>
                      <th scope=\"row\">pago a travez de:</th>
                      <th scope=\"row\">
                        <img src=\"https://imgmp.mlstatic.com/org-img/banners/ar/medios/online/125X125.jpg\" title=\"MercadoPago - Medios de pago\" alt=\"MercadoPago - Medios de pago\" width=\"125\" height=\"125\"/></th>
                      </tr>
                      <tr>
                         <th scope=\"row\">
                         <button type=\"button\" class=\"btn btn-primary border-0\" data-toggle=\"modal\" data-target=\"#exampleModalCenter\" style=\"background-color: #e1381c;\">
                          compra
                          </button>

                          <div class=\"modal fade\" id=\"exampleModalCenter\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">
                            <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">
                              <div class=\"modal-content\">
                                <div class=\"modal-header\">
                                  <h5 class=\"modal-title\" id=\"exampleModalLongTitle\">fomulario de compra </h5>
                                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                  </button>
                                </div>
                                <form action=\"scriptCompra.php\" method=\"post\">
                                <div class=\"modal-body\">
                                  <div class=\"col-md-12 mb-3\">
                                    <label for=\"validationServer01\"></label>
                                    <select class=\"form-control\" id=\"inlineFormCustomSelectPref\" name=\"cantidad\" required>
                									    <option value=\"1\">1</option>
                									    ";
                                      for ($i=2; $i < $maximo ; $i++) {
                                        echo "<option value=\"".$i."\">".$i."</option>";
                                      }
                                      echo "
                									  </select>
                                    <div class=\"invalid-feedback\">
                                      porfavor complete el campo!!
                                    </div>
                                  </div>
                                  <input type=\"hidden\" value=\"".$idProducto."\" name=\"idProducto\">
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
                                <div class=\"modal-footer\">
                                  <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">cancelar</button>
                                  <button type=\"submit\" class=\"btn btn-primary\">comprar</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                      </tr>
                     <tr id=\"funciones\">
                       <th scope=\"row\" id=\"funciones2\">".carrito($idProducto)."</th>
                       <th scope=\"row\" id=\"funciones2\">".favoritos($idProducto)."</th>
                     </tr>";
                  }
                  else{
                    echo "<tr><th scope=\"row\" colspan=\"2\"><a href=\"login.php\">iniciar session</a></th></tr>";
                  }
              function favoritos($dato){
                  $controlFavoritos = new Favoritos();
                  $controlFavoritos->setFavoritosUsuarioProducto($_SESSION['id-usuario'],$dato);
                  $id = $controlFavoritos->getIdFavoritos();

                  if (isset($id)) {
                    $retorna = "
                    <form method=\"get\">
                      <input type=\"hidden\" name=\"id\" value=\"".$dato."\">
                      <button type=\"button\" name=\"\" class=\"btn btn-link \" style=\"width: 40px; height: 40px;\" onclick=\"removeFavoritos(".$dato.",".$_SESSION['id-usuario'].")\">
                        <img src=\"Media/meEncorazona.png\" width=\"35px\" id=\"icono_favoritos_si\" style=\"display: block;\">
                        <img src= \"Media/load.gif\" style=\"display: none;\" width=\"35px\" id=\"load_carrito\">
                      </button>
                    </form>";
                  }
                  else {
                    $retorna = "
                    <form method=\"get\">
                      <input type=\"hidden\" name=\"id\" value=\"".$dato."\">
                      <button type=\"button\" name=\"\" class=\"btn btn-link \" style=\"width: 40px; height: 40px;\" onclick=\"addFavoritos(".$dato.",".$_SESSION['id-usuario'].")\">
                        <img src=\"Media/meEncorazona2.png\" width=\"35px\" id=\"icono_favoritos_no\" style=\"display: block;\">
                        <img src= \"Media/load.gif\" style=\"display: none;\" width=\"35px\" id=\"load_carrito\">
                      </button>
                    </form>";
                  }
                  return $retorna;
                }
              function carrito($dato){
                  $controlCarrito = new Carrito();
                  $controlCarrito->setCarritoProducto($_SESSION['id-usuario'],$dato);
                  $id = $controlCarrito->getIdCarrito();

                  if (isset($id)) {
                    $retorna = "
                    <form  method=\"get\">
                      <input type=\"hidden\" name=\"favoritos\" value=\"".$dato."\">
                      <button type=\"button\" name=\"\" class=\"btn btn-link \" style=\"width: 40px; height: 40px;\" onclick=\"removeCarrito(".$dato.",".$_SESSION['id-usuario'].")\">
                        <img src=\"Media/outline_remove_shopping_cart_black_18dp.png\" width=\"35px\" id=\"icono_carrito_si\">
                        <img src= \"Media/load.gif\" style=\"display: none;\" width=\"35px\" id=\"load_carrito\">
                      </button>
                    </form>";
                  }
                  else {
                    $retorna = "
                    <form method=\"get\">
                      <input type=\"hidden\" name=\"id\" value=\"".$dato."\">
                      <button type=\"button\" name=\"\" class=\"btn btn-link \" style=\"width: 40px; height: 40px;\" onclick=\"addCarrito(".$dato.",".$_SESSION['id-usuario'].")\">
                        <img src=\"Media/outline_add_shopping_cart_black_18dp.png\" width=\"35px\" id=\"icono_carrito_no\">
                        <img src= \"Media/load.gif\" style=\"display: none;\" width=\"35px\" id=\"load_carrito\">
                      </button>
                    </form>";
                  }

                  return $retorna;
              }
             ?>
             <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
             <script type="text/javascript">
               function addCarrito(argID, argUsuario){
                 var id, url, usuario;
                 url = "agregarCarrito.php";
                 id = argID;
                 usuario = argUsuario;

                 $.ajax({
                     type: "post",
                     url: url,
                     data: {idCarrito:id},
                     success: function(){
                      $("#funciones").load(" #funciones2");
                     }
                 })
               }

                 function removeCarrito(argID, argUsuario){
                   var id, url, usuario;
                   url = "removerCarrito.php";
                   id = argID;
                   usuario = argUsuario;

                   $.ajax({
                       type: "post",
                       url: url,
                       data: {idCarrito:id},
                       success: function(){
                         document.getElementById('icono_carrito_si').setAttribute("style", "display: none;");
                         document.getElementById('load_carrito').setAttribute("style", "display: block;");
                         $("#funciones").load(" #funciones2");
                       }
                   })
               }

               function addFavoritos(argID, argUsuario){
                 var id, url;
                 url = "agregarFavoritos.php";
                 id = argID;

                 $.ajax({
                     type: "post",
                     url: url,
                     data: {idCarrito:id},
                     success: function(){
                       document.getElementById('icono_carrito_no').setAttribute("style", "display: none;");
                       document.getElementById('load_carrito').setAttribute("style", "display: block;");
                       $("#funciones").load(" #funciones2");
                     }
                 })
               }

               function removeFavoritos(argID, argUsuario){
                 var id, url;
                 url = "removerFavoritos.php";
                 id = argID;

                 $.ajax({
                     type: "post",
                     url: url,
                     data: {idCarrito:id},
                     success: function(){
                       document.getElementById('icono_favoritos_si').setAttribute("style", "display: none;");
                       document.getElementById('load_carrito').setAttribute("style", "display: block;");
                       $("#funciones").load(" #funciones2");
                     }
                 })
               }
             </script>
            </table>
          </div>
        </div>
      </div>
      <div class="conteiner">
        <p>
          <a class="btn btn-primary border-0" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" style="background-color: #e1381c;">Ficha Tecnica</a>
        </p>
        <div class="row">
          <div class="col">
            <div class="collapse table-bordered" id="multiCollapseExample1">
              <div class="card card-body">
                <?php
                $controlCaracteristicas = new Caracteristicas();
                $filas = $controlCaracteristicas->setCaracteristicasIdProducto($idProducto);
                echo $controlCaracteristicas->getCaracteristicas();
                 ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>
    </body>
  </html>
