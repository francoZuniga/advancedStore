<?php
class Almacen{
  private $numeroAlmacen;
  private $idProducto;
  private $fecha;
  private $hora;
  private $cantidad;
  //contructores
  public function setAlmacen($argFecha, $arghora, $argIdProducto, $argCantidad){
    $this->idProducto = $argIdProducto;
    $this->fecha = $argFecha;
    $this->cantidad = $argCantidad;
    //conectamos  la BD
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO almacen(nAlmacen, fecha, hora, ProductoId, cantidad) VALUES (default, '$argFecha' , '$arghora', '$argIdProducto', '$argCantidad')";
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
        $this->numeroAlmacen = $fila['nAlmacen'];
      }
      //devoldemos los registros
      return true;
    }
  }
  public function setAlmacenNumeroAlmacen($argIdProducto){
    $this->ProductoId = $argIdProducto;
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM almacen WHERE ProductoId = '$argIdProducto'";
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
      else{
        foreach ($registos as $fila) {
          $this->numeroAlmacen = $fila['nAlmacen'];
          $this->fecha = $fila['fecha'];
          $this->hora = $fila['hora'];
          $this->cantidad = $fila['cantidad'];
        }
        return $registos;
      }
    }
  }
  //observadores
  public function getNumeroAlmacen(){
    return $this->numeroAlmacen;
  }
  public function getIdProducto(){
    return $this->idProducto;
  }
  public function getFecha(){
    return $this->fecha;
  }
  public function getHora(){
    return $this->hora;
  }
  public function getCantidad(){
    return $this->cantidad;
  }
  public function getAlmacenPaginacion($argInicio, $argFin){
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM almacen LIMIT $argInicio, $argFin";
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
  public function getAlmacenPaginacionFiltro($inicio, $fin, $producto){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //preparamos consulta
    $consulta = "SELECT * FROM almacen WHERE ProductoId = '$producto'  LIMIT $inicio , $fin";
    $declaracion = $connecion->prepare($consulta);

    $declaracion->execute();
    while ($resultado = $declaracion->fetch()){
      $registos[]= $resultado;
    }
    //devoldemos los registros
    return $registos;
  }
  public function getAlmacenPaginacionFiltroCantidad($producto){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //preparamos consulta
    $consulta = "SELECT * FROM almacen WHERE ProductoId = '$producto'";
    $declaracion = $connecion->prepare($consulta);

    $declaracion->execute();
    while ($resultado = $declaracion->fetch()){
      $registos[]= $resultado;
    }
    //devoldemos los registros
    return count($registos);
  }
  public function getAlmacenCantidad(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //preparamos consulta
    $consulta = "SELECT * FROM almacen";
    $declaracion = $connecion->prepare($consulta);

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
  //propios del tipo
  private function getUltimoRegistro(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT nAlmacen FROM almacen ORDER BY nAlmacen DESC LIMIT 1";
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
  private function unsetAlmacen(){

  }
}

 ?>
