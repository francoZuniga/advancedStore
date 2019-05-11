<?php

require_once("../../loginBackend/controlSession.php");
controlAcceso();
require_once("../../lib/baseDatos/almacen.php");
require_once("../../../coneccionBD/coneccion.php");
$controlador = new Almacen();

function paguinarAlmacen(){
  global $controlador;
  //las variables de la pagina actual, los registros por pagina, y el inicio en de las busquedas
  $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina']: 1; //la pagina actual si es cualquier cosa es la primera sino la que sigue
  $registosPorPagina = 20; //cantidad de registros por pagina
  $inicio = ($pagina>0)?(($pagina * $registosPorPagina)- $registosPorPagina): 0;//la pagina inicio para la divicion de del paginador

  //en caso de que la busqueda tenga parametros
    if(isset($_GET['productos']) && $_GET['productos'] != ""){
      //
      $producto = $_GET['productos'];
      //
      $filas = $controlador->getAlmacenPaginacionFiltro($inicio, $registosPorPagina,$producto);
      $registosActuales = $controlador->getAlmacenPaginacionFiltroCantidad($producto);
      //en caso de que halla registros
      if (!empty($filas)) {
        foreach ($filas as $fila) {
          echo "
          <tr>
            <th scope=\"row\">".$fila['nAlmacen']."</th>
  					<td>".$fila['fecha']."</td>
  					<td>".$fila['hora']."</td>
  					<td>".$fila['ProductoId']."</td>
  					<td>".$fila['cantidad']."</td>
  					<td><a href=\"pdfAlmacen?producto=\"".$fila['ProductoId']."\">detalle</a></td>
  				</tr>";
        }
      $cantidadPaginas = ceil($registosActuales/$registosPorPagina);
      //el paginador en si
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

            $retorno = array($pagina, $cantidadPaginas);
            return $retorno;
      }
      else {
        echo "<div class=\"alert alert-warning\" role=\"alert\">
                no hay registros!!
              </div>";
      }
    }
    //en caso de que no halla busqueda
    else{
      if (!isset($fechaInicio)) {
        $fechaInicio = "";
      }
      if (!isset($fechaFin)) {
        $fechaFin = "";
      }
      if (!isset($producto)) {
        $producto = "";
      }
      //obtenemos los registros y la cantidad de los mismos
      $filas = $controlador->getAlmacenPaginacion($inicio, $registosPorPagina);
      //ontenemos la cantidad de
      $totalRegistros = $controlador->getAlmacenCantidad();

      $cantidadPaginas = ceil($totalRegistros/$registosPorPagina);

      if (!empty($filas)) {
        foreach ($filas as $fila) {
          echo "
          <tr>
            <th scope=\"row\">".$fila['nAlmacen']."</th>
            <td>".$fila['fecha']."</td>
            <td>".$fila['hora']."</td>
            <td>".$fila['ProductoId']."</td>
            <td>".$fila['cantidad']."</td>
            <td><a href=\"pdfAlmacen?producto=\"".$fila['ProductoId']."\">detalle</a></td>
          </tr>";
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

              $retorno = array($pagina, $cantidadPaginas);
              return $retorno;
      }
      else {
        echo "<div class=\"alert alert-warning\" role=\"alert\">
                no hay registros!!
              </div>";
      }
    }
}
function mostrarProductosFiltro(){
  require_once("../../lib/baseDatos/productos.php");
  $controlador = new Productos();
  $filas = $controlador->getProductos();
  foreach ($filas as $fila) {
    echo "<option value=\"".$fila['ProductoId']."\">".$fila['nombre']."</option>";
  }
}
 ?>
