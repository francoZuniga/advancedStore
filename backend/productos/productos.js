  var dato = document.getElementById('datoTipo').value;
  if(dato == "accesorios"){
    document.getElementById('audio').setAttribute("style", "display: none;");
    document.getElementById('variedad').setAttribute("style", "display: none;");
  }else{
    if(dato == "audio"){
      document.getElementById('accesorios').setAttribute("style", "display: none;");
      document.getElementById('variedad').setAttribute("style", "display: none;");
    }else{
      document.getElementById('accesorios').setAttribute("style", "display: none;");
      document.getElementById('audio').setAttribute("style", "display: none;");
    }
  }
