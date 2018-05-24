<?php

	session_start();

	if(!$_SESSION["validar"]){

		header("location:index.php?action=ingresar");

		exit();

	}

	$mvc = new MvcController();
	$id = $_GET["id"];

?>
<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Registrar Tutoria</h1>
	<hr>
	<br>
	<input type="text" name="nombre" value="<?php echo $id ?>" readonly>
	<input type="time" name="hora" placeholder="Hora" required>
	<input type="date" name="fecha" placeholder="Fecha" required>
	<input type="textarea" name="desc" placeholder="Descripción" style="width: 100%; height: 50px" required>
	<br><hr>
	<label style="font-size: 1em; font-weight: bold">Tipo de tutoría</label><br>
	<input type="button" name="individual" class="button tiny" value="Individual" style="background-color: black" onclick="i();">
	<input type="button" name="grupal" class="button tiny" value="Grupal" style="background-color: black" onclick="g();">
	<!--<select class="js-example-basic-single" name="tutor">
	<?php
		foreach ($tutores as $fila) {
	?>
			<option value="<?php echo $fila['idempleado'];?>"><?php echo $fila["nombre"];?></option>
	<?php		
		}
	?>
	</select>-->
	<br><br>
	<input type="submit" name="agregarA" class="button tiny" value="Agregar" style="background-color: black; margin-left: 600px">
</form>

<?php
	
	
	$regA = new MvcController();
	$regA -> registrarAlumnoController();

	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "Fallo al registrar";
		
		}

	}

?>
