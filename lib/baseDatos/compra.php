<?php
class Compra{
  //atributos
  private $numeroFactuaB;
  private $fecha;
  private $hora;
  private $usuario;
  private $URL;
  //contructores
  public function setCompra($argFecha, $argHora, $argUsuario, $argUrl){
    //pasamos los parametros a los atributos
    $this->fecha = $argFecha;
    $this->hora = $argHora;
    $this->usuario = $argUsuario;
    $this->URL = $argUrl;
    //conctamos la bd
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO compra(facturaB, fecha, hora, legajo, URL) VALUES (default, '$argFecha', '$argHora', '$argUsuario', '$argUrl')";
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
        $this->numeroFactuaB = $fila['facturaB'];
      }
      //devoldemos los registros
      return true;
    }
  }
  public function setCompraNumeroFacturaB($argNumeroFacturaB){
    $this->numeroFactuaB = $argNumeroFacturaB;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM compra WHERE facturaB = '$argNumeroFacturaB'";
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
      foreach ($registos as $fila) {
        $this->fecha = $fila['fecha'];
        $this->hora = $fila['hora'];
        $this->usuario = $fila['legajo'];
        $this->URL = $fila['URL'];
      }
      //devoldemos los registros
      return true;
    }
  }

  //observadores
  public function getNumeroFacturaAtributte(){
    return $this->numeroFactuaB;
  }
  public function getCompra($argInicio, $argFin){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM compra LIMIT $argInicio, $argFin";
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
  public function getCompraFiltro($argInicio, $argFin, $argFechaHora, $argUsuario){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM compra WHERE fecha-hora = '$argFechaHora' OR legajo = '$argUsuario' LIMIT $argInicio, $argFin";
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
  public function getCompraId($argNumeroFacturaB){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM compra WHERE facturaB = '$argNumeroFacturaB'";
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
    $consulta = "SELECT * FROM compra";
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
  public function getURL(){
    return $this->URL;
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

  //propios del tipo
  public function getUltimoRegistro(){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM compra ORDER BY facturaB DESC LIMIT 1";
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
  public function unsetCompra($argNumeroFactura){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "DELETE  FROM compra WHERE facturaB = '$argNumeroFactura'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
}
 ?>
