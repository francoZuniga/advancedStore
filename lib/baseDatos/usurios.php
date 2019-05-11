<?php

class Usurio{
  private $id;
  private $usurio;
  private $nombre;
  private $contraseña;
  private $ip;
  private $nivel;

  public function setUsurio($argNombre, $argUsurio, $argContraseña, $argIp, $argNivel){
    $this->usurio = $argUsurio;
    $this->nombre = $argNombre;
    $this->contraseña = $argContraseña;
    $this->ip = $argIp;
    $this->nivel = $argNivel;
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO usuario(id, nombre, usuario, pass, IP_persona, nivel) VALUES(default, '$argNombre',  '$argUsurio', '$argContraseña', '$argIp', '$argNivel')";
    $declaracion = $connecion->prepare($consulta);
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      $filas = $this->getUltimoRegistro();
      foreach($filas as $fila){
        $this->id = $fila['id'];
      }
      return true;
    }
  }
  public function setUsuarioId($argId){
    $this->id = $argId;
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM usuario WHERE id = '$argId' ";
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
        foreach($registos as $fila){
          $this->contraseña = $fila['pass'];
          $this->nombre = $fila['nombre'];
          $this->usurio = $fila['usuario'];
          $this->ip = $fila['IP_persona'];
          $this->nivel = $fila['nivel'];
        }
        //devoldemos los registros
        return $registos;
      }
    }
  }
  public function getUsurio($argUsurio){
    $this->usurio = $argUsurio;
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM usuario WHERE usuario = '$argUsurio' ";
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
        foreach($registos as $fila){
          $this->contraseña = $fila['pass'];
          $this->nombre = $fila['nombre'];
          $this->id = $fila['id'];
          $this->ip = $fila['IP_persona'];
          $this->nivel = $fila['nivel'];
        }
        //devoldemos los registros
        return true;
      }
    }
  }
  public function getContraseña(){
    return $this->contraseña;
  }
  public function getNombre(){
    return $this->usurio;
  }
  public function getId(){
    return $this->id;
  }
  public function getUltimoRegistro(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT id FROM usuario ORDER BY id DESC LIMIT 1";
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
}


 ?>
