<?php
session_start();
require_once("../../loginBackend/controlSession.php");
controlAcceso();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>index</title>
		<!--los estilos de boostrap-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../Css/menuBackend.css">
    <link rel="stylesheet" href="ventas.css">
		<script type="text/javascript" src="jsAlmacen/form.js"></script>
		<script type="text/javascript" src="../../js/paginador.js"></script>
    <style media="screen">
      section form div div .pdf{
        width: 30px;
        margin-top: 0;
        margin-left: 10px;
        background-color: #fff;
      }
    </style>
  </head>
  <body>
    <a href="index.php"><img src="../../Media/outline_undo_black_18dp.png"></a>
		<section class="container form-group">
				<form action="registroCompra.php" style="width: 50%;" method="post" class="container" enctype="multipart/form-data">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Upload</span>
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputGroupFile01" name="pdf">
              <label class="custom-file-label" for="inputGroupFile01" style="width: 150px;"><img src="../../Media/outline_picture_as_pdf_black_24dp.png" class="pdf"></label>
            </div>
          </div>
          <button type="submit" name="button" class="btn btn-success"></button>
				</form>
    </section>
  </body>
</html>
