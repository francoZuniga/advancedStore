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
function abrirForm(){
  var dato = document.getElementById('pantallaAtras').setAttribute("style","display: block;");
}
function cerrarForm(){
  var dato = document.getElementById('pantallaAtras').setAttribute("style","display: none;");
}
