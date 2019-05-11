<?php
class fichaAudio{
  //atributos
  private $idFicha;
  private $idProducto;
  private $modelo;
  private $marca;
  private $ficha;
  private $conectividad;
  private $descripcion;
  //contructores
  public function setFicha($argIdProducto, $argModelo, $argMarca, $argFicha, $argConectividad, $argDescripcion){
    $this->idProducto = $argIdProducto;
    $this->modelo = $argModelo;
    $this->marca = $argMarca;
    $this->ficha = $argFicha;
    $this->conectividad = $argConectividad;
    $this->descripcion = $argDescripcion;
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO fichaAudio (IdFicha, IdProductos, modelo, marca, ficha, conectividad, descripcion) VALUES (default, '$argIdProducto', '$argModelo', '$argMarca', '$argFicha', '$argConectividad', '$argDescripcion')";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      $filas = $this->getUltimaFicha();
      foreach($filas as $fila){
        $this->idFicha = $fila['IdFicha'];
      }
      return true;
    }
  }
  public function setFichaId($argIdProducto){
    $this->idProducto = $argIdProducto;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM fichaAudio WHERE IdProductos= '$argIdProducto'";
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
        $this->idFicha = $fila['IdFicha'];
        $this->modelo = $fila['modelo'];
        $this->marca = $fila['marca'];
        $this->ficha = $fila['ficha'];
        $this->conectividad = $fila['conectividad'];
        $this->descripcion = $fila['descripcion'];
      }
      //devoldemos los registros
      return $registos;
    }
  }

  //modificadores
  public function setModelo($argModelo){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE fichaAudio SET modelo = '$argModelo' WHERE idProducto='$this->idProducto'";
    $declaracion = $connecion->prepare($consulta);
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function setMarca($argMarca){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE fichaAudio SET marca = '$argMarca' WHERE idProducto='$this->idProducto'";
    $declaracion = $connecion->prepare($consulta);
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function setFichaAtributo($argFicha){
    $this->ficha = $argFicha;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE fichaAudio SET ficha = '$argFicha' WHERE idProducto='$this->idProducto'";
    $declaracion = $connecion->prepare($consulta);
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function setConectividad($argConectividad){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE fichaAudio SET conectividad = '$argConectividad' WHERE idProducto='$this->idProducto'";
    $declaracion = $connecion->prepare($consulta);
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function setDescripcion($argDescripcion){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE fichaAudio SET descripcion = '$argDescripcion' WHERE idProducto='$this->idProducto'";
    $declaracion = $connecion->prepare($consulta);
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }

  //observadores
  public function getFicha($idProducto){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM fichaAudio WHERE IdProductos= '$idProducto'";
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
  public function getFichaId(){
    return $this->idFicha;
  }
  public function getModelo(){
    return $this->modelo;
  }
  public function getMarca(){
    return $this->marca;
  }
  public function getFichaAtribute(){
    return $this->ficha;
  }
  public function getConectividad(){
    return $this->conectividad;
  }
  public function getDescripcion(){
    return $this->descripcion;
  }

  //propios del tipo
  public function unsetFicha($argIdProducto){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "DELETE FROM fichaAudio WHERE idProducto='$argIdProducto'";
    $declaracion = $connecion->prepare($consulta);
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  private function getUltimaFicha(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT IdFicha FROM fichaAudio ORDER BY IdFicha DESC LIMIT 1";
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
