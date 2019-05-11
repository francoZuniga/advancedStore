<?php
class Caracteristicas{
  //artibutos
  private $idCaracteristicas;
  private $idProducto;
  private $caracteristicas;

  //contructores
  public function setCaractersticas($argIdProducto, $argCaracteristicas){
    $this->idProducto = $argIdProducto;
    $this->cantidad = $argCaracteristicas;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO caracteristicas(idCaracteristicas, idProducto, caracteristicas) VALUES(default, '$argIdProducto', '$argCaracteristicas')";
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
        $this->idCaracteristicas = $fila['idCaracteristicas'];
      }
      //devoldemos los registros
      return true;
    }
  }
  public function setCaracteristicasIdProducto($argIdProducto){
    $this->idProducto = $argIdProducto;

    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM caracteristicas WHERE idProducto = '$argIdProducto'";
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
          $this->idCaracteristicas = $fila['idCaracteristicas'];
          $this->caracteristicas = $fila['caracteristicas'];
        }
        return $registos;
      }
    }
  }

  //modificadores
  public function getCaracteristicas(){
    return $this->caracteristicas;
  }
  //popias del tipo
  public function getUltimoRegistro(){
    //conctamos la bd
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la incerccion
    $consulta = "SELECT * FROM caracteristicas ORDER BY idCaracteristicas DESC LIMIT 1";
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

  public function unsetCaracteristicas(){
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "DELETE FROM caracteristicas WHERE idCaracteristicas = '$this->idCaracteristicas'";
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
