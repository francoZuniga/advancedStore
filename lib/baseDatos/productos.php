<?php
/**
 * [Productos :la clase de productos para poder modelarlos en la BD]
 */
class Productos{
  private $id;
  private $precio;
  private $ganancia;
  private $precio1, $precio2;
  private $categoria;
  private $tipo;
  private $cantidad;
  private $medidas;
  private $peso;
  private $maximo;
  private $nombre;
  private $descripcion;
  private $URL;
  //constructores
  public function setProducto($argNombre, $argPrecio, $argGanancia, $argCategoria, $argTipo, $argMedidas, $argPeso, $argMaximo, $argDescripcion, $argUrl){
    $this->precio = $argPrecio;
    $this->categoria = $argCategoria;
    $this->tipo = $argTipo;
    $this->nombre = $argNombre;
    $this->cantidad = 0;
    $this->medidas = $argMedidas;
    $this->peso= $argPeso;
    $this->maximo = $argMaximo;
    $this->descripcion = $argDescripcion;
    $this->URL = $argUrl;
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "INSERT INTO productos (ProductoId, nombre, precio, ganancia, categoria, tipo, cantidad, medidas, peso, maximo, descripcion, URL)
    VALUES (default, '$argNombre', '$argPrecio', '$argGanancia', '$argCategoria', '$argTipo', '0', '$argMedidas', '$argPeso', '$argMaximo', '$argDescripcion', '$argUrl')";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      $filas = $this->getUltimoRegistro();
      foreach ($filas as $fila) {
        $this->id = $fila['ProductoId'];
      }
      return true;
    }
  }
  public function setProductoId($argIdProducto){
    $this->id = $argIdProducto;

    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM productos WHERE ProductoId = '$argIdProducto'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      while ($resultado = $declaracion->fetch()){
        $registos[]= $resultado;
      }
      foreach($registos as $fila){
        $this->precio = $fila['precio'];
        $this->ganancia = $fila['ganancia'];
        $this->categoria = $fila['categoria'];
        $this->tipo = $fila['tipo'];
        $this->cantidad = $fila['cantidad'];
        $this->nombre = $fila['nombre'];
        $this->descripcion = $fila['descripcion'];
        $this->URL = $fila['URL'];
      }
      return $registos;
    }
  }

  //modificadores
  public function setActualizarProducto($argNombre, $argPrecio, $argGanancia, $argCategoria, $argTipo, $argDescripcion, $argUrl){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE productos SET nombre = '$argNombre', precio = '$argPrecio', ganancia = '$argGanancia', categoria ='$argCategoria', tipo = '$argTipo', descripcion = '$argDescripcion', URL = '$argUrl' WHERE ProductoId = '$this->id'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function setNombre($argNombre){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE productos SET nombre = '$argNombre' WHERE ProductoId = '$this->id'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function setPrecio($argPrecio){
    $this->precio = $argPrecio;
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE productos SET precio = '$argPrecio' WHERE ProductoId = '$this->id'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function setGanancia($argGanancia){
    $this->gananacia = $argPrecio;
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE productos SET gananacia = '$argGanancia' WHERE ProductoId = '$this->id'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function serCategoria($argCategoria){
    $this->marca = $argMarca;
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE productos SET categoria = '$argCategoria' WHERE ProductoId = '$this->id'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function setTipo($argTipo){
    $this->tipo = $argTipo;
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE productos SET tipo = '$argTipo' WHERE ProductoId = '$this->id'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function setCantidad($argCantidad){
    $this->cantidad = $argCantidad;
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE productos SET cantidad = '$argCantidad' WHERE ProductoId = '$this->id'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }
  public function setUrl($argUrl){
    $this->URL = $argUrl;
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "UPDATE productos SET URL = '$argUrl' WHERE ProductoId = '$this->id'";
    $declaracion = $connecion->prepare($consulta);

    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      return true;
    }
  }

  //observadores
  public function getIdProducto(){
    return $this->id;
  }
  public function getProductos(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM productos";
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
  public function getProductosPublicados(){
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM productos, publicaciones WHERE productos.ProductoId = publicaciones.ProductoId ";
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
  public function getProductosNombre(){
    return $this->nombre;
  }
  public function getGanancia(){
    return $this->ganancia;
  }
  public function getPrecio(){
    return $this->precio;
  }
  public function getNombre(){
    return $this->nombre;
  }
  public function getCantidad(){
    return $this->cantidad;
  }
  public function getCantidadNombre($argNombre){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM productos WHERE nombre = '$argNombre'";
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
      //devoldemos los registros
      return count($registos);
    }
  }
  public function getProductosMarca($argMarca){
    $this->marca = $argMarca;
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM productos WHERE marca = '$this->marca'";
    $declaracion = $connecion->prepare($consulta);
    $declaracion->bindParam(':argMarca', $this->marca);
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
  public function getProductosPrecios($argPrecioInicio, $argPrecioFin){
    $this->precio1 = $argPrecioInicio;
    $this->precio2 = $argPrecioFin;
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM productos WHERE precio > $this->precio1 AND precio < $this->precio2";
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
  public function getTipo(){
    return $this->tipo;
  }
  public function getProductosTipoId($argId){
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT tipo FROM productos WHERE ProductoId ='$argId";
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
  public function getCantidadUrl($argUrl){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM productos WHERE URL = '$argUrl'";
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
      //devoldemos los registros
      return count($registos);
    }
  }
  public function getProductosPaginadorSimple($argInicio, $argFin){
    $registros = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //preparamos consulta
    $consulta = "SELECT * FROM productos LIMIT $argInicio, $argFin";
    $declaracion = $connecion->prepare($consulta);
    //la pedimos y guardamos las consulta en una arreglo
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      while ($resultado = $declaracion->fetch()){
        $registros[]= $resultado;
      }
      //devoldemos los registros
      return $registros;
    }
  }
  public function getProductosPaginadorDes($argInicio, $argFin, $argTipo){
    $registros = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //preparamos consulta
    $consulta = "SELECT * FROM productos, publicaciones WHERE productos.tipo ='$argTipo' AND productos.ProductoId = publicaciones.ProductoId ORDER BY productos.precio DESC LIMIT $argInicio, $argFin";
    $declaracion = $connecion->prepare($consulta);
    //la pedimos y guardamos las consulta en una arreglo
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      while ($resultado = $declaracion->fetch()){
        $registros[]= $resultado;
      }
      //devoldemos los registros
      return $registros;
    }
  }
  public function getProductosPaginadorAsc($argInicio, $argFin, $argTipo){
    $registros = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //preparamos consulta
    $consulta = "SELECT * FROM productos, publicaciones WHERE productos.tipo ='$argTipo' AND productos.ProductoId = publicaciones.ProductoId ORDER BY productos.precio ASC LIMIT $argInicio, $argFin";
    $declaracion = $connecion->prepare($consulta);
    //la pedimos y guardamos las consulta en una arreglo
    if(!$declaracion){
      return false;
    }
    else{
      $declaracion->execute();
      while ($resultado = $declaracion->fetch()){
        $registros[]= $resultado;
      }
      //devoldemos los registros
      return $registros;
    }
  }
  public function getProductosPaginadorConBusquedaDes($inicio, $fin, $busqueda){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //preparamos consulta
    $consulta = "SELECT DISTINCT * FROM productos, publicaciones WHERE productos.ProductoId = publicaciones.ProductoId AND productos.nombre LIKE '%$busqueda%' OR productos.categoria LIKE '%$busqueda%' ORDER BY productos.precio DESC LIMIT $inicio , $fin";
    $declaracion = $connecion->prepare($consulta);
    $declaracion->execute();
    while ($resultado = $declaracion->fetch()){
      $registos[]= $resultado;
    }
    //devoldemos los registros
    return $registos;
  }
  public function getProductosPaginadorConBusquedaAsc($inicio, $fin, $busqueda){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //preparamos consulta
    $consulta = "SELECT DISTINCT * FROM productos, publicaciones WHERE productos.ProductoId = publicaciones.ProductoId AND productos.nombre LIKE '%$busqueda%' OR productos.categoria LIKE '%$busqueda%' ORDER BY productos.precio ASC LIMIT $inicio , $fin";
    $declaracion = $connecion->prepare($consulta);
    $declaracion->execute();
    while ($resultado = $declaracion->fetch()){
      $registos[]= $resultado;
    }
    //devoldemos los registros
    return $registos;
  }
  public function getProductosUltimos($inicio, $fin, $tipo){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //preparamos consulta
    $consulta = "SELECT DISTINCT * FROM productos, publicaciones WHERE productos.ProductoId = publicaciones.ProductoId AND productos.tipo = '$tipo'  LIMIT $fin";
    $declaracion = $connecion->prepare($consulta);
    $declaracion->execute();
    while ($resultado = $declaracion->fetch()){
      $registos[]= $resultado;
    }
    //devoldemos los registros
    return $registos;
  }
  public function getProductosCantidadSimple(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //preparamos consulta
    $consulta = "SELECT * FROM productos";
    $declaracion = $connecion->prepare($consulta);
    $declaracion->execute();
    while ($resultado = $declaracion->fetch()){
      $registos[]= $resultado;
    }
    if (empty($registos)) {
      return 0;
    }
    //devoldemos los registros
    return count($registos);
  }
  public function getProductosCantidad($argTipo){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //preparamos consulta
    $consulta = "SELECT * FROM productos ,publicaciones WHERE productos.tipo ='$argTipo' AND productos.ProductoId = publicaciones.ProductoId AND productos.tipo = '$argTipo'";
    $declaracion = $connecion->prepare($consulta);
    $declaracion->execute();
    while ($resultado = $declaracion->fetch()){
      $registos[]= $resultado;
    }
    if (empty($registos)) {
      return 0;
    }
    return count($registos);
  }
  public function getProductosPaginadorConBusquedaValores($busqueda){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //preparamos consulta
    $consulta = "SELECT DISTINCT * FROM productos, publicaciones WHERE productos.ProductoId = publicaciones.ProductoId  AND productos.nombre LIKE '%$busqueda%' OR productos.categoria LIKE '%$busqueda%'";
    $declaracion = $connecion->prepare($consulta);
    $declaracion->execute();
    while ($resultado = $declaracion->fetch()){
      $registos[]= $resultado;
    }
    if (empty($registos)) {
      return 0;
    }
    return count($registos);
  }
  public function getProductosFiltro($inicio, $fin, $producto, $argMinPrecio, $argMaxPrecio, $argTipo){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta

    $consulta = $this->getSQLfiltro($producto, $argMinPrecio, $argMaxPrecio, $argTipo)." LIMIT $inicio , $fin";
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
  public function getProductosFiltroCantidad($producto, $argMinPrecio, $argMaxPrecio, $argTipo){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta =  $this->getSQLfiltro($producto, $argMinPrecio, $argMaxPrecio, $argTipo);
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
      //devoldemos los registros
      return count($registos);
    }
  }
  public function getUltimosProductos($argTipo){
    $this->tipo = $argTipo;
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM productos WHERE tipo = '$argTipo' ORDER BY productos.ProductoId DESC LIMIT 4";
    $declaracion = $connecion->prepare($consulta);
    $declaracion->bindParam(':argMarca', $this->marca);
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
  public function getUltimosProductos2($argTipo){
    $this->tipo = $argTipo;
    //conectamos  la BD
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT * FROM productos WHERE tipo = '$argTipo' ORDER BY productos.ProductoId DESC LIMIT 5, 4 ";
    $declaracion = $connecion->prepare($consulta);
    $declaracion->bindParam(':argMarca', $this->marca);
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
  //propios del tipo
  public function getUltimoRegistro(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = "SELECT ProductoId FROM productos ORDER BY ProductoId DESC LIMIT 1";
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
  public function unsetProducto(){
    $registos = null;
    $modelo = new coneccion();
    $connecion = $modelo->getConneccion();
    //realizamos la consuta
    $consulta = " DELETE FROM productos WHERE ProductoId = '$this->id' ";
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
//Copyright (c) 2018 Advanced Store.
 ?>
