<?php
//los datos relevantes de usurio el TDA de coneccion de usurio
require_once("../lib/baseDatos/usurios.php");
require_once("../lib/baseDatos/empleados.php");
require_once("../../coneccionBD/coneccion.php");
//los datos del formulario
session_start();
//datos del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
//consultamos la base de datos
$controlUsuario = new Usurio();//controlador de usuario
$control = $controlUsuario->getUsurio($usuario);//obtenemos los datos de ese usurio

//en caso de que se ejecute el paso 1
if ($control){
    $retornoUsurio = $controlUsuario->getNombre();//gurdamos el valor del nombre de usurio
    $retornoContraseña = $controlUsuario->getContraseña();//gurdamos el valor de la contraseña
    $id = $controlUsuario->getId();

    if($retornoUsurio == $usuario && $retornoContraseña == $contraseña){
      $_SESSION['nombre-usurio'] = $retornoUsurio;
      $_SESSION['pass-usurio'] = $retornoContraseña;
      $_SESSION['id-usuario'] = $id;

      $Empleados = new Empleados();
      $empleado = $Empleados->getEmpledoId($id);
      if ($empleado){
        $_SESSION['legajo'] = $Empleados->getLegajo();
        header("Location: ../backend/index.php");
      }
      else{
      header("Location: ../index.php");
      }
    }
    else {
      $_SESSION['login'] = "
      <div class=\"alert alert-danger\" role=\"alert\">
        la contraseña es incorrecta!!
      </div>
      ";
      header("Location: ../login.php");
    }
}
else {
  //header("Location: ../login.php");
  $_SESSION['login'] = "
  <div class=\"alert alert-danger\" role=\"alert\">
    el usurio no existe!!
  </div>
  ";
  header("Location: ../login.php");
}
 ?>
