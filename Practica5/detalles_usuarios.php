<?php
	
	require_once("db/database_utilities.php");
	//obtiene el id del usuario seleccionado
	$id = isset( $_GET['id'] ) ? $_GET['id'] : '';
	//busca los datos de ese usuario por su id
	$res2=search($id);
	//condicion que mofica el usuario
	if(isset($_POST["agregar"])){
		//obtienes lo valores de las cajas de texto
		$email = $_POST["correo"];
		$password = $_POST["pass"];
		//ejecuta la funcion de modificar
		$res=modify($id,$email,$password);
		//reactifica que se haya ejecutado la consulta
		if($res){
			echo "<script type='text/javascript'>
    				alert('Usuario modificado');
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
	    		<?php if($res2){ 
	    				//obtiene los valores del usuario para imprirlos en las cajas de texto
	    				$a = $res2->fetch_row();
	    		?>
	    		<input type="text" name="correo" placeholder="Correo electrónico" value="<?php echo $a[1];?>">
	    		<input type="password" name="pass" placeholder="Contraseña" value="<?php echo $a[2];?>">
	    		<input type="submit" name="agregar" class="button radius tiny secondary" style="background-color: green; margin-left: 642px; color:white" value="Modificar">
	    		<?php } ?>
	    	</form>
		</div>
	</div>
    <?php require_once('footer.php'); ?>


  </body>
  </html>