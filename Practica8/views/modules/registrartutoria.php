<?php
	//Se inicia sesion
	session_start();
	//Se valida la session
	if(!$_SESSION["validar"]){
		//Si no esta loggeado manda al login
		header("location:index.php?action=ingresar");
		exit();
	}
	//Se instancea el controlador
	$mvc = new MvcController();
	//Se almacenan las variables del url
	if(isset($_GET["id"])){
		$id = $_GET["id"];
	}
	if(isset($_GET["iddos"])){
		$id2 = $_GET["iddos"];
	}

?>
<a href="index.php?action=tutorias&id=<?php echo $id;?>&iddos=<?php echo $id2;?>"><button class="button tiny" style="background-color: black; margin-left: 950px">Regresar</button></a>
<form method="post" id="formu" style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Registrar Tutoria</h1>
	<hr>
	<input type="submit" name="regTutoria" class="button tiny" value="Registrar" style="background-color: black; margin-left: 590px">
	<input type="text" name="nombre" value="<?php echo $id ?>" readonly>
	<input type="time" name="hora" placeholder="Hora" required>
	<input type="date" name="fecha" placeholder="Fecha" required>
	<input type="textarea" name="desc" placeholder="Descripción" style="width: 100%; height: 50px" required>
	<br><hr>
	<label style="font-weight: bold">Agregue uno o más alumnos a la tutoria</label>
	<label id="a" style="margin-left: 530px; font-weight: bold; color: red"></label>
	<select class="js-example-basic-single" name="alumnos" id="alumnos">
	<?php
		//Se manda a llamar al controlador de alumnos
		$mvc -> traerAlumnosController();
	?>
	</select><br><br>
	<input type="button" name="agregarAlumno" class="button tiny" value="Agregar alumno" style="background-color: black; width: 100%" onclick="agregar();">
	<input type="text" name="sc" id="sc" style="visibility: hidden">
</form>

<?php
	
	//Se instancea el controlador
	$regT = new MvcController();
	//Se manda a llamar al controlador de registrar
	$regT -> registrarTutoriaController();
	//Se valida el action
	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "Fallo al registrar";
		
		}

	}

?>
