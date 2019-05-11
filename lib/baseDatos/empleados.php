<?php

class Empleados{
  //atributos
  private $id;
  private $legajo;
  private $fechaIngreso;
  //contructores
  //observadores
  public function getEmpledoId($argId){
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM empleado WHERE id='$argId'";
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
      if (empty($registos)) {
        return false;
      }
      else{
        foreach ($registos as $fila) {
          $this->id = $argId;
          $this->legajo = $fila['legajo'];
          $this->fechaIngreso = $fila['fechaIngreso'];
        }
        return true;
      }
    }
  }
  public function getId(){
    return $this->id;
  }
  public function getLegajo(){
    return $this->legajo;
  }
  public function getFechaIngreso(){
    return $this->fechaIngreso;
  }
}


 ?>
