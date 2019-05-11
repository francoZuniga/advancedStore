function verificarContraseña(){
  var pass = document.getElementById('password').value;
  var passConfirmed = document.getElementById('confimar').value;
  var email = document.getElementById('email').value;

  if(pass != passConfirmed){
    alert("las contraseñas no coinciden");
    return false;
  }
  else if(pass == "") {
    alert("las contraseña esta vacia, completela");
    return false;
  }
  else if(passConfirmed == "") {
    alert("la confirmacion de contraseñas esta vacia, completela");
    return false;
  }
  else if(email == "") {
    alert("el email esta vacio, completelo");
    return false;
  }
  else{
    return true;
  }
}
