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
	<h1>Modificar Carrera</h1>
	<hr>
	<br>
	<?php
		//Se instancea el controlador
		$modC = new MvcController();
		//Se llama el controlador de editar
		$modC -> editarCarreraController();
		//Se llama al controlador de modificar
		$modC -> modificarCarreraController();
	?>
</form>

<?php
	//Se obtiene el action
	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "Fallo al registrar";
		
		}

	}

?>
