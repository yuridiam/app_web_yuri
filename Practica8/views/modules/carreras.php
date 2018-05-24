<?php

	session_start();

	if(!$_SESSION["validar"]){

		header("location:index.php?action=ingresar");

		exit();

	}

?>
<form style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Carreras</h1>
	<hr>
	<br>
	<a href="index.php?action=registrarcarrera"><input type="button" name="agregarCarrera" class="button tiny" style="background-color: black" value="Agregar"></a>
	<br>
	<br>
	<table id="example" class="display" width="100%">
		<thead>
			<th>Id</th>
			<th>Nombre</th>
			<th>Siglas</th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			<?php

			$vistaCarrera = new MvcController();
			$vistaCarrera -> vistaCarrerasController();
			$vistaCarrera -> borrarCarreraController();

			?>

		</tbody>
	</table>
</form>


