<?php

class Publicaciones{
  private $idPublicacion;
  private $descripcion;
  private $idProductos;

  //constructores
  public function setPublicacion($argsIdProductos, $argDescripcion){
    $this->idProductos = $argsIdProductos;
    $this->descripcion = $argDescripcion;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();

    $consulta = "INSERT INTO publicaciones (idPublicacion, descripcion, ProductoId) VALUES (default, '$argDescripcion', '$argsIdProductos')";
    $declaracion = $connecion->prepare($consulta);
    //pasamos los datos por parametramos
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      $filas = $this->getUltimaPublicacion();
      foreach ($filas as $fila) {
        $this->idPublicacion = $fila['idPublicacion'];
      }
      return true;
    }
  }
  public function setPublicacionId($argIdPublicacion){
    $this->idPublicacion = $argIdPublicacion;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM publicaciones WHERE idPublicacion = '$argIdPublicacion'";
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
          $this->descripcion = $fila['descripcion'];
          $this->idProductos = $fila['ProductoId'];
        }
      return $registos;
      }
    }
  }
  public function setPublicacionProductoId($argIdProducto){
    $this->idProductos = $argIdProducto;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM publicaciones WHERE ProductoId = '$argIdProducto'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      while ($resultado = $declaracion->fetch()){
        $registos[]= $resultado;
      }
      if(empty($registos)) {
        return false;
      }
      else{
        foreach ($registos as $fila){
          $this->descripcion = $fila['descripcion'];
          $this->idPublicacion = $fila['idPublicacion'];
        }
      return true;
      }
    }
  }
  //modificadores
  public function setDescripcion($argDescripcion){
    $this->descripcion = $argDescripcion;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE publicaciones SET descripcion = '$argDescripcion' WHERE idPublicacion = '$this->idPublicacion'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  //observadores
  public function getPublicaciones(){
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM publicaciones";
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
  public function getPublicacionesPaginacion($inicio, $fin){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM publicaciones LIMIT $inicio, $fin";
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
  public function getIdPublicacion(){
    return $this->idPublicacion;
  }
  public function getDescripcion(){
    return $this->descripcion;
  }
  public function getIdProducto(){
    return $this->idProductos;
  }
  //propias del tipo
  public function esPublicacion($argsIdProducto){
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT ProductoId FROM publicaciones WHERE ProductoId = '$argsIdProducto' ";
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
      if (!empty($registos)) {
        return false;
      }
      //devoldemos los registros
      return true;
    }
  }
  public function getUltimaPublicacion(){
    //retorna los vaores del utimo registro en orden de el id
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM publicaciones ORDER BY idPublicacion DESC LIMIT 1";
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
  public function unsetPublicacion(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "DELETE FROM publicaciones WHERE idPublicacion = '$this->idPublicacion'";
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
