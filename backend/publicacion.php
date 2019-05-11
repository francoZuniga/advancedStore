<?php
/**
 * [paguinarProductos :mostramos los productos cuyos id sean los ]
 * @return [type] [description]
 */
function paguinarProductos($busqueda, $tipo, $orden){
  require_once("../coneccionBD/coneccion.php");
  require_once("lib/baseDatos/productos.php");
  require_once("lib/baseDatos/favoritos.php");
  require_once("lib/baseDatos/carrito.php");

  //las variables de la pagina actual, los registros por pagina, y el inicio en de las busquedas
  $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina']: 1; //la pagina actual si es cualquier cosa es la primera sino la que sigue
  $registosPorPagina = 4; //cantidad de registros por pagina
  $inicio = ($pagina>0)?(($pagina * $registosPorPagina)- $registosPorPagina): 0;//la pagina inicio para la divicion de del paginador

  //en caso de que la busqueda tenga parametros
    if(!$busqueda == ""){
      if ($orden == "normal") {
        $consulta = new Productos();
        $filas = $consulta->getProductosPaginadorConBusquedaAsc($inicio, $registosPorPagina, $busqueda);
        $registosActuales = $consulta->getProductosPaginadorConBusquedaValores($busqueda);
        //en caso de que halla registros
        if ($registosActuales > 0) {

          $cantidadPaginas = ceil($registosActuales/$registosPorPagina);
          maquetaProducto($filas);

          //el paginador en si
          echo "</div>
          ¡
                <nav class=\"Page navigation example d-flex justify-content-center\" >
                  <ul class=\"pagination\">";
        					if ($pagina == 1) {
        						echo "<li class=\"page-item disabled\"><a class=\"page-link\">-</></li>";
        					}
        					else{
        						$numero = $pagina - 1;
        						echo "<li class=\"page-item\"><a class=\"page-link\" href=\"productos.php?busqueda=".$busqueda."&tipo=".$tipo."&pagina=".$numero."&orden=".$orden."\">Previous</></li>";
        					}
        					for($i=1; $i<=$cantidadPaginas; $i++){
        								echo "<li class=\"page-item\" id=\"".$i."\"><a class=\"page-link bg-transparent\" href=\"productos.php?busqueda=".$busqueda."&tipo=".$tipo."&pagina=".$i."&orden=".$orden."\">".$i."</a></li>";
                  }
        					if ($pagina == $cantidadPaginas) {
        						echo "<li class=\"page-item\"><a class=\"page-link\">-</a></li>";
        					}
        					else{
        						$numero = $pagina + 1;
        						echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"productos.php?busqueda=".$busqueda."&tipo=".$tipo."&pagina=".$numero."&orden=".$orden."\">Next</></li>";
        					}
        				echo "</ul>
                </nav>";

          $retorno = array($pagina, $cantidadPaginas);
          return $retorno;
        }
        else{
          echo "<div class=\"alert alert-danger\" role=\"alert\">
            no hay registros!!
          </div>";
        }
      }
      else{
        $consulta = new Productos();
        $filas = $consulta->getProductosPaginadorConBusquedaDes($inicio, $registosPorPagina, $busqueda);
        $registosActuales = $registosActuales = $consulta->getProductosPaginadorConBusquedaValores($busqueda);

        //en caso de que halla registros
        if (!empty($filas)) {
          $cantidadPaginas = ceil($registosActuales/$registosPorPagina);
          maquetaProducto($filas, $orden);

          echo "</div>
          ¡
                <nav class=\"Page navigation example d-flex justify-content-center\" >
                  <ul class=\"pagination\">";
        					if ($pagina == 1) {
        						echo "<li class=\"page-item disabled\"><a class=\"page-link\">-</></li>";
        					}
        					else{
        						$numero = $pagina - 1;
        						echo "<li class=\"page-item\"><a class=\"page-link\" href=\"productos.php?busqueda=".$busqueda."&tipo=".$tipo."&pagina=".$numero."&orden=".$orden."\"><</></li>";
        					}
        					for($i=1; $i<=$cantidadPaginas; $i++){
        								echo "<li class=\"page-item\" id=\"".$i."\"><a class=\"page-link bg-transparent\" href=\"productos.php?busqueda=".$busqueda."&tipo=".$tipo."&pagina=".$i."&orden=".$orden."\" style=\"\">".$i."</a></li>";
                  }
        					if ($pagina == $cantidadPaginas) {
        						echo "<li class=\"page-item\"><a class=\"page-link\">-</a></li>";
        					}
        					else{
        						$numero = $pagina + 1;
        						echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"productos.php?busqueda=".$busqueda."&tipo=".$tipo."&pagina=".$numero."&orden=".$orden."\">></a></li>";
        					}
        				echo "</ul>
                </nav>";

          $retorno = array($pagina, $cantidadPaginas);
          return $retorno;
        }
        else{
          echo "<div class=\"alert alert-danger\" role=\"alert\">
            no hay registros!!
          </div>";
        }
      }
    }
    //en caso de que no halla busqueda
    else{
      if ($orden == "normal"){
        $consulta = new Productos();
        //obtenemos los registros y la cantidad de los mismos
        $filas = $consulta->getProductosPaginadorAsc($inicio, $registosPorPagina, $tipo);
        //ontenemos la cantidad de
        $totalRegistros = $consulta->getProductosCantidad($tipo);

        if (!empty($filas)) {
          $cantidadPaginas = ceil($totalRegistros/$registosPorPagina);
          maquetaProducto($filas, $orden);
          //el paginador
          echo "</div>
                <nav class=\"Page navigation example d-flex justify-content-center\" >
                  <ul class=\"pagination\">";
        					if ($pagina == 1) {
        						echo "<li class=\"page-item disabled\"><a class=\"page-link\">-</></li>";
        					}
        					else{
        						$numero = $pagina - 1;
        						echo "<li class=\"page-item\"><a class=\"page-link\" href=\"productos.php?busqueda=".$busqueda."&tipo=".$tipo."&pagina=".$numero."&orden=".$orden."\"><</></li>";
        					}
        					for($i=1; $i<=$cantidadPaginas; $i++){
        								echo "<li class=\"page-item\" id=\"".$i."\"><a class=\"page-link bg-transparent\" href=\"productos.php?busqueda=".$busqueda."&tipo=".$tipo."&pagina=".$i."&orden=".$orden."\">".$i."</a></li>";
                  }
        					if ($pagina == $cantidadPaginas) {
        						echo "<li class=\"page-item disabled\"><a class=\"page-link\">-</a></li>";
        					}
        					else{
        						$numero = $pagina + 1;
        						echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"productos.php?busqueda=".$busqueda."&tipo=".$tipo."&pagina=".$numero."&orden=".$orden."\">></a></li>";
        					}
        				echo "</ul>
                </nav>";

                $retorno = array($pagina, $cantidadPaginas);
                return $retorno;
        }
        else{
          $_SESSION['error'] = "
          <div class=\"alert alert-danger\" role=\"alert\">
            no hay registros!!
          </div>
          ";
        }
      }
      else{
        $consulta = new Productos();
        //obtenemos los registros y la cantidad de los mismos
        $filas = $consulta->getProductosPaginadorDes($inicio, $registosPorPagina, $tipo);
        //ontenemos la cantidad de
        $totalRegistros = $consulta->getProductosCantidad($tipo);

        if (!empty($filas)) {
          $cantidadPaginas = ceil($totalRegistros/$registosPorPagina);

          maquetaProducto($filas, $orden);
          //el paginador
          echo "</div>
                <nav class=\"Page navigation example d-flex justify-content-center\" >
                  <ul class=\"pagination\">";
        					if ($pagina == 1) {
        						echo "<li class=\"page-item disabled\"><a class=\"page-link\">-</></li>";
        					}
        					else{
        						$numero = $pagina - 1;
        						echo "<li class=\"page-item\"><a class=\"page-link \" href=\"productos.php?busqueda=".$busqueda."&tipo=".$tipo."&pagina=".$numero."&orden=".$orden."\"><</></li>";
        					}
        					for($i=1; $i<=$cantidadPaginas; $i++){
        								echo "<li class=\"page-item\" id=\"".$i."\"><a class=\"page-link\" style=\"color: #fff;\" href=\"productos.php?busqueda=".$busqueda."&tipo=".$tipo."&pagina=".$i."&orden=".$orden."\">".$i."</a></li>";
                  }
        					if ($pagina == $cantidadPaginas) {
        						echo "<li class=\"page-item disabled\"><a>-</a></li>";
        					}
        					else{
        						$numero = $pagina + 1;
        						echo "<li class=\"page-item\"><a class=\"page-link\" href=\"productos.php?busqueda=".$busqueda."&tipo=".$tipo."&pagina=".$numero."&orden=".$orden."\">></></li>";
        					}
        				echo "</ul>
                </nav>";

                $retorno = array($pagina, $cantidadPaginas);
                return $retorno;
        }
        else{
          $_SESSION['error'] = "
          <div class=\"alert alert-danger\" role=\"alert\">
            no hay registros!!
          </div>
          ";
      }
    }
  }
}
function maquetaProducto($filas){
    echo "<div class=\"d-flex flex-wrap justify-content-center\" style=\"margin-top: 10px;\">";
    if(empty($filas)){
      echo "no hay registros";
    }
    foreach ($filas as $fila) {
      echo "
      <div class=\"card border-1\" style=\"width: 300px; margin: 10px;\" name=\"".$fila['ProductoId']."\">
        <form action=\"producto.php\" method=\"get\">
          <button onclick=\"submit()\" class=\"border-0\" style=\"background-color: #fff; width: 100%;\">
            <img class=\"card-img-top\" src=\"".$fila['URL']."\" alt=\"Card image cap\" style=\"height: 300px\">
            <div class=\"card-body\">
              <input type=\"hidden\" name=\"tipo\" value=\"".$fila['tipo']."\">
              <input type=\"hidden\" value=".$fila['ProductoId']." name=\"id\" >
                <div>
                  <p>".$fila['nombre']."</p>
                  <p>$ ".($fila['precio']+(($fila['ganancia']*$fila['precio'])/100))."</p>
                  <input type=\"hidden\" value=".$fila['tipo']." id=\"tipo2\">
                  <span id=\"tipo\">".$fila['categoria']."</span>
                </div>
            </div>
            </button>
          </form>
        </div>";
    }
    echo "</div>";
}
?>
