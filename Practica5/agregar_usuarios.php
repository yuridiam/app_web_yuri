<?php
	
	require_once("db/database_utilities.php");
	//condicion que agrega un usuario al bd
	if(isset($_POST["agregar"])){
		//se cargan los datos que se ingresaron
		$email = $_POST["correo"];
		$password = $_POST["pass"];
		//se aplica la funcion de agregar ala bd
		$res=add($email,$password);
		//se confirma que la consulta se haya llevado a cabo
		if($res){
			echo "<script type='text/javascript'>
    				alert('Usuario almacenado');
    			</script>";
		}
	}

?>

<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Control de Usuarios</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
    <?php require_once('header.php'); ?>
    <div class="row">
	    <div class="large-9 columns">
	        <h2 style="font-weight: bold">Agregar usuario</h2>
	    	<form method="post">
	    		<input type="text" name="correo" placeholder="Correo electrónico">
	    		<input type="password" name="pass" placeholder="Contraseña">
	    		<input type="submit" name="agregar" class="button radius tiny secondary" style="background-color: green; margin-left: 642px; color:white" value="Agregar">
	    	</form>
		</div>
	</div>
    <?php require_once('footer.php'); ?>


  </body>
  </html>