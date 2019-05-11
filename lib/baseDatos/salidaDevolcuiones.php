<?php
class entradaDevolucion{
  private $idEntradaDevolucion;
  private $facturaD;
  private	$idMovimiento;
  private $legajo;


  //contructores
  public function setDevolucionVenta($argFacturaD, $argIdMovimiento, $argLegajo){
    $this->facturaD = $argFacturaD;
    $this->idMovimiento = $argIdMovimiento;
    $this->legajo = $argLegajo;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO entradaDevolucion (idEntradaDevolucion, facturaD, idMovimiento, legajo) VALUES (default, '$argFac', '', '')";
    $declaracion = $connecion->prepare($consulta);
    //pasamos los datos por parametramos
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      $filas = $this->getUltimoRegistro();
      foreach($filas as $fila){
        $this->idEntradaDevolucion = $fila['idEntradaDevolucion'];
      }
      //devoldemos los registros
      return true;
    }
  }
  public function setDevolucionVentaId($argNumeroFactura){
    $this->facturaD = $argNumeroFactura;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM devuelveVenta WHERE facturaD = '$argNumeroFactura'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      while ($resultado = $declaracion->fetch()){
        $registos[]= $resultado;
      }
      if (empty($registos)) {
        return false;
      }
      else{
        foreach ($registos as $fila){
          $this->fecha = $fila['fecha'];
          $this->hora = $fila['hora'];
          $this->legajo = $fila['legajo'];
          $this->facturaA = $fila['facturaA'];
        }
      return $registos;
      }
    }
  }

  //observadores


  //propias del tipo
  public function getUltimoRegistro(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM entradaDevolucion ORDER BY idEntradaDevolucion DESC LIMIT 1";
    $declaracion = $connecion->prepare($consulta);
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      while ($resultado = $declaracion->fetch()){
        $registos[]= $resultado;
      }
      return $registos;
    }
  }
}

 ?>
