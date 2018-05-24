<?php

	session_start();

	if(!$_SESSION["validar"]){

		header("location:index.php?action=ingresar");

		exit();

	}

?>
<form style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Maestros</h1>
	<hr>
	<br>
	<a href="index.php?action=registrarmaestro"><input type="button" name="agregarMaestro" class="button tiny" style="background-color: black" value="Agregar"></a>
	<br>
	<br>
	<table id="example" class="display" width="100%">
		<thead>
			<th>Id</th>
			<th>Nombre</th>
			<th>Carrera</th>
			<th>Correo</th>
			<th>Contraseña</th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			<?php

			$vistaMaestro = new MvcController();
			$vistaMaestro -> vistaMaestrosController();
			$vistaMaestro -> borrarMaestroController();

			?>

		</tbody>
	</table>
</form>

