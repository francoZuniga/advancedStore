<?php

class Favoritos{
  //atributos
  private $idFavoritos;
  private $idUsuario;
  private $idProducto;

  //contructores
  public function setFavoritos($argIdUsuario, $argIdProducto){
    $this->idUsuario = $argIdUsuario;
    $this->idProducto = $argIdProducto;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO favoritos(idFavoritos, idUsuario, ProductoId) VALUES (default, '$argIdUsuario', '$argIdProducto')";
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
        $this->idFavoritos = $fila['idFavoritos'];
      }
      //devoldemos los registros
      return true;
    }
  }

  public function setFavoritosUsuario($argIdUsuario){
    $this->idUsuario = $argIdUsuario;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM favoritos WHERE idUsuario = '$argIdUsuario'";
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
          $this->idFavoritos = $fila['idFavoritos'];
        }
        return $registos;
      }
    }
  }

  public function setFavoritosUsuarioProducto($argIdUsuario, $argIdProducto){
    $this->idUsuario = $argIdUsuario;
    $this->idProducto = $argIdProducto;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM favoritos WHERE idUsuario = '$argIdUsuario' AND ProductoId = '$argIdProducto'";
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
          $this->idFavoritos = $fila['idFavoritos'];
        }
        return $registos;
      }
    }
  }
  //modificadores
  public function unsetProducto($argIdProducto){
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "DELETE FROM favoritos WHERE ProductoId = '$argIdProducto' AND idUsuario = '$this->idUsuario'";
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

  public function getIdFavoritos(){
    return $this->idFavoritos;
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
    $consulta = "SELECT * FROM favoritos ORDER BY idFavoritos DESC LIMIT 1";
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
    $consulta = "DELETE FROM favoritos WHERE idUsuario = '$this->idUsuario'";
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
