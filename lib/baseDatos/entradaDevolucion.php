<?php
class entradaDevoluciones{
  private $idEntradaDevolucion;
  private $facturaD;
  private $idMovimiento;
  private $usuario;

  public function setEntradaDevolucion($argFacturaD, $argIdMovimiento, $argUsuario){
    $this->facturaD = $argFacturaD;
    $this->idMovimiento = $argIdMovimiento;
    $this->usuario = $argUsuario;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO entradaDevolucion(idEntradaDevolucion, facturaD, idMovimiento, legajo) VALUES (default, '$argFacturaD', '$argIdMovimiento', '$argUsuario')";
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

  public function setEntradaDevolucionIdMovimiento($argIdMovimiento){
    $this->idMovimiento = $argIdMovimiento;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM devuelveVenta WHERE idMovimiento='$argIdMovimiento' ";
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
      if (empty($registos)) {
        return 0;
      }
      foreach($registos as $fila){
        $this->facturaD = $fila['facturaD'];
        $this->usuario = $fila['legajo'];
        $this->fecha = $fila['fecha'];
      }
      //devoldemos los registros
      return $registos;
    }
  }

  public function getNumeroFactura(){
    return $this->facturaD;
  }

  public function getUltimoRegistro(){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT idEntradaDevolucion FROM devuelveVenta ORDER BY idEntradaDevolucion DESC LIMIT 1";
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
