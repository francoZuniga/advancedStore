<?php
require_once("../../loginBackend/controlSession.php");
controlAcceso();
require_once("../../../coneccionBD/coneccion.php");
require_once("../../lib/baseDatos/stock.php");
require_once("../../lib/baseDatos/compra.php");
require_once("../../lib/baseDatos/salida.php");
require_once("../../lib/baseDatos/entradaDevolucion.php");
require_once("../../lib/baseDatos/entrada.php");

$controlador = new Stock();
function paginarStock(){
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
      $filas = $controlador->getStock($inicio, $registosPorPagina);
      //ontenemos la cantidad de ventas
      $totalRegistros = $controlador->getStockPaginacion();

      if (!empty($filas) && $totalRegistros > 0) {
        $cantidadPaginas = ceil($totalRegistros/$registosPorPagina);

        foreach ($filas as $fila) {
          if($controlador->esSalida($fila['idMovimiento'])) {
            $controlSalida = new Salida();
            $salida = $controlSalida->setSalidaIdMovimiento($fila['idMovimiento']);
            $numeroFacturaA = $controlSalida->getNumeroFactura();
            $tipo = "<span class=\"badge badge-pill badge-primary\">salida</span>";
            $pdf =  "<a href=\"../../TCPDF-master/informes/facturaA.php?factura=".$numeroFacturaA."\"><img src=\"../../Media/outline_picture_as_pdf_black_24dp.png\"></a>";
          }
          else{
            if ($controlador->esEntrada($fila['idMovimiento'])) {
              $controlEntrada = new Entrada();
              $controlCompra = new Compra();
              $entrada = $controlEntrada->setEntradaIdMovimiento($fila['idMovimiento']);
              $numeroFacturaB = $controlEntrada->getNumeroFactura();
              $compra = $controlCompra->setCompraNumeroFacturaB($numeroFacturaB);
              $pdfCompra = $controlCompra->getURL();
              $tipo = "<span class=\"badge badge-pill badge-success\">entrada</span>";
              $pdf =  "<a href=\"../../".$pdfCompra."\"><img src=\"../../Media/outline_picture_as_pdf_black_24dp.png\"></a>";
            }
            else {
              $controlDevolucion = new entradaDevoluciones();
              $salida = $controlDevolucion->setEntradaDevolucionIdMovimiento($fila['idMovimiento']);
              $numeroFacturaD = $controlSalida->getNumeroFactura();
              $tipo = "<span class=\"badge badge-pill badge-info\">devolucion</span>";
              $pdf =  "<a href=\"../../TCPDF-master/informes/facturaD.php?factura=".$numeroFacturaD."\"><img src=\"../../Media/outline_picture_as_pdf_black_24dp.png\"></a>";
            }
          }
          echo "
          <tr>
            <th scope=\"row\">".$fila['idMovimiento']."</th>
            <td>".$fila['fecha']."</td>
            <td>".$fila['hora']."</td>
            <td>
              ".$tipo."
            </td>
            <td>
              ".$pdf."
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

              $retorno = array($pagina, $cantidadPaginas);
              return $retorno;
      }
      else{
        echo "<div class=\"alert alert-warning\" role=\"alert\">
                no hay registros!!
              </div>";
      }
}
 ?>
