<?php
require_once("../../loginBackend/controlSession.php");
controlAcceso();
require_once("../../../coneccionBD/coneccion.php");
require_once("../../lib/baseDatos/ventas.php");
require_once("../../lib/baseDatos/devolciones.php");
$controlador = new Ventas();
$controladorDevoluciones = new devoluciones();

function paguinarVentas(){
  global $controlador;
  //las variables de la pagina actual, los registros por pagina, y el inicio en de las busquedas
  $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina']: 1; //la pagina actual si es cualquier cosa es la primera sino la que sigue
  $registosPorPagina = 20; //cantidad de registros por pagina
  $inicio = ($pagina>0)?(($pagina * $registosPorPagina)- $registosPorPagina): 0;//la pagina inicio para la divicion de del paginador

    //en caso de que no halla busqueda
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
      $filas = $controlador->getVentas($inicio, $registosPorPagina);
      //ontenemos la cantidad de ventas
      $totalRegistros = $controlador->getVentasValores();

      if (!empty($filas) && $totalRegistros > 0){
        $cantidadPaginas = ceil($totalRegistros/$registosPorPagina);
        echo "
        <table id=\"ventasTabla\" style=\"\" class=\"table\">
          <thead class=\"thead-light\">
            <tr>
              <th scope=\"col\">Factura A</th>
              <th scope=\"col\">Fecha</th>
              <th scope=\"col\">Hora</th>
              <th scope=\"col\">Legajo</th>
              <th scope=\"col\">Detalle</th>
              <th scope=\"col\">Devolver</th>
            </tr>
          </thead>
          <tbody>
          ";
          foreach ($filas as $fila) {
            echo "
            <tr>
              <th scope=\"row\">".$fila['facturaA']."</th>
              <td>".$fila['fecha']."</td>
              <td>".$fila['hora']."</td>
              <td>".$fila['legajo']."</td>
              <td><a href=\"../../TCPDF-master/informes/facturaA.php?factura=".$fila['facturaA']."\"><img src=\"../../Media/outline_picture_as_pdf_black_24dp.png\"></a></td>
              <td>
                <form class=\"\" action=\"registroDevolucion.php\" method=\"post\">
       			 	    <input type=\"hidden\" name=\"productoId\" value=\"".$fila['facturaA']."\">
                  <button class=\"btn btn-link\" type=\"submit\" name=\"button\"><img src=\"../../Media/outline_edit_black_18dp.png\" style=\"width: 30px;\"></button>
       			    </form>
              </td>
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

              echo "
              <form>
                <input type=\"hidden\" name=\"\" id=\"indicador\" value=\"".$pagina."\">
                <input type=\"hidden\" name=\"\" id=\"total\" value=\"".$cantidadPaginas."\">
              </form>
              <script type=\"text/javascript\" src=\"../../js/paginador.js\"></script>
              ";
      }
      else{
        echo "<div class=\"alert alert-warning\" role=\"alert\">
                no hay registros!!
              </div>";
      }
}
function mostrarProductosFiltro(){
  require_once("../../lib/baseDatos/productos.php");
  require_once("../../lib/baseDatos/almacen.php");
  $controlador = new Productos();
  $controladorAlamacen = new Almacen();
  $filas = $controlador->getProductos();
  foreach ($filas as $fila) {
    $almacen = $controladorAlamacen->setAlmacenNumeroAlmacen($fila['ProductoId']);
    $contador = 0;
    if (!empty($almacen)){

      foreach($almacen as $cantidad){
        $contador = $contador + $cantidad['cantidad'];
      }

      if ($contador <= 0) {

      }
      else{
        echo "<option value=\"".$fila['ProductoId']."\" id=\"cantidad\">".$fila['nombre']."</option>";
      }
    }
  }
}
function mostrarDevoluciones(){
  global $controladorDevoluciones;
  //las variables de la pagina actual, los registros por pagina, y el inicio en de las busquedas
  $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina']: 1; //la pagina actual si es cualquier cosa es la primera sino la que sigue
  $registosPorPagina = 20; //cantidad de registros por pagina
  $inicio = ($pagina>0)?(($pagina * $registosPorPagina)- $registosPorPagina): 0;//la pagina inicio para la divicion de del paginador

    // WARNING: luego se implementara la busqueda con filtro
    //en caso de que no halla busqueda
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
      $filas = $controladorDevoluciones->getDevoluciones($inicio, $registosPorPagina);
      //ontenemos la cantidad de ventas
      $totalRegistros = $controladorDevoluciones->getDevolucionesValores();

      if (!empty($filas)) {
        $cantidadPaginas = ceil($totalRegistros/$registosPorPagina);
        echo "
        <table id=\"ventasTabla\" style=\"\" class=\"table\">
          <table id=\"ventasTabla\" class=\"table\">
            <thead class=\"thead-light\">
              <tr>
                <th scope=\"col\">Factura D</th>
                <th scope=\"col\">Factura A</th>
                <th scope=\"col\">Fecha</th>
                <th scope=\"col\">Hora</th>
                <th scope=\"col\">Legajo</th>
                <th scope=\"col\">Detalle</th>
                <th scope=\"col\">Devolver</th>
              </tr>
            </thead>
          ";
        foreach ($filas as $fila) {
          echo "
          <tr>
            <th scope=\"row\">".$fila['facturaD']."</th>
            <td>".$fila['facturaA']."</td>
            <td>".$fila['fecha']."</td>
            <td>".$fila['hora']."</td>
            <td>".$fila['legajo']."</td>
            <td><a href=\"../../TCPDF-master/informes/facturaD.php?factura=".$fila['facturaD']."\"><img src=\"../../Media/outline_picture_as_pdf_black_24dp.png\"></a></td>
            <td>
              <form class=\"\" action=\"registroDevolucion.php\" method=\"post\">
     			 	    <input type=\"hidden\" name=\"productoId\" value=\"".$fila['facturaA']."\">
                <button class=\"btn btn-link\" type=\"submit\" name=\"button\"><img src=\"../../Media/outline_edit_black_18dp.png\" style=\"width: 30px;\"></button>
     			    </form>
            </td>
          </tr>";
        }
        //el paginador
        echo "</table><nav class=\"paginacion\" id=\"paginacionVentas\"><ul>";
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
              echo "
              <form>
                <input type=\"hidden\" name=\"\" id=\"indicador\" value=\"".$pagina."\">
                <input type=\"hidden\" name=\"\" id=\"total\" value=\"".$cantidadPaginas."\">
              </form>
              <script type=\"text/javascript\" src=\"../../js/paginador.js\"></script>
              ";
      }
      else {
        echo "<div class=\"alert alert-warning\" role=\"alert\">
                no hay registros!!
              </div>";
      }
}
 ?>
