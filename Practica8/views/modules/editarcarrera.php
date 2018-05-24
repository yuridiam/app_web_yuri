<?php

	session_start();

	if(!$_SESSION["validar"]){

		header("location:index.php?action=ingresar");

		exit();

	}

?>
<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Modificar Carrera</h1>
	<hr>
	<br>
	<?php
		$modC = new MvcController();
		$modC -> editarCarreraController();
		$modC -> modificarCarreraController();
	?>
</form>

<?php
	if(isset($_GET["action"])){

		if($_GET["action"] == "fallo"){

			echo "Fallo al registrar";
		
		}

	}

?>
