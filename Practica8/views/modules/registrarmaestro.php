<?php

	session_start();

	if(!$_SESSION["validar"]){

		header("location:index.php?action=ingresar");

		exit();

	}

	$mvc = new MvcController();
	$carreras = $mvc->traerCarrerasController();
	//$tutores = $mvc->traerMaestrosController();

?>
<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Registrar Maestro</h1>
	<hr>
	<br>
	<input type="text" name="id" placeholder="Id empleado" style="width: 50%" required>
	<input type="text" name="nombre" placeholder="Nombre" required>
	<select class="js-example-basic-single" name="carrera">
	<?php
		foreach ($carreras as $fila) {
	?>
			<option value="<?php echo $fila['id'];?>"><?php echo $fila["nombre"];?></option>
	<?php		
		}
	?>
	</select>
	<br><br>
	<input type="email" name="correo" placeholder="Correo electrónico" required>
	<input type="text" name="contra" placeholder="Contraseña" required>
	<input type="submit" name="agregarM" class="button tiny" value="Agregar" style="background-color: black; margin-left: 600px">
</form>

<?php
	
	
	$regM = new MvcController();
	$regM -> registrarMaestroController();

	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "Fallo al registrar";
		
		}

	}

?>
