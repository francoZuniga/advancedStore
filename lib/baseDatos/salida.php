<?php
class Salida{
  private $idSalida;
  private $idMovimiento;
  private $numeroFactura;

  //metodos
  public function setSalida($argIdMovimiento, $argNumeroFactura, $argIdProducto, $argCantidad){
    $this->idmovimiento = $argIdMovimiento;
    $this->numeroFactura = $argNumeroFactura;

    //conctamos la bd
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "INSERT INTO salida (idSalida, facturaA, idMovimiento, ProductoId, cantidad) VALUES (default, '$argNumeroFactura', '$argIdMovimiento', '$argIdProducto', $argCantidad)";
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
        $this->idSalida = $fila['idSalida'];
      }
      return true;
    }
  }
  public function setSalidaNumeroFactura($argNumeroFactura){
    $this->numeroFactura = $argNumeroFactura;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM salida WHERE facturaA = '$argNumeroFactura'";
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
      foreach($registos as $fila){
        $this->idmovimiento = $fila['idMovimiento'];
      }
      return $registos;
    }
  }
  public function setSalidaIdMovimiento($argIdMovimiento){
    $this->idmovimiento = $argIdMovimiento;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM salida WHERE idMovimiento = '$argIdMovimiento'";
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
      foreach($registos as $fila){
        $this->numeroFactura = $fila['facturaA'];
      }
      return $registos;
    }
  }

  //observadores
  public function getNumeroFactura(){
    return $this->numeroFactura;
  }
  public function getIdMovimiento(){
    return $this->numeroFactura;
  }
  //propias del tipo
  public function getUltimoRegistro(){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT idSalida, idMovimiento FROM salida ORDER BY idSalida DESC LIMIT 1";
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
