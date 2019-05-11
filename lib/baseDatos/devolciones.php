<?php
class devoluciones{
  //atributos
  private $facturaD;
  private $numeroFactuaA;
  private $fecha;
  private $hora;
  private $usuario;

  //contrsuctores
  public function setDevoluciones($argFecha, $argHora, $argUsuario, $argFacturaA){
    $this->numeroFactuaA = $argFacturaA;
    $this->fecha = $argFecha;
    $this->hora = $argHora;
    $this->usuario = $argUsuario;

    //pasamos los parametros a los atributos
    //conctamos la bd
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO devuelveVenta(facturaD, fecha, hora, legajo, facturaA) VALUES (default, '$argFecha', '$argHora', '$argUsuario', '$argFacturaA')";
    $declaracion = $connecion->prepare($consulta);
    //pasamos los datos por parametramos
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      $fila = $this->getUltimoRegistro();
      foreach($filas as $fila){
        $this->facturaD = $fila['facturaD'];
      }
      //devoldemos los registros
      return true;
    }
  }
  public function setDevolucionNumeroFactura($argNumeroFactura){
    $this->facturaD = $argNumeroFactura;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM devuelveVenta WHERE facturaD='$argNumeroFactura' ";
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
        $this->numeroFactuaA = $fila['facturaA'];
        $this->usuario = $fila['legajo'];
        $this->fecha = $fila['fecha'];
        $this->hora = $fila['hora'];
      }
      //devoldemos los registros
      return $registos;
    }
  }

  //observadores
  public function getFacturaD(){
    return $this->facturaD;
  }
  public function getNumeroFacturaA(){
    return $this->numeroFactuaA;
  }
  public function getFecha(){
    return $this->fecha;
  }
  public function getHora(){
    return $this->hora;
  }
  public function getUsuario(){
    return $this->usuario;
  }
  public function getDevoluciones($argInicio, $argFin){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM devuelveVenta LIMIT $argInicio, $argFin";
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
  public function getDevolucionesValores(){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM devuelveVenta";
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
      else {
        return count($registos);
      }
    }
  }

  //propias del tipo
  public function getUltimoRegistro(){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT facturaD FROM devuelveVenta ORDER BY facturaD DESC LIMIT 1";
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
