<?php
class imagenPublicacion{
  //atributos
  private $idPublicacion;
  private $url;

  //contructores
  public function setImagenPublicacion($argIdPublicacion, $argUrl){
    $this->idPublicacion = $argIdPublicacion;
    $this->url = $argUrl;
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO imagenPublicacion(idPublicacion, URL) VALUES ('$argIdPublicacion', '$argUrl')";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function setImagenPublicacionIdPublicacion($argIdPublicacion){
    $this->idPublicacion = $argIdPublicacion;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM imagenPublicacion WHERE idPublicacion = '$argIdPublicacion'";
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
        return 0;
      }
      foreach($registos as $fila){
        $this->url[] = $fila['URL'];
      }
      //devoldemos los registros
      return $registos;
    }
  }

  //modificadores
  public function setUrl($argUrl){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE imagenPublicacion SET URL = '$argUrl' WHERE idPublicacion = '$this->idPublicacion'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }

  //obsercadores
  public function getIdPublicacion(){
    return $this->idPublicacion;
  }
  public function getUrl(){
    return $this->url;
  }

  //propias del tipo
  public function unsetImagenProducto($argIdPublicacion, $argUrl){
     $registos = null;
     $modelo = new coneccion();
     $connecion = $modelo->getConneccion();
     //realizamos la consuta
     $consulta = "DELETE FROM imagenPublicacion WHERE idPublicacion ='$argIdPublicacion' AND URL = '$argUrl'";
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
