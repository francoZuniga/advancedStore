<?php
class Entrada{
  private $idEntrada;
  private $idMovimiento;
  private $facturaB;

  //metodos
  public function setEntrada($argIdMovimiento, $argNumeroFactura, $argIdProducto, $argCantidad){
    $this->idMovimiento = $argIdMovimiento;
    $this->facturaB = $argNumeroFactura;
    //conctamos la bd
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "INSERT INTO entrada(idEntrada, facturaB, idMovimiento, ProductoId, cantidad) VALUES (default,'$argNumeroFactura', '$argIdMovimiento', '$argIdProducto', $argCantidad)";
    $declaracion = $connecion->prepare($consulta);
    //pasamos los datos por parametramos
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      $filas = $this->getUltimoRegistro();
      foreach ($filas as $fila) {
        $this->idEntrada= $fila['idEntrada'];
      }
      return true;
    }
  }
  public function setEntradaIdMovimiento($argIdMovimiento){
    $this->idMovimiento = $argIdMovimiento;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM entrada WHERE idMovimiento = '$argIdMovimiento'";
    $declaracion = $connecion->prepare($consulta);
    //pasamos los datos por parametramos
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      while ($resultado = $declaracion->fetch()){
        $registos[]= $resultado;
      }
      foreach($registos as $fila) {
        $this->idEntrada = $fila['idEntrada'];
        $this->facturaB = $fila['facturaB'];
      }
      return true;
    }
  }

  public function getNumeroFactura(){
    return $this->facturaB;
  }

  public function unsetEntrada($argIdMovimiento, $argNumeroFactura){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "DELETE  FROM entrada WHERE idMovimiento = '$argIdMovimiento' && facturaB = $argNumeroFactura";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function getUltimoRegistro(){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT idEntrada FROM entrada ORDER BY idEntrada DESC LIMIT 1";
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
