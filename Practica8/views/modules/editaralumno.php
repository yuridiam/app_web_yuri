<?php
	//Se inicia sesion
	session_start();
	//Se valida la sesion
	if(!$_SESSION["validar"]){
		//Si no esta loggeado manda al login
		header("location:index.php?action=ingresar");
		exit();
	}

?>
<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Modificar Alumno</h1>
	<hr>
	<br>
	<?php
		//Se instancea el controller
		$modA = new MvcController();
		//Se llama al controlador de editar
		$modA -> editarAlumnoController();
		//Se llama al controlador de modificar
		$modA -> modificarAlumnoController();
	?>
</form>

<?php
	//se obtiene el action
	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "Fallo al registrar";
		
		}

	}

?>
