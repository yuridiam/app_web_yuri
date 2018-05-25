<?php
	//Se incia sesion
	session_start();
	//Se valida la sesion
	if(!$_SESSION["validar"]){
		//Si no esta loggeado manda al login
		header("location:index.php?action=ingresar");
		exit();
	}

?>
<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Modificar Maestro</h1>
	<hr>
	<br>
	<?php
		//Se instancea el controlador
		$modM = new MvcController();
		//Se llama al controlador de editar
		$modM -> editarMaestroController();
		//Se llama al controlador de modificar
		$modM -> modificarMaestroController();
	?>
</form>

<?php
	//Se valida el action
	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "Fallo al registrar";
		
		}

	}

?>
