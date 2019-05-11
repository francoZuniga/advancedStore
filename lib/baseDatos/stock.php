<?php
class Stock{
  //atributos
  private $idMovimiento;
  private $fecha;
  private $hora;

  //observadores
  public function setStock($argFecha, $argHora){
    //pasamos los parametros a los atributos
    $this->fecha = $argFecha;
    $this->hora = $argHora;
    //conctamos la bd
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO stock(idMovimiento, fecha, hora) VALUES (default, '$argFecha', '$argHora')";
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
        $this->idMovimiento = $fila['idMovimiento'];
      }
      //devoldemos los registros
      return true;
    }
  }
  public function setStockIdMovimiento($argIdMovimiento){
    $this->idMovimiento = $argIdMovimiento;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM stock WHERE idMovimiento = '$argIdMovimiento'";
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
        $this->fecha = $fila['fecha'];
        $this->hora = $fila['hora'];
      }
      //devoldemos los registros
      return $registos;
    }
  }

  //observadores
  public function ultimoMovimiento(){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT idMovimiento FROM stock ORDER BY idMovimiento DESC LIMIT 1";
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
      //devoldemos los registros
      return $registos;
    }
  }
  public function getStock($argInicio, $argFin){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM stock LIMIT $argInicio, $argFin";
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
      //devoldemos los registros
      return $registos;
    }
  }
  public function getStockPaginacion(){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM stock";
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
      return count($registos);
    }
  }
  public function getIdMovimiento(){
    return $this->idMovimiento;
  }
  public function getFecha(){
    return $this->hora;
  }
  public function getHora(){
    return $this->hora;
  }

  //propias del tipo
  public function esSalida($argIdMovimiento){
    //conctamos la bd
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
      if (empty($registos)) {
        return false;
      }
      return true;
    }
  }
  public function esEntrada($argIdMovimiento){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM entrada WHERE idMovimiento = '$argIdMovimiento'";
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
        return false;
      }
      return true;
    }
  }
  public function esDevolucion($argIdMovimiento){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM entradaDevolucion WHERE idMovimiento = '$argIdMovimiento'";
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
        return false;
      }
      return true;
    }
  }
  public function unsetStock($argIdMovimiento){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "DELETE  FROM stock WHERE facturaB = '$argIdMovimiento'";
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
    $consulta = "SELECT idMovimiento FROM stock ORDER BY idMovimiento DESC LIMIT 1";
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
