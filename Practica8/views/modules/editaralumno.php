<?php

	session_start();

	if(!$_SESSION["validar"]){

		header("location:index.php?action=ingresar");

		exit();

	}

?>
<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Modificar Alumno</h1>
	<hr>
	<br>
	<?php
		$modA = new MvcController();
		$modA -> editarAlumnoController();
		$modA -> modificarAlumnoController();
	?>
</form>

<?php
	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "Fallo al registrar";
		
		}

	}

?>
