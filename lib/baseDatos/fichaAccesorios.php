<?php
class fichaAccesorios{
  //atributos
  private $idFicha;
  private $idProducto;
  private $modelo;
  private $marca;
  private $celulares;
  private $descripcion;
  //contructores
  public function setFicha($argIdProducto, $argModelo, $argMarca, $argCelulares, $argDescripcion){
    $this->idProducto = $argIdProducto;
    $this->modelo = $argModelo;
    $this->marca = $argMarca;
    $this->celulares = $argCelulares;
    $this->descripcion = $argDescripcion;
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO fichaAcceosrios(IdFicha, idProducto, modelo, marca, celulares, descripcion) VALUES (default, '$argIdProducto', '$argModelo', '$argMarca', '$argCelulares', '$argDescripcion')";
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
  public function setFichaId($idProducto){
    $this->idProducto = $idProducto;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM fichaAcceosrios WHERE idProducto= '$idProducto'";
    $declaracion = $connecion->prepare($consulta);
    //ejecutamos la $consulta
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      while($resultado = $declaracion->fetch()){
        $registos[]= $resultado;
      }
      foreach($registos as $fila){
        $this->idFicha = $fila['IdFicha'];
        $this->modelo = $fila['modelo'];
        $this->marca = $fila['marca'];
        $this->celulares = $fila['celulares'];
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
    $consulta = "UPDATE fichaAcceosrios SET modelo = '$argModelo' WHERE idProducto='$this->idProducto'";
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
    $consulta = "UPDATE fichaAcceosrios SET marca = '$argMarca' WHERE idProducto='$this->idProducto'";
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
  public function setCelulares($argCelulares){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE fichaAcceosrios SET celulares = '$argCelulares' WHERE idProducto='$this->idProducto'";
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
    $consulta = "UPDATE fichaAcceosrios SET descripcion = '$argDescripcion' WHERE idProducto='$this->idProducto'";
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
    $consulta = "SELECT * FROM fichaAcceosrios WHERE idProducto= '$idProducto'";
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
  public function getCelulares(){
    return $this->celulares;
  }
  public function getDesctipcion(){
    return $this->descripcion;
  }

  //propias del tipo
  public function unsetFicha($argIdProducto){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "DELETE FROM fichaAcceosrios WHERE idProducto='$argIdProducto'";
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
  public function getFichaExistente($argIdProducto){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM fichaAcceosrios WHERE idProducto= '$idProducto'";
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
      else {
        return true;
      }
    }
  }
  private function getUltimoRegistro(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT IdFicha FROM fichaAcceosrios ORDER BY IdFicha DESC LIMIT 1";
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
