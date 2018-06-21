<br><br><br>
<div align="center">
<h2 style="color: #853BBE ">Danz<b>life</b></h2>
<div style="background-color: #F0F0F0; width: 25%" align="center">
	<br>
	<div style="background-color: #F0F0F0; width: 70%" align="center">
		<form method="post">
			<p align="center">Iniciar Sesión</p>
      		<input type="text" name="usuario" placeholder="Usuario" required>
      			<input type="password" name="contra" placeholder="Contraseña" required>
    		<input type="submit" name="ingresar" class="button tiny" style="background-color: #853BBE" value="Ingresar">
  		</form>
	</div>
	<br>
</div>
</div>


<?php
	//Se instancea el controlador
	$ingreso = new MvcController();
	//Se llama al controlador de ingreso
	$ingreso -> ingresoUsuarioController();
	//Se valida el action
	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "<script type='text/javascript'>
        					alert('Datos incorrectos');
      				  </script>";
		
		}

	}

?>