<?php
class Ventas{
  //atributos
  private $numeroFactuaA;
  private $fecha;
  private $hora;
  private $usuario;

  //contructores
  public function setVentas($argFecha, $argHora, $argUsuario){
    $this->fecha = $argFecha;
    $this->hora = $argHora;
    $this->usuario = $argUsuario;
    //conctamos la bd
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO ventas(facturaA, fecha, hora, legajo) VALUES (default, '$argFecha', '$argHora', '$argUsuario')";
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
        $this->numeroFactuaA = $fila['facturaA'];
      }
      //devoldemos los registros
      return true;
    }
  }
  public function setVentaNumeroFactura($argNumeroFacturaA){
    $this->numeroFactuaA = $argNumeroFacturaA;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM ventas WHERE facturaA = '$argNumeroFacturaA' ";
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
        $this->usuario = $fila['legajo'];
      }
      //devoldemos los registros
      return $registos;
    }
  }

  //observadores
  public function getFecha(){
    return $this->fecha;
  }
  public function getHora(){
    return $this->hora;
  }
  public function getUsuario(){
    return $this->usuario;
  }
  public function getNumeroFactura(){
    return $this->numeroFactuaA;
  }
  public function getVentas($argInicio, $argFin){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM ventas WHERE ventas.facturaA NOT IN (SELECT devuelveVenta.facturaA from devuelveVenta) LIMIT $argInicio, $argFin";
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
  public function getVentasTodas(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM ventas";
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
  public function getVentasFiltro($argInicio, $argFin, $argFechaHora, $argUsuario){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM ventas WHERE fecha-hora = '$argFechaHora' OR legajo = '$argUsuario' LIMIT $argInicio, $argFin";
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
  public function getVentasId($argIdVenta){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM ventas WHERE facturaA = '$argIdVenta'";
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
  public function getVentasValores(){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM ventas";
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

  //propios del tipo
  public function getUltimoRegistro(){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT facturaA FROM ventas ORDER BY facturaA DESC LIMIT 1";
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
