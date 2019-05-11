<!DOCTYPE html>
<html lang="en" >
<?php
session_start();

if (!isset($_GET['busqueda']) && !isset($_GET['tipo']) && !isset($_GET['orden'])) {
  $_GET['busqueda'] = "";
  $_GET['tipo'] = "accesorios";
  $_GET['orden'] = "normal";
}
 ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="Media/icono_imaguen/icono_paguina.png" rel="shortcut icon" type="image/png"/>
  <title>Productos</title>
  <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
  <script>
    window.onload=function(){
    var pos=window.name || 0;
    window.scrollTo(0,pos);
    }
    window.onunload=function(){
    window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
    }
</script>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e1381c;">
    <a class="navbar-brand text-white" href="#">
      <img src="Media/icono_imaguen/logo_imaguen2.png" height="30" class="d-inline-block align-top bg-light rounded" alt="" style="padding-left: 4px; padding-right: 2px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto border-primary justify-content-center">
        <li class="nav-item ">
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
        <input class="form-control mr-sm-2" name="busqueda" type="search" placeholder="Buscar.." aria-label="Search">
        <input type="hidden" name="tipo" value="">
        <input type="hidden" name="pagina" value="1">
        <input type="hidden" name="orden" value="normal">
        <button class="btn bg-white text-danger" type="submit" style="height: 35px;"><i class="material-icons">search</i></button>
      </form>
    </div>
  </nav>
  <section style="min-height: 1000px;">
    <div class="btn-group" style="margin-left: 1%; margin-top: 10px;">
      <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #e1381c; color: #fff;">
        ordenar por..
      </button>
      <div class="dropdown-menu">
        <a href="productos.php?busqueda=<?php echo $_GET['busqueda'];?>&tipo=<?php echo $_GET['tipo'];?>&pagina=<?php echo $_GET['pagina'];?>&orden=normal" class="dropdown-item">menor precio</a>
        <a href="productos.php?busqueda=<?php echo $_GET['busqueda'];?>&tipo=<?php echo $_GET['tipo'];?>&pagina=<?php echo $_GET['pagina'];?>&orden=acendente" class="dropdown-item">mayor precio</a>
      </div>
    </div>
		<?php
    require_once("backend/publicacion.php");
    $retorno = paguinarProductos($_GET['busqueda'], $_GET['tipo'], $_GET['orden']);

    if (isset($_SESSION['error'])) {
      echo $_SESSION['error'];
      unset($_SESSION['error']);
    }
		 ?>
  </section>
  <form>
		<input type="hidden" name="" id="indicador" value="<?php echo $retorno[0]; ?>">
		<input type="hidden" name="" id="total" value="<?php echo $retorno[1]; ?>">
	</form>
	<script type="text/javascript" src="js/paginador.js"></script>
	</section>
  <footer class="footer container" style="width: auto;">
    <div class="container bg-transparent row">
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
        <p class="bg-transparent"><a class="text-muted" href="">Autorias</a></p>
        <p class="bg-transparent"><a class="text-muted" href="">Copyright</a></p>
        <p class="bg-transparent"><a class="text-muted" href="">Cookies</a></p>
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
</body>
</html>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="js/index.js"></script>
</body>
</html>
