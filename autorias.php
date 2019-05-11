<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
    <link rel="stylesheet" href="Css/meinFrontendCss.css">

    <link href="Media/icono_imaguen/icono_paguina.png" rel="shortcut icon" type="image/png"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <style type="text/css">
      html, body {
        margin: 0;
        padding: 0;
      }

      * {
        box-sizing: border-box;
      }

      .slider {
        display: block;
          width: 200%;
          margin: 0 auto;
          margin-top: 60px;
      }

      .slick-slide {
        margin: 0px 20px;
      }

      .slick-slide img {
        width: 100%;
        position: static;
      }
      .slick-prev{
        left: 10px;
      }
      .slick-next{
        left: 45%;
      }
      .slick-arrow{

        top: 10%;
      }
      .slick-prev:before,
      .slick-next:before {
        color: black;
      }
      .slick-slide {
        transition: all ease-in-out .3s;
      }
      section{
        min-height: 600px;
        align-content: center;
      }
      section .presentacion{
        width: 50%;
        height: auto;
        margin: 0 auto;
        margin-top: 5%;
        -webkit-box-shadow: 6px 6px 41px -2px rgba(0,0,0,0.75);
        -moz-box-shadow: 6px 6px 41px -2px rgba(0,0,0,0.75);
        box-shadow: 6px 6px 41px -2px rgba(0,0,0,0.75);
      }
      section .presentacion p{
        font-size: 14pt;
        font-family: 'Roboto', sans-serif;
        text-align: left;
        padding: 5%;
      }
      section .presentacion_2{
        width: 95%;
        height: 400px;
        margin-top: 5%;
        -webkit-box-shadow: 6px 6px 41px -2px rgba(0,0,0,0.75);
        -moz-box-shadow: 6px 6px 41px -2px rgba(0,0,0,0.75);
        box-shadow: 6px 6px 41px -2px rgba(0,0,0,0.75);
      }
      section h5{
        width: 100%;
        font-size: 17pt;
        margin: 0 auto;
        padding-top: 30px;
        text-align: center;
      }
      section h3{
        width: 100%;
        font-size: 23pt;
        margin: 0 auto;
        padding-top: 30px;
        text-align: center;
      }
      section ul{
        margin: 0;
        padding-left: 30px;
      }
      footer{
        margin-top: 5%;
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
            <a class="nav-link text-white text-center" href="nosotros.php">Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white text-center" href="#">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white text-center" href="#">Beta</a>
          </li>
           <script type="text/javascript">
             $('.dropdown-toggle').dropdown()
           </script>
        </ul>
        <ul class="navbar-nav justify-content-end">
          <script type="text/javascript">
            $('.dropdown-toggle').dropdown()
          </script>
        </ul>
    </nav>
    <section class="container">
        <h3>Autorias</h3>
        <h5>ingenieria y gestion:</h5>
        <div class="presentacion bg-white border-white rounded" style="width: 50%;">
          <p>
            Codigo de programacion, organizacion y la ingenieria en general es de franco agustin ojeda zuñiga. Director y gestionador del proyecto gaston zuñiga.
          </p>
        </div>
        <h5>Arte y diseño</h5>
        <div class="presentacion bg-white border-white rounded" style="width: 50%;">
          <p>
            backgraund: mario sepulveda.</br>
            imagenes pagina de inicio:</br>
          </p>
            <ul>
              <li><a href="http://www.freepik.com">Designed by Freepik</a></li>
              <li></li>
            </ul>
            </br>
          <p>
            iconos:
            Flaticon
          </p>
            <ul>
              <li><a href="http://www.freepik.com">Designed by Freepik</a></li>
              <li></li>
            </ul>
          </br>
          <p>Material Dising</p>
          <ul>
            <li><a href="http://www.freepik.com">Designed by Freepik</a></li>
            <li></li>
          </ul>
          </br>
        </div>
        <h5>Logistica, y planiacion</h5>
        <div class="presentacion bg-white border-white rounded" style="width: 50%;">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        </div>
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
  </body>
</html>
