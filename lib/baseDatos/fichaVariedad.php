<?php
class fichaVariedad{
  //atributos
  private $idFicha;
  private $idProducto;
  private $modelo;
  private $marca;
  private $tipoProductos;
  private $descripcion;

  //contructores
  public function setFicha($argIdProducto, $argModelo, $argMarca, $argTipoProductos, $argDescripcion){
    $this->idProducto = $argIdProducto;
    $this->modelo = $argModelo;
    $this->marca = $argMarca;
    $this->tipoProductos = $argTipoProductos;
    $this->descripcion = $argDescripcion;
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO fichaVariedad (IdFicha, IdProductos, tipoProductos, modelo, marca, descripcion) VALUES (default, '$argIdProducto', '$argTipoProductos', '$argModelo', '$argMarca', '$argDescripcion')";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      $filas = $this->getUltimoRegistro();
      foreach ($filas as $fila) {
        $this->idFicha = $fila['IdFicha'];
      }
      return true;
    }
  }
  public function setFichaIdProducto($argIdProducto){
    $this->idProducto = $argIdProducto;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM fichaVariedad WHERE IdProductos= '$argIdProducto'";
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
        $this->tipoProductos = $fila['tipoProductos'];
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
  public function setTipoProducto($argTipoProducto){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE fichaAudio SET tipoProductos = '$argTipoProducto' WHERE idProducto='$this->idProducto'";
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
    $consulta = "SELECT * FROM fichaVariedad WHERE IdProductos= '$idProducto'";
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
  public function getTipoProducto(){
    return $this->tipoProductos;
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
    $consulta = "DELETE FROM fichaVariedad WHERE idProducto='$argIdProducto'";
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
  private function getUltimoRegistro(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT IdFicha FROM fichaVariedad ORDER BY IdFicha DESC LIMIT 1";
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
