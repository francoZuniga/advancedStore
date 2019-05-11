<?php

require_once("../../loginBackend/controlSession.php");
controlAcceso();
require_once("../../../coneccionBD/coneccion.php");
require_once("../../lib/baseDatos/productos.php");
require_once("../../lib/baseDatos/publicaciones.php");
require_once("../../lib/baseDatos/almacen.php");
$controlador = new Productos();

function paginarProductos($argProducto, $precioMin, $precioMax, $argTipo){
  //las variables de la pagina actual, los registros por pagina, y el inicio en de las busquedas
  $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina']: 1; //la pagina actual si es cualquier cosa es la primera sino la que sigue
  $registosPorPagina = 10; //cantidad de registros por pagina
  $inicio = ($pagina>0)?(($pagina * $registosPorPagina)- $registosPorPagina): 0;//la pagina inicio para la divicion de del paginador

      if (empty($precioMin) && empty($precioMax) && empty($argProducto) && empty($argTipo)) {
        global $controlador;

        $filas = $controlador->getProductosPaginadorSimple($inicio, $registosPorPagina);
        $totalRegistros = $controlador->getProductosCantidadSimple();

        $cantidadPaginas = ceil($totalRegistros/$registosPorPagina);
        if ($totalRegistros > 0) {
          $publicacion = new Publicaciones();

          function contadores($dato){
            switch ($dato) {
              case $dato < 5 || $dato == 0:
                $text = "
                <span class=\"badge badge-pill badge-danger\">".$dato."</span>
                ";
              break;
              case $dato >= 5 && $dato < 10 :
                $text = "
                <span class=\"badge badge-pill badge-warning\">".$dato."</span>
                ";
              break;
              default:
                $text = "
                <span class=\"badge badge-pill badge-success\">".$dato."</span>
                ";
              break;
            }
            return $text;
          }

          foreach ($filas as $fila) {
            if ($publicacion->esPublicacion($fila['ProductoId'])) {
              echo "
              <tr class=\"table-danger\">
                <th scope=\"row\">".$fila['ProductoId']."</th>
                <td>".$fila['nombre']."</td>
                <td>".$fila['precio']."$</td>
                <td>".$fila['ganancia']."%</td>
                <td>".($fila['precio']+(($fila['ganancia']*$fila['precio'])/100))."$</td>
                <td>".$fila['categoria']."</td>
                <td>".$fila['tipo']."</td>
                <td>".$fila['descripcion']."</td>
                <td>".contadores($fila['cantidad'])."</td>
                <td></td>
                <td><a target=\"_blank\" href=\"../../".$fila['URL']."\">img</a></td>
                <td>
                  <form method= \"post\" action=\"publicar.php\">
                    <input type=\"hidden\" name=\"idProducto\" value=\"".$fila['ProductoId']."\">
                    <input type=\"hidden\" name=\"tipó\" value=\"".$fila['tipo']."\">
                    <input type=\"hidden\" name=\"descripcion\" value=\"".$fila['descripcion']."\">
                    <button type=\"submit\" class=\"close\" aria-label=\"\">
                      <img src=\"../../Media/outline_done_black_19dp.png\">
                    </button>
                  </form>
                <td>
                <td>
                <form method=\"post\" action=\"eliminar.php\">
                  <input type=\"hidden\" name=\"idProducto\" value=\"".$fila['ProductoId']."\">
                  <button type=\"submit\" class=\"close\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </form>
                </td>
              ";
            }
            else{
              echo "
              <tr>
                <th scope=\"row\">".$fila['ProductoId']."</th>
                <td>".$fila['nombre']."</td>
                <td>".$fila['precio']."$</td>
                <td>".$fila['ganancia']."%</td>
                <td>".($fila['precio']+(($fila['ganancia']*$fila['precio'])/100))."$</td>
                <td>".$fila['categoria']."</td>
                <td>".$fila['tipo']."</td>
                <td>".$fila['descripcion']."</td>
                <td>".contadores($fila['cantidad'])."</td>
                <td><a href=\"detalle.php?producto=".$fila['ProductoId']."&tipo=".$fila['tipo']."\">detalle</a></td>
                <td><a target=\"_blank\" href=\"../../".$fila['URL']."\">img</a></td>
                <td>
                  <form method= \"post\" action=\"despublicar.php\">
                    <input type=\"hidden\" name=\"idProducto\" value=\"".$fila['ProductoId']."\">
                    <button type=\"submit\" class=\"close\" aria-label=\"Close\">
                      <span aria-hidden=\"true\">&times;</span>
                    </button>
                  </form>
                <td>
                <td>
                <form method= \"post\" action=\"eliminar.php\">
                  <input type=\"hidden\" name=\"idProducto\" value=\"".$fila['ProductoId']."\">
                  <button type=\"submit\" class=\"close\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </form>
                </td>
              ";
            }
          }
          //el paginador
          echo "</tbody></table><nav class=\"paginacion\" id=\"paginacionVentas\"><ul>";
        					if ($pagina == 1) {
        						echo "<li><a>-</></li>";
        					}
        					else{
        						$numero = $pagina - 1;
        						echo "<li><a href=\"index.php?pagina=".$numero."\"><</></li>";
        					}
        					for($i=1; $i<=$cantidadPaginas; $i++){
        								echo "<li id=\"".$i."\"><a href=\"index.php?pagina=".$i."\">".$i."</a></li>";
                  }
        					if ($pagina == $cantidadPaginas) {
        						echo "<li><a>-</></li>";
        					}
        					else{
        						$numero = $pagina + 1;
        						echo "<li><a href=\"index.php?pagina=".$numero."\">></></li>";
        					}
        				echo "</ul></nav>";
        }
        else{
          echo "<div class=\"alert alert-warning\" role=\"alert\">
                  no hay registros!!
                </div>";
        }
      $retorno = array($pagina, $cantidadPaginas);
      return $retorno;
      }
      else {
        global $controlador;

        $filas = $controlador->getProductosFiltro($inicio, $registosPorPagina, $argProducto, $precioMin, $precioMax, $argTipo);
        $totalRegistros = $controlador->getProductosFiltroCantidad($argProducto, $precioMin, $precioMax, $argTipo);

        $cantidadPaginas = ceil($totalRegistros/$registosPorPagina);
        if (empty($filas)) {
          $publicacion = new Publicaciones();

          foreach ($filas as $fila) {
            $almacen = new Almacen();
            $almacen = $almacen->setAlmacenNumeroAlmacen($fila['ProductoId']);
            $contadorCantidad = 0;

            if (!empty($almacen) || $almacen > 0) {
              foreach($almacen as $contador){
                $contadorCantidad = $contadorCantidad + $contador['cantidad'];
                switch ($contadorCantidad) {
                  case $contadorCantidad < 5:
                    $text = "
                    <span class=\"badge badge-pill badge-danger\">".$contadorCantidad."</span>
                    ";
                  break;
                  case $contadorCantidad < 10 && $contadorCantidad >= 5 :
                    $text = "
                    <span class=\"badge badge-pill badge-warning\">".$contadorCantidad."</span>
                    ";
                  break;
                  default:
                    $text = "
                    <span class=\"badge badge-pill badge-success\">".$contadorCantidad."</span>
                    ";
                  break;
                }
              }
            }
            else {
              $text = "<span class=\"badge badge-pill badge-danger\">".$contadorCantidad."</span>";
            }

            if ($publicacion->esPublicacion($fila['ProductoId'])) {
              echo "
              <tr class=\"table-danger\">
                <th scope=\"row\">".$fila['ProductoId']."</th>
                <td>".$fila['nombre']."</td>
                <td>".$fila['precio']."$</td>
                <td>".$fila['ganancia']."%</td>
                <td>".($fila['precio']+(($fila['ganancia']*$fila['precio'])/100))."$</td>
                <td>".$fila['marca']."</td>
                <td>".$fila['tipo']."</td>
                <td>".$fila['descripcion']."</td>
                <td>".$text."</td>
                <td></td>
                <td><a target=\"_blank\" href=\"../../".$fila['URL']."\">img</a></td>
                <td>
                  <form method= \"post\" action=\"publicar.php\">
                    <input type=\"hidden\" name=\"idProducto\" value=\"".$fila['ProductoId']."\">
                    <input type=\"hidden\" name=\"tipó\" value=\"".$fila['tipo']."\">
                    <input type=\"hidden\" name=\"descripcion\" value=\"".$fila['descripcion']."\">
                    <button type=\"submit\" class=\"close\" aria-label=\"\">
                      <img src=\"../../Media/outline_done_black_19dp.png\">
                    </button>
                  </form>
                <td>
                <td>
                <form method= \"post\" action=\"eliminar.php\">
                  <input type=\"hidden\" name=\"idProducto\" value=\"".$fila['ProductoId']."\">
                  <button type=\"submit\" class=\"close\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </form>
                </td>
              ";
            }
            else{
              echo "
              <tr>
                <th scope=\"row\">".$fila['ProductoId']."</th>
                <td>".$fila['nombre']."</td>
                <td>".$fila['precio']."$</td>
                <td>".$fila['ganancia']."%</td>
                <td>".($fila['precio']+(($fila['ganancia']*$fila['precio'])/100))."$</td>
                <td>".$fila['marca']."</td>
                <td>".$fila['tipo']."</td>
                <td>".$fila['descripcion']."</td>
                <td>".$text."</td>
                <td><a href=\"detalle.php?producto=".$fila['ProductoId']."&tipo=".$fila['tipo']."\">detalle</a></td>
                <td><a target=\"_blank\" href=\"../../".$fila['URL']."\">img</a></td>
                <td>
                  <form method= \"post\" action=\"despublicar.php\">
                    <input type=\"hidden\" name=\"idProducto\" value=\"".$fila['ProductoId']."\">
                    <button type=\"submit\" class=\"close\" aria-label=\"Close\">
                      <span aria-hidden=\"true\">&times;</span>
                    </button>
                  </form>
                <td>
                <td>
                <form method= \"post\" action=\"eliminar.php\">
                  <input type=\"hidden\" name=\"idProducto\" value=\"".$fila['ProductoId']."\">
                  <button type=\"submit\" class=\"close\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </form>
                </td>
              ";
            }
          }
          //el paginador
          echo "</tbody></table><nav class=\"paginacion\" id=\"paginacionVentas\"><ul>";
        					if ($pagina == 1) {
        						echo "<li><a>-</></li>";
        					}
        					else{
        						$numero = $pagina - 1;
        						echo "<li><a href=\"index.php?pagina=".$numero."&producto=".$argProducto."&precioMin=".$precioMin."&precioMax=".$precioMax."&tipo=".$argTipo."\"><</></li>";
        					}
        					for($i=1; $i<=$cantidadPaginas; $i++){
        								echo "<li id=\"".$i."\"><a href=\"index.php?pagina=".$i."&producto=".$argProducto."&precioMin=".$precioMin."&precioMax=".$precioMax."&tipo=".$argTipo."\">".$i."</a></li>";
                  }
        					if ($pagina == $cantidadPaginas) {
        						echo "<li><a>-</></li>";
        					}
        					else{
        						$numero = $pagina + 1;
        						echo "<li><a href=\"index.php?pagina=".$numero."&producto=".$argProducto."&precioMin=".$precioMin."&precioMax=".$precioMax."&tipo=".$argTipo."\">></></li>";
        					}
        				echo "</ul></nav>";
        }
        else{
          echo "<div class=\"alert alert-warning\" role=\"alert\">
                  no hay registros!! no hay busqueda
                </div>";
        }
      $retorno = array($pagina, $cantidadPaginas);
      return $retorno;
      }
}

 ?>
