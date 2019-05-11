<?php
class Carrito{
  //artibutos
  private $idCarrito;
  private $idUsuario;
  private $idProducto;
  private $cantidad;

  //contructores
  public function setCarrito($argIdUsuario, $argIdProducto, $argCantidad){
    $this->idUsuario = $argIdUsuario;
    $this->idProducto = $argIdProducto;
    $this->cantidad = $argCantidad;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO carrito(idCarrito, idUsuario, IdProducto, cantidad) VALUES (default, '$argIdUsuario', '$argIdProducto', '$argCantidad')";
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
        $this->idCarrito = $fila['idCarrito'];
      }
      //devoldemos los registros
      return true;
    }
  }
  public function setCarritoIdCarrito($argIdCarrito){
  $this->idCarrito = $argIdCarrito;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM carrito WHERE idCarrito = '$argIdCarrito'";
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
      if (empty($registos)) {
        return false;
      }
      else{
        foreach($registos as $fila){
          $this->idProducto = $fila['IdProducto'];
          $this->idUsuario = $fila['idUsuario'];
          $this->cantidad = $fila['cantidad'];
        }
        return $registos;
      }
    }
  }
  public function setCarritoUsuario($argIdUsuario){
    $this->idUsuario = $argIdUsuario;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM carrito WHERE idUsuario = '$argIdUsuario'";
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
      if (empty($registos)) {
        return false;
      }
      else{
        foreach($registos as $fila){
          $this->idCarrito = $fila['idCarrito'];
        }
        return $registos;
      }
    }
  }
  public function setCarritoUsuarioProducto($argIdUsuario, $argIdProducto){
    $this->idUsuario = $argIdUsuario;
    $this->idProducto = $argIdProducto;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM carrito WHERE idUsuario = '$argIdUsuario' AND IdProducto= '$argIdProducto'";
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
      if (empty($registos)) {
        return false;
      }
      else{
        foreach($registos as $fila){
          $this->idCarrito = $fila['idCarrito'];
        }
        return $registos;
      }
    }
  }

  public function setCarritoProducto($argIdUsuario, $idProducto){
    $this->idUsuario = $argIdUsuario;
    $this->idProducto = $idProducto;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM carrito WHERE idUsuario = '$argIdUsuario' AND IdProducto = '$idProducto'";
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
      if (empty($registos)) {
        return false;
      }
      else{
        foreach($registos as $fila){
          $this->idCarrito = $fila['idCarrito'];
          $this->cantidad = $fila['cantidad'];
        }
        return true;
      }
    }
  }

  //modificadores
  public function setCantidad($argCantidad, $argIdProducto){
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE carrito SET cantidad = '$argCantidad' WHERE IdProducto = '$argIdProducto' AND idUsuario = '$this->idUsuario'";
    $declaracion = $connecion->prepare($consulta);
    //pasamos los datos por parametramos
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }

  public function unsetProducto($argIdProducto){
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "DELETE FROM carrito WHERE IdProducto = '$argIdProducto' AND idUsuario = '$this->idUsuario'";
    $declaracion = $connecion->prepare($consulta);
    //pasamos los datos por parametramos
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }

  //obsercadores

  public function getIdCarrito(){
    return $this->idCarrito;
  }

  public function getIdUsuario(){
    return $this->idUsuario;
  }

  //propias del tipo
  public function getUltimoRegistro(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM carrito ORDER BY idCarrito DESC LIMIT 1";
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

  public function unsetCarrito(){
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "DELETE FROM carrito WHERE idUsuario = '$this->idUsuario'";
    $declaracion = $connecion->prepare($consulta);
    //pasamos los datos por parametramos
    //ejecutamos la $consulta
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
