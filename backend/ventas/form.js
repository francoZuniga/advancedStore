/**
 * [hora :tomamos la hora del sistema del usuario]
 * @return {[String/Fecha]} [es la fecha del usurio]
 */
function hora(){
  var d = new Date();

  var hora = d.getHours();
  var minutos = d.getMinutes();
  var segundos = d.getSeconds();
  return hora+":"+minutos+":"+segundos+".000000";
}
/**
 * [fecha :tomamos la fecha del sistema del usuario]
 * @return {[String/Hora]} [es la hora del sistema del usurio]
 */
function fecha(){
  var d = new Date();

  var año = d.getFullYear();
  var mes = d.getMonth()+1;
  var dia = d.getDate();

  return año+"-"+mes+"-"+dia;
}
/**
 * [bloqueamosForm :evitamos el problema de carga vacia de un producto]
 * @return {[Void]} [description]
 */
function bloqueamosForm(){
  var productos = document.getElementById('idProducto').value;
  var cantidad =  document.getElementById('cantidad').value;
  var fecha = document.getElementById('fecha').value;
  var hora = document.getElementById('hora').value;
  //en caso de que esten completos los campos esten completos
  if(productos != "" && cantidad != ""){
    alert("bien echo");
  }
  else{
    alert("mal echo");
  }
}
