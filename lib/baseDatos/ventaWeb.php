<?php
class ventaWeb{
//artibutos
private $idWeb;
private $idUsuario;
private $facturaA;
private $idVentaMercadoPago;

//contructores
public function setVentaWeb($argIdUsuario, $argFacturaA, $argidVentaMercadoPago){
  $this->idUsuario = $argIdUsuario;
  $this->facturaA = $argFacturaA;
  $this->idVentaMercadoPago = $argidVentaMercadoPago;

  $modelo = new coneccion();
  $connecion = $modelo->getConneccion();
  //realizamos la consuta
  $consulta = "INSERT INTO ventaWeb(idWeb, idUsuario, facturaA, idVentaMercadoPago) VALUES (default, '$argIdUsuario', '$argFacturaA', '$argidVentaMercadoPago')";
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
      $this->idWeb = $fila['idWeb'];
    }
    //devoldemos los registros
    return true;
  }
}
public function setVentaWebIdUsuario($argIdUsuario){
  $this->idUsuario = $argIdUsuario;

  $modelo = new coneccion();
  $connecion = $modelo->getConneccion();
  //realizamos la consuta
  $consulta = "SELECT * FROM ventaWeb WHERE idUsuario = '$argIdUsuario'";
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
        $this->idWeb = $fila['idWeb'];
        $this->facturaA = $fila['facturaA'];
        $this->idVentaMercadoPago = $fila['idVentaMercadoPago'];
      }
      return $registos;
    }
  }
}

//obsercadores

public function getFactura(){
  return $this->facturaA;
}

public function getIdUsuario(){
  return $this->idUsuario;
}

public function getIdVentaMercadolibre(){
  return $this->idVentaMercadoPag;
}
//propias del tipo
public function getUltimoRegistro(){
  $registos = null;
  $modelo = new coneccion();
  $connecion = $modelo->getConneccion();
  //realizamos la consuta
  $consulta = "SELECT * FROM ventaWeb ORDER BY idWeb DESC LIMIT 1";
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

public function unsetVenta(){
  $modelo = new coneccion();
  $connecion = $modelo->getConneccion();
  //realizamos la consuta
  $consulta = "DELETE FROM ventaWeb WHERE idUsuario = '$this->idUsuario'";
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
